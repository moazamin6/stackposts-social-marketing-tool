<?php
namespace Core\Twitter_post\Models;
use CodeIgniter\Model;
use Abraham\TwitterOAuth\TwitterOAuth;
use Twitter\Text\Parser;

class Twitter_postModel extends Model
{
	public function __construct(){
        $this->config = include realpath( __DIR__."/../Config.php" );

        $this->consumer_key = get_team_data("twitter_consumer_key", "");
        $this->consumer_secret = get_team_data("twitter_consumer_secret", "");

        if(!get_team_data("twitter_status", 0) || $this->consumer_key == "" || $this->consumer_secret == ""){
            $this->consumer_key = get_option('twitter_consumer_key', '');
            $this->consumer_secret = get_option('twitter_consumer_secret', '');
        }
        
        $this->callback_url = get_module_url();
        $this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
    }

    public function block_can_post(){
        return true;
    }

    public function block_plans(){
        return [
            "tab" => 10,
            "position" => 300,
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

    public function post_validator($post){
        $errors = array();
        $data = json_decode( $post->data , 1);
        $medias = $data['medias'];

        if($post->social_network == 'twitter'){
            $validator = Parser::create()->parseTweet($data["caption"]);
            if ($validator->weightedLength > 280) {
                $errors[] = __("Twiiter just accept maximum post length is 280 characters.");
            }
            
        }

        return $errors;
    }

    public function block_frame_posts($path = ""){
        return [
            "position" => 300,
        	"preview" => view( 'Core\Twitter_post\Views\preview', [ 'config' => $this->config ] ),
        ];
    } 

    public function post_handler($post){
        $data = json_decode($post->data, false);
        $medias = $data->medias;
        $accessToken = json_decode($post->account->token);
        $endpoint = "statuses/update";
        $shortlink_by = shortlink_by($data);

        try
        {
            $this->twitter->setOauthToken($accessToken->oauth_token, $accessToken->oauth_token_secret);

            $params = [];
            $caption = shortlink( spintax($data->caption), $shortlink_by );
            $link = shortlink( $data->link, $shortlink_by );

            switch ($post->type)
            {
                case 'media':

                    if( is_image( $medias[0] ) ){
                        $this->twitter->setTimeouts(10,30);
                        $media_ids = array();
                        $medias = array_chunk($medias, 4);
                        foreach ($medias[0] as $media) {
                            $media = watermark($media, $post->team_id, $post->account_id);
                            $media == get_file_path($media);
                            if( stripos( strtolower($media) , "https://") !== false ||  stripos( strtolower($media) , "http://") !== false ){
                                $media = save_img($media, TMPPATH());
                            }
                            $image_info = @getimagesize( get_file_path($media) );
                            if(!empty($image_info)){
                                $upload = $this->twitter->upload( 'media/upload', array('media' => get_file_path($media) ));
                                unlink_watermark([$media]);
                                if( isset($upload->media_id_string)){
                                    $media_ids[] = $upload->media_id_string;
                                }
                            }
                        }

                        $params = [
                            'status' => $caption,
                            'media_ids' => implode(',', $media_ids)
                        ];
                    }else{
                        $this->twitter->setTimeouts(10,30);
                        $upload = $this->twitter->upload('media/upload', [
                            'media' => get_file_path($medias[0]),
                            'media_type' => 'video/mp4',
                            'media_category' => 'tweet_video',
                        ], true);

                        $media_id = $upload->media_id_string;

                        if(isset($upload->processing_info)) {
                            $info = $upload->processing_info;
                            if($info->state != 'succeeded') {
                                $attempts = 0;
                                $check_after_secs = $info->check_after_secs;
                                $success = false;
                                do {
                                    $attempts++;
                                    sleep($check_after_secs);
                                    $upload = $this->twitter->mediaStatus($media_id);
                                    $processing_info = $upload->processing_info;
                                    if($processing_info->state == 'succeeded' || $processing_info->state == 'failed') {
                                        break;
                                    }
                                    $check_after_secs = $processing_info->check_after_secs;
                                } while($attempts <= 10);
                            }
                        }

                        $params = [
                            'status' => $caption,
                            'media_ids' => $upload->media_id_string
                        ];
                    }

                    break;

                case 'link':
                    $params = ['status' => $caption." ".$link];
                    break;

                case 'text':
                    $params = ['status' => $caption];
                    break;
            }

            if(isset($advance['location'])){
                $params['place_id'] = (string)$advance['location'];
            }

            $response = $this->twitter->post($endpoint, $params);

            if(isset($response->id)){
                return [
                    "status" => "success",
                    "message" => __('Success'),
                    "id" => $response->id,
                    "url" => "https://twitter.com/".$response->user->screen_name."/status/".$response->id_str,
                    "type" => $post->type
                ]; 
            }else{
                return [
                    "status" => "error",
                    "message" => __( $response->errors[0]->message ),
                    "type" => $post->type
                ];
            }

        } catch(\Exception $e) {
            unlink_watermark($medias);
            return [
                "status" => "error",
                "message" => __( $e->getMessage() ),
                "type" => $post->type
            ];
        }
    }
}
