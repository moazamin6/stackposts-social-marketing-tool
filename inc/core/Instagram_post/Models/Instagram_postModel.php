<?php
namespace Core\Instagram_post\Models;
use CodeIgniter\Model;

class Instagram_postModel extends Model
{
    public function __construct(){
        $this->config = include realpath( __DIR__."/../Config.php" );
        include get_module_dir( __DIR__ , 'Libraries/vendor/autoload.php');
        $this->app_id = get_option('instagram_client_id', '');
        $this->app_secret = get_option('instagram_client_secret', '');
        $this->app_version = get_option('instagram_app_version', 'v16.0');

        if( get_option('instagram_official_status', 0) && $this->app_id && $this->app_secret && $this->app_version){
            $fb = new \JanuSoftware\Facebook\Facebook([
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => $this->app_version,
            ]);

            $this->fb = $fb;
        }
    }

    public function block_can_post(){
        return true;
    }

    public function block_plans(){
        return [
            "tab" => 10,
            "position" => 200,
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
            "position" => 200,
            "preview" => view( 'Core\Instagram_post\Views\preview', [ 'config' => $this->config ] ),
            "advance_options" => view( 'Core\Instagram_post\Views\advance_options', [ 'config' => $this->config ] )
        ];
    }

    public function post_validator($post){
        $errors = array();
        $data = json_decode( $post->data , 1);
        $medias = $data['medias'];

        if($post->social_network == 'instagram'){

            if($post->api_type == 1){
                if($post->type != "media" && $post->type != "link"){
                    $errors[] = __("Instagram API Official just support post with Photo type");
                }

                if( isset( $data['advance_options'] ) && isset( $data['advance_options']['ig_post_type'] ) ){
                    switch ($data['advance_options']['ig_post_type']) {
                        case 'reels':
                            if( is_image($medias[0]) ){
                                $errors[] = __("Instagram Reels only supports posting videos of minimum 3 seconds and maximum 15 minutes");
                            }
                            break;

                        case 'story':
                            //$errors[] = __("Instagram API Official not support post to story");
                            break;

                        case 'igtv':
                            $errors[] = __("Instagram API Official not support post to IGTV");
                            break;
                    }
                }

            }

            switch ($post->type) {
                case 'text':
                    $errors[] = __("Instagram requires an image or video");
                    break;

                case 'link':
                    if(empty($data['medias'])){
                        $errors[] = __("Instagram requires an image or video");
                    }
                    break;

                case 'igtv':
                    if(!isset($data['advance_options']['ig_title']) || $data['advance_options']['ig_title'] == ""){
                        $errors[] = __("Instagram requires title for IGTV");
                    }
                    break;
            }

        }

        return $errors;
    }

    public function post_handler($post){
        if($post->api_type == 2){
            return $this->post_unofficial($post);
        }else{
            return $this->post_official($post);
        }
    }

