<?php
if (!function_exists('watermark')) {
	function watermark($path_image, $team_id = false, $account_id = false){
		if (get_team_data("watermark_status", 1)) {
			try {
				if( permission( 'watermark', $team_id ) ){
					$save_image =  TMPPATH(uniqid().'.jpg');
					include realpath( __DIR__."/../Libraries/vendor/autoload.php" );
					include realpath( __DIR__."/../Libraries/watermark.lib.php" );

					if(!$team_id){
						$team_id = _t("id");
					}

					$watermark_mask = _gm("watermark_mask", "", $account_id);
					$watermark_size = _gm("watermark_size", 30, $account_id);
					$watermark_opacity = _gm("watermark_opacity", 70, $account_id);
					$watermark_position = _gm("watermark_position", "lb", $account_id);

					if(!$watermark_mask || !$watermark_size || !$watermark_opacity || !$watermark_position){
						$watermark_mask = get_team_data("watermark_mask", "", $team_id);
					    $watermark_size = get_team_data("watermark_size", 30, $team_id);
					    $watermark_opacity = get_team_data("watermark_opacity", 70, $team_id);
					    $watermark_position = get_team_data("watermark_position", "lb", $team_id);
					}

					$watermark_mask = get_file_path($watermark_mask);
					if( file_exists($watermark_mask) && is_file($watermark_mask)){
					    $watermark = new Watermark_lib();
					    $path_image = WRITEPATH.$path_image;
					    if($save_image == ""){
							$save_image = $path_image;
						}

					    $watermark->apply($path_image, $save_image, $watermark_mask, $watermark_position, $watermark_size, $watermark_opacity/100);
					    return str_replace( TMPPATH(), "tmp/", $save_image);
					}else{
						return $path_image;
					}
				}	
			} catch (Exception $e) {
				return $path_image;
			}
		}

		return $path_image;
	}
}

if(!function_exists("unlink_watermark")){
	function unlink_watermark($image_paths){
		if(!empty($image_paths)){
			foreach ($image_paths as $image_path) {
				if( stripos($image_path, "tmp/") !== FALSE ){
					$image_path = str_replace(base_url(), "", $image_path);
					if(file_exists(WRITEPATH.$image_path)){
						unlink(WRITEPATH.$image_path);
					}
				}
			}
		}
	};
}