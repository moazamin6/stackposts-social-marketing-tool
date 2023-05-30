<?php
namespace Core\Facebook_post\Models;
use CodeIgniter\Model;

class Facebook_postModel extends Model
{
    public function __construct(){
        $this->config = include realpath( __DIR__."/../Config.php" );
        $app_id = get_option('facebook_client_id', '');
        $app_secret = get_option('facebook_client_secret', '');
        $app_version = get_option('facebook_app_version', 'v16.0');

        try {
            $fb = new \JanuSoftware\Facebook\Facebook([
                'app_id' => $app_id,
                'app_secret' => $app_secret,
                'default_graph_version' => $app_version,
            ]);

            $this->fb = $fb;
        } catch (\Exception $e) {
            
        }
    }

    public function block_can_post(){
        return true;
    }

    public function block_plans(){
        return [
            "tab" => 10,
            "position" => 100,
            "permission" => true,
            "label" => __("Planning and Scheduling"),
            "items" => [
                [
                    "id" => $this->config['id'],
                    "name" => sprintf("%s scheduling & report", $this->config['name']),
                ]
            ]
        ];
    }

    public function block_frame_posts($path = ""){
        return [
            "position" => 100,
            "preview" => view( 'Core\Facebook_post\Views\preview', [ 'config' => $this->config ] ),
        ];
    }

    public function post_handler($post){
        $data = json_decode($post->data, false);
        $medias = $data->medias;
        $endpoint = "/".$post->account->pid."/";
        $shortlink_by = shortlink_by($data);

        try
        {
            $caption = shortlink( spintax($data->caption), $shortlink_by );
            $link = shortlink( $data->link, $shortlink_by );
            switch ($post->type)
            {
                case 'media':

                    if(count($medias) == 1)
                    {
                        if(is_image($medias[0]))
                        {
                            $medias[0] = watermark($medias[0], $post->team_id, $post->account_id);
                            $endpoint .= "photos";
                            $params = [
                                'message' => $caption,
                                'url' => get_file_url($medias[0])
                            ];
                        }

                        if(is_video($medias[0])){
                            $endpoint .= "videos";
                            $params = [
                                'description' => $caption,
                                'file_url' => get_file_url($medias[0])
                            ];
                        }
                    }
                    else
                    {

                        $media_ids = [];
                        $success_count = 0;
                        foreach ($medias as $key => $media)
                        {   
                            if(is_image($media))
                            {
                                $media = watermark($media, $post->team_id, $post->account->id);
                                $medias[$key] = get_file_url($media);
                                $upload_params = [
                                    'url' => get_file_url($media),
                                    'published' => false
                                ];

                                $upload = $this->fb->post( $endpoint.'photos', $upload_params, $post->account->token)->getDecodedBody();
                                $media_ids['attached_media['.$success_count.']'] = '{"media_fbid":"'.$upload['id'].'"}';
                                $success_count++;
                            }
                            else
                            {   
                                //Pages not support post multi media with videos.
                                if($post->account->category != "page"){

                                    $upload_params = [
                                        'file_url' => get_file_url($media),
                                        'published' => false
                                    ];

                                    $upload = $this->fb->post( $endpoint.'videos', $upload_params, $post->account->token)->getDecodedBody();
                                    $media_ids['attached_media['.$success_count.']'] = '{"media_fbid":"'.$upload['id'].'"}';
                                    $success_count++;
                                }
                            }
                        } 

                        $endpoint .= "feed";
                        $params = ['message' => $caption];

                        $params += $media_ids;
                    }

                    break;

                case 'link':
                    $endpoint .= "feed";
                    $params = [
                        'message' => $caption,
                        'link' => $data->link
                    ];
                    break;

                case 'text':
                    $endpoint .= "feed";
                    $params = ['message' => $caption];
                    break;

            }
        
            $response = $this->fb->post($endpoint, $params, $post->account->token)->getDecodedBody();
            $post_id =  $response['id'];
            unlink_watermark($medias);
            return [
                "status" => "success",
                "message" => __('Success'),
                "id" => $post_id,
                "url" => "https://fb.com/".$post_id,
                "type" => $post->type
            ]; 
        } catch(\Exception $e) {
            if($e->getCode() == 190){
                db_update(TB_ACCOUNTS, [ "status" => 0 ], [ "id" => $post->account->id ] );
            }
            unlink_watermark($medias);
            return [
                "status" => "error",
                "message" => __( $e->getMessage() ),
                "type" => $post->type
            ];
        }
    }
}