    public function post_official($post){
        $data = json_decode($post->data, false);
        $medias = $data->medias;
        $endpoint = "/".$post->account->pid."/media_publish";
        $upload_endpoint = "/".$post->account->pid."/media";
        $post_type = "media";
        $shortlink_by = shortlink_by($data);

        if( isset( $data->advance_options ) && isset( $data->advance_options->ig_post_type ) ){
            $post_type = $data->advance_options->ig_post_type;
        }

        try
        {
            $caption = shortlink( spintax($data->caption), $data );
            switch ($post_type) {
                case 'story':
                    try {
                        $upload_params = [
                            'media_type' => "STORIES",
                            'video_url' => get_file_url($medias[0]),
                            'caption' => $caption

                        ];
                        $upload_response = $this->fb->post( $upload_endpoint, $upload_params, $post->account->token)->getDecodedBody();
                    } catch (\Exception $e) {
                    }

                    $attempts = 0;
                    do {
                        $attempts++;
                        sleep(2);
                        try {
                            //Publish
                            $params = [
                                'creation_id' => $upload_response['id'],
                            ];

                            $response = $this->fb->post( $endpoint, $params, $post->account->token)->getDecodedBody();

                            if(isset($response["id"])){
                                $media_response = $this->fb->get( "/". $response["id"]."?fields=shortcode", $post->account->token)->getDecodedBody();
                                return [
                                    "status" => "success",
                                    "message" => __('Success'),
                                    "id" => $response["id"],
                                    "url" => "https://www.instagram.com/p/".$media_response['shortcode'],
                                    "type" => $post->type
                                ]; 
                            }
                        } catch (\Exception $e) {}
                    } while($attempts <= 30);

                    return [
                        "status" => "error",
                        "message" => __('The media is not ready for publishing, please wait for a moment'),
                    ]; 

                    break;

                case 'reels':
                    try {
                        $upload_params = [
                            'media_type' => "REELS",
                            'video_url' => get_file_url($medias[0]),
                            'caption' => $caption

                        ];
                        $upload_response = $this->fb->post( $upload_endpoint, $upload_params, $post->account->token)->getDecodedBody();
                    } catch (\Exception $e) {
                    }

                    $attempts = 0;
                    do {
                        $attempts++;
                        sleep(2);
                        try {
                            //Publish
                            $params = [
                                'creation_id' => $upload_response['id'],
                            ];

                            $response = $this->fb->post( $endpoint, $params, $post->account->token)->getDecodedBody();

                            if(isset($response["id"])){
                                $media_response = $this->fb->get( "/". $response["id"]."?fields=shortcode", $post->account->token)->getDecodedBody();
                                return [
                                    "status" => "success",
                                    "message" => __('Success'),
                                    "id" => $response["id"],
                                    "url" => "https://www.instagram.com/p/".$media_response['shortcode'],
                                    "type" => $post->type
                                ]; 
                            }
                        } catch (\Exception $e) {}
                    } while($attempts <= 30);

                    return [
                        "status" => "error",
                        "message" => __('The media is not ready for publishing, please wait for a moment'),
                    ]; 

                    break;
                
                default:
                    
                    if( count($medias) == 1 ){
                        if( is_image($medias[0]) ){
                            $medias[0] = watermark($medias[0], $post->account->team_id, $post->account->id);

                            $upload_params = [
                                'image_url' => get_file_url($medias[0]),
                                'caption' => $caption,
                            ];

                            $upload_response = $this->fb->post( $upload_endpoint, $upload_params, $post->account->token)->getDecodedBody();

                            //Publish
                            $params = [
                                'creation_id' => $upload_response['id'],
                            ];

                            $response = $this->fb->post( $endpoint, $params, $post->account->token)->getDecodedBody();
                            $media_response = $this->fb->get( "/". $response["id"]."?fields=shortcode", $post->account->token)->getDecodedBody();
                            unlink_watermark($medias);

                            return [
                                "status" => "success",
                                "message" => __('Success'),
                                "id" => $response["id"],
                                "url" => "https://www.instagram.com/p/".$media_response['shortcode'],
                                "type" => $post->type
                            ]; 
                        }
                        else
                        {
                            $upload_params = [
                                'media_type' => "VIDEO",
                                'video_url' => get_file_url($medias[0]),
                                'caption' => $caption

                            ];
                            $upload_response = $this->fb->post( $upload_endpoint, $upload_params, $post->account->token)->getDecodedBody();

                            $attempts = 0;
                            do {
                                $attempts++;
                                sleep(2);
                                //Publish
                                $params = [
                                    'creation_id' => $upload_response['id'],
                                ];

                                $response = $this->fb->post( $endpoint, $params, $post->account->token)->getDecodedBody();

                                if(isset($response["id"])){
                                    $media_response = $this->fb->get( "/". $response["id"]."?fields=shortcode", $post->account->token)->getDecodedBody();
                                    return [
                                        "status" => "success",
                                        "message" => __('Success'),
                                        "id" => $response["id"],
                                        "url" => "https://www.instagram.com/p/".$media_response['shortcode'],
                                        "type" => $post->type
                                    ]; 
                                }
                            } while($attempts <= 30);

                            return [
                                "status" => "error",
                                "message" => __('The media is not ready for publishing, please wait for a moment'),
                            ]; 
                        }
                    }else{
                        
                        $media_ids = [];

                        foreach ($medias as $key => $media) {

                            if(is_image($medias[$key])){
                                $medias[$key] = $this->instagram_image_handlers($media, "photo", $post->team_id, $post->account_id);
                                $medias[$key] = watermark($media, $post->account->team_id, $post->account->id);
                                $medias[$key] = get_file_url($medias[$key]);
                                
                                $upload_params = [
                                    'image_url' => $medias[$key],
                                    'caption' => $caption,
                                    'is_carousel_item' => true
                                ];

                            }else{
                                $medias[$key] = get_file_url($medias[$key]);
                                
                                $upload_params = [
                                    'media_type' => "VIDEO",
                                    'video_url' => $medias[$key],
                                    'caption' => $caption,
                                    'is_carousel_item' => true
                                ];
                            }

                            
                            $upload_response = $this->fb->post( $upload_endpoint, $upload_params, $post->account->token)->getDecodedBody();

                            $media_ids[] = $upload_response['id'];
                        }

                        $upload_params = [
                            'media_type' => 'CAROUSEL',
                            'children' => $media_ids,
                            'caption' => $caption
                        ];
                        
                        $upload_response = $this->fb->post( $upload_endpoint, $upload_params, $post->account->token)->getDecodedBody();
  
                        //Publish
                        $params = [
                            'creation_id' => $upload_response['id']
                        ];

                        $response = $this->fb->post( $endpoint, $params, $post->account->token)->getDecodedBody();
                        $media_response = $this->fb->get( "/". $response["id"]."?fields=shortcode", $post->account->token)->getDecodedBody();
                        unlink_watermark($medias);

                        return [
                            "status" => "success",
                            "message" => __('Success'),
                            "id" => $response["id"],
                            "url" => "https://www.instagram.com/p/".$media_response['shortcode'],
                            "type" => $post->type
                        ]; 
                    }

                    break;
            }
        }
        catch (\Exception $e)
        {
            unlink_watermark($medias);
            return [
                "status" => "error",
                "message" => __( $e->getMessage() ),
                "type" => $post->type
            ];
        }
    }

