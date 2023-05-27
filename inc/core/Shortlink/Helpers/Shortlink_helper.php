<?php 
use PHPLicengine\Api\Api;
use PHPLicengine\Service\Bitlink;

if( ! function_exists('shortlink') ){
    function shortlink($text = '', $by = true){
        $pattern = '~[a-z]+://\S+~';
		$shortlinks = [];
		if($num_found = preg_match_all($pattern, $text, $out))
		{

			switch ($by) {
				case 'bitly':
					
					foreach ($out[0] as $key => $value) {
						$api = new Api( get_team_data("bitly_access_token", "") );
						$bitlink = new Bitlink($api);
						$result = $bitlink->createBitlink(['long_url' => $value]);

					    if ($result->isError()) {
					        //print($result->getResponse());
					        //print($result->getDescription());
					    } else {
					        // if Bitly response is 200 or 201
					        if ($result->isSuccess()) {
					            $response = $result->getResponseObject();
					            $text = str_replace($value, $response->link, $text);
					        } else {
					            //print_r($result->getResponseArray());
					        }
					    }
				  	}

					break;
				
				default:
					return $text;
					break;
			}
		  	
		}

		return $text;
    }
}


if( ! function_exists('shortlink_by') ){
    function shortlink_by($data){
    	if(is_array($data) && !empty($data)){
    		$data = json_encode($data);
    		$data = json_decode($data);
		}
        
        if( isset( $data->advance_options ) && isset( $data->advance_options->shortlink ) && $data->advance_options->shortlink != "" ){
            return $data->advance_options->shortlink;
        }
        return false;
    }
}
