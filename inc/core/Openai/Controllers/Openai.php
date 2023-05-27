<?php
namespace Core\Openai\Controllers;

class Openai extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function widget( $params = [] ){
        return view('Core\Openai\Views\widget', ['config' => $this->config, "name" => $params["name"]]);
    }

    public function image_widget( $params = [] ){
        return view('Core\Openai\Views\image_widget', ['config' => $this->config]);
    }

    public function popup($name = ""){
        return view('Core\Openai\Views\popup', ['config' => $this->config, "name" => $name]);
    }

    public function image_popup(){
        return view('Core\Openai\Views\image_popup', ['config' => $this->config]);
    }

    public function generate(){
        $suggestion = post("suggestion");
        $max_lenght = (int)post("max_lenght");
        $hashtags = (int)post("hashtags");
        $limit_tokens = (int)permission("openai_limit_tokens");
        $usage_tokens = get_team_data("openai_usage_tokens", 0);

        if($usage_tokens >= $limit_tokens){
            ms([
                "status" => "error",
                "message" => sprintf( __("You've used the reaching of the limit of %s OpenAI tokens"), $limit_tokens)
            ]);
        }
        
        validate("null", __("Suggestion"), $suggestion);

        $result = open_post_curl("completions", [
            'prompt' => trim($suggestion),
            'max_tokens' => $max_lenght?$max_lenght:200,
            'model' => 'text-davinci-003'
        ]);


        if($result == ""){
            ms([
                "status" => "error",
                "message" => __("OpenAI connection timeout")
            ]);
        }

        if( isset($result->error) ){
            ms([
                "status" => "error",
                "message" => __($result->error->message)
            ]);
        }

        $text = $suggestion;
        $usage = $result->usage->total_tokens;
        if ( !empty($result->choices) ) {
            $text = $result->choices[0]->text;
            $trim_text = trim(preg_replace('/\r|\n/', '', $text . '"'));

            if($hashtags){
                $generate_hashtags = open_post_curl("completions", [
                    'prompt' => "Generate exactly {$hashtags} hashtags from this text: ".$trim_text,
                    'max_tokens' => 2048,
                    'model' => 'text-davinci-003'
                ]);

                if ( !empty($generate_hashtags->choices) ) {
                    $hashtags = trim(preg_replace('/\r|\n/', '', $generate_hashtags->choices[0]->text));
                    $text .= ' ' . $hashtags;
                    $usage += $generate_hashtags->usage->total_tokens;
                }
            }
        }

        update_team_data("openai_usage_tokens", get_team_data("openai_usage_tokens", 0) + $usage);

        ms([
            "status" => "success",
            "message" => "Success",
            "data" => trim($text)
        ]);
    }

    public function generate_image(){
        $suggestion = post("suggestion");
        $size = post("size");

        validate("null", __("Suggestion"), $suggestion);

        if($size != "256x256" && $size != "512x512" && $size != "1024x1024"){
            ms([
                "status" => "error",
                "message" => __("OpenAI just support size 256x256, 512x512, 1024x1024")
            ]);
        }

        $result = open_post_curl("images/generations", [
            'prompt' => trim($suggestion),
            'size' => $size
        ]);

        if($result == ""){
            ms([
                "status" => "error",
                "message" => __("OpenAI connection timeout")
            ]);
        }

        if( isset($result->error) ){
            ms([
                "status" => "error",
                "message" => __($result->error->message)
            ]);
        }

        ms([
            "status" => "success",
            "message" => "Success",
            "data" => $result->data[0]->url
        ]);
    }
}