    public function post_unofficial($post){

    }

    public function instagram_image_handlers($file_path, $type, $team_id, $account_id){
        $file_path = get_file_path($file_path);
        $result = false;

        if(stripos($file_path, "https://") !== FALSE){
            $file_data = file_get_contents($file_path);
            $file_path = TMPPATH(ids().".jpg");
            file_put_contents($file_path, $file_data);
        }

        if(get_option('enable_ig_optimize_option', 0)==1){
            // setting
            $setting = array('directory' => TMPPATH());
            if(file_exists($file_path)){
                $ImgCompressor = new ImgCompressor($setting);
                $result = $ImgCompressor->run($file_path, 'jpg', 4); 
                $file_path = $result;
            }
        }
        
        switch ($type) {
            case 'photo':
                $img = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, [
                    "targetFeed" => \InstagramAPI\Constants::FEED_TIMELINE,
                    "operation" => \InstagramAPI\Media\InstagramMedia::CROP
                ]);
                break;

            case 'story':
                $img = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, [
                    "targetFeed" => \InstagramAPI\Constants::FEED_STORY,
                    "operation" => \InstagramAPI\Media\InstagramMedia::CROP
                ]);
                break;

            case 'carousel':
                $img = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, [
                    "targetFeed" => \InstagramAPI\Constants::FEED_TIMELINE_ALBUM,
                    "operation" => \InstagramAPI\Media\InstagramMedia::CROP,
                ]);
                break;
        }

        $img_tmp = TMPPATH(ids().".jpg");
        $img_data = file_get_contents($img->getFile());
        file_put_contents($img_tmp, $img_data);

        $img_tmp = str_replace(WRITEPATH, "", $img_tmp); 

        if($result && file_exists($result)){
            @unlink($result);
        }

        $img = watermark($img_tmp, $team_id, $account_id);
        if($img != $img_tmp){
            @unlink($img_tmp);
        }

        return str_replace( TMPPATH() , "", $img );
    }

}
