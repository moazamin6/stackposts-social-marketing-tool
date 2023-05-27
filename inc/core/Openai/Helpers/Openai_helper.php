<?php 
if(!function_exists('open_post_curl')){
	function open_post_curl($endpoint, $params)
	{
        $api_path =  "https://api.openai.com/v1/";
        $api_key = get_option("openai_api_key");
        $url = $api_path . $endpoint;

	    $ch = curl_init();
	    $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	    $result = curl_exec($ch);
	    curl_close($ch);

	    return json_decode($result);
	}
}