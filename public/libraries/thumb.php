<?

	// Caching
	// Set this true/false, set the directory
	
	$cache = True;
	$cache_dir = "../userfiles/cache/";
	
	$_GET['type'] = substr($_GET['src'],-3,4);
	if($_GET['type'] == "peg") $_GET['type'] = "jpeg";
	
	//print_r($_GET); die();
	
	if(!file_exists("../userfiles/")) mkdir("../userfiles/",0777);
	if(!file_exists("../userfiles/cache/")) mkdir("../userfiles/cache/",0777);

	/////////////////////////////////////////
	//                                     //
	//  Simple thumbnail library           //
	//                                     //
	//  @author Marcau Alexandru           //
	//  @website http://www.cealeg.ro/     //
	//                                     //
	/////////////////////////////////////////
	
	// Check for cached file
	
	if(!$_GET['type']) $_GET['type'] = "jpg";
	$cachename = base64_encode(implode("|",$_GET)).".".$_GET['type'];
	
	if(file_exists($cache_dir.$cachename)){

		switch($type){
			case "jpg": header('Content-type: image/jpeg'); break;
			case "jpeg": header('Content-type: image/jpeg'); break;
			case "gif": header('Content-type: image/gif'); break;
			case "png": header('Content-type: image/png'); break;
			default: header('Content-type: image/jpeg');
		}
		
		echo file_get_contents($cache_dir.$cachename);
		exit;

	}
	
	// Default values if not specified
	
	$default_action = "none";
	$default_border = "949494";
	
	$action = (($_GET['action'])?$_GET['action']:$default_action);
	$border = (($_GET['border']=="none")?false:(($_GET['border'])?$_GET['border']:$default_border));
	
	if($_GET['type'] == "jpg" or $_GET['type'] == "jpeg" or $_GET['type'] == "gif" or $_GET['type'] == "png"){
		$type = $_GET['type'];
	}
	else $type = "jpg";
	
	// If no file is specified, show an error
	
	$_GET['src'] = "../".$_GET['src'];
	
	if(!file_exists($_GET['src'])){
		error("Cannot open the file ".$_GET['src']."!");
	}
	elseif(is_dir($_GET['src'])){
		error("The source file is a dir: ".$_GET['src']."!");
	}
	else {
		$src = $_GET['src'];
	}

	// If none of width or height is specified, show an error
	
	if(!is_numeric($_GET['w']) and !is_numeric($_GET['h'])){
		error("You must specify at least width or height of the picture!");
	}
	else {
		if($_GET['w']) $final_image_width = $_GET['w'];
		if($_GET['h']) $final_image_height = $_GET['h'];
		
		// If just one size was specified, go single size mode
		
		if($final_image_width and !$final_image_height) $single_size_mode_width = True;
		if(!$final_image_width and $final_image_height) $single_size_mode_height = True;		
	}
	
	// Open the source image
	
	$fileinfo = getimagesize($src);
	
	switch($fileinfo['mime']){
		case "image/jpeg": $imagesrc = imagecreatefromjpeg($src); break;
		case "image/gif": $imagesrc = imagecreatefromgif($src); break;
		case "image/png": $imagesrc = imagecreatefrompng($src); break;
		default: error("Cannot show the image because the source file type is unknown!");
	}
	
	// Get current width and height
	
	$current_width = imagesx($imagesrc);
	$current_height = imagesy($imagesrc);
	
	// Resize the picture

	if($single_size_mode_width or $single_size_mode_height){
	
		if($single_size_mode_width){
			
			$width = round($final_image_width);
			$height = round($current_height/($current_width/$final_image_width));
			
		}
		if($single_size_mode_height){
			
			$width = round($current_width/($current_height/$final_image_height));
			$height = round($final_image_height);
		
		}
		
		$final_image = imagecreatetruecolor($width, $height);
		imagesavealpha($final_image, true);
		$black = imagecolorallocate($final_image, 0, 0, 0);
		imagefilledrectangle($final_image, 0, 0, $width, $height, $black);
		$trans_colour = imagecolorallocatealpha($final_image, 0, 0, 0, 127);
		imagefill($final_image, 0, 0, $trans_colour);
		imagecopyresampled($final_image, $imagesrc, 0, 0, 0, 0, $width, $height, $current_width, $current_height);

		// Prevent other actions from happening
		
		$action = "other";

	}
	
	if($action == "far" or $action == "none"){
		
		// Do the math
		
		$percent_new = $final_image_width/$final_image_height;
		$percent_current = $current_width/$current_height;
		
		if($percent_current >= $percent_new){ $width = round($final_image_width); $height = round($current_height/($current_width/$final_image_width)); }
		else { $width = round($current_width/($current_height/$final_image_height)); $height = round($final_image_height); }
		
		// Resize the image to fit the new size
		
		$imageresampled = imagecreatetruecolor($width, $height);
		imagesavealpha($imageresampled, true);
		$black = imagecolorallocate($imageresampled, 255, 255, 255);
		imagefilledrectangle($imageresampled, 0, 0, $width, $height, $black);
		imagecopyresampled($imageresampled, $imagesrc, 0, 0, 0, 0, $width, $height, $current_width, $current_height);
		
		// If the action is none, the job is finished
		
		if($action == "none") $final_image = $imageresampled;
		
		// Force the aspect ratio
		
		if($action == "far") {
		
			// Make a white image
			
			$final_image = imagecreatetruecolor($final_image_width,$final_image_height);
			
			if($farcolor != "transparent"){
				if(!$farcolor) $farcolor = "FFF";
				$farcolor = hex2dec($farcolor);
			}
			
			$farcolorallocate = imagecolorallocate ($final_image, $farcolor['red'], $farcolor['green'], $farcolor['blue']);
			imagefill($final_image, 0, 0, $farcolorallocate);
			
			// Apply transparency to far color and force image to be png or gif
			
			if($farcolor == "transparent"){
				imagecolortransparent($final_image, $farcolorallocate);
				if($type != "png" and $type != "gif") $type = "png";
			}
			
			// Merge the resampled image
			
			imagecopymerge($final_image,$imageresampled,($final_image_width-$width)/2,($final_image_height-$height)/2,0,0,$width,$height,100);
			imagecolortransparent($final_image, $black);
			//header('Content-type: image/png'); imagepng($final_image); die();
		}
		
	}
	
	// Make zoom-crop mode
	
	if($action == "zc"){
		
		// Do the math
		
		$percent_new = $final_image_width/$final_image_height;
		$percent_current = $current_width/$current_height;
		
		if($percent_current >= $percent_new){
		
			// We have to crop left|right
		
			$width = round($current_width/($current_height/$final_image_height));
			$height = round($final_image_height);
			
			$slice_ver = 0;
			$slice_hor = ($current_width-$current_height*($final_image_width/$final_image_height))/2;
		
		}
		else {
		
			// We have to crop top|bottom
		
			$width = round($final_image_width);
			$height = round($current_height/($current_width/$final_image_width));

			$slice_ver = ($current_height-$current_width*($final_image_height/$final_image_width))/2;
			$slice_hor = 0;
		
		}

		// Resample and crop the picture
		
		$imageresampled = imagecreatetruecolor($final_image_width, $final_image_height);
		
		imagesavealpha($imageresampled, true);
		$black = imagecolorallocate($imageresampled, 0, 0, 0);
		imagefilledrectangle($imageresampled, 0, 0, $final_image_width, $final_image_height, $black);
		$trans_colour = imagecolorallocatealpha($imageresampled, 0, 0, 0, 127);
		imagefill($imageresampled, 0, 0, $trans_colour);
		imagecopyresampled($imageresampled, $imagesrc, 0, 0, $slice_hor, $slice_ver, $width, $height, $current_width, $current_height);
		
		$final_image = $imageresampled;
		
	}
	
	// Draw a border
	
	if($border){

		$bordercolor = hex2dec($border);
		$bordercolorallocate = imagecolorallocate($final_image, $bordercolor['red'], $bordercolor['green'], $bordercolor['blue']);
		$final_image = draw_border($final_image, $bordercolorallocate, 1);

	}
	
	// Round corners

	if($_GET['radius']) $radius = $_GET['radius'];
	if($_GET['cornercolor']) $cornercolor = $_GET['cornercolor'];
	
	if($radius){
		
		$final_image = round_corners($final_image,$radius,$cornercolor);

	}
	
	// Apply a watermark

	if($_GET['watermark']) $watermark = $_GET['watermark'];
	
	if($watermark){
	
		$imagewatermark = imagecreatefrompng($watermark);
		
		$watermark_width = imagesx($imagewatermark);
		$watermark_height = imagesy($imagewatermark);
		
		$source_width = imagesx($final_image);
		$source_height = imagesy($final_image);
		
		if($_GET['watermarkx']) $positionx = $_GET['watermarkx'];
		else $positionx = ($source_width-$watermark_width)/2;
		if($_GET['watermarky']) $positiony = $_GET['watermarky'];
		else $positiony = ($source_height-$watermark_height)/2;
		
		apply_watermark($final_image,$imagewatermark,$positionx,$positiony,0,0,$watermark_width,$watermark_height,100);
	
	}
	
	// Show the picture
	
	switch($type){
		case "jpg":
			header('Content-type: image/jpeg');
			if($cache) imagejpeg($final_image,$cache_dir.$cachename,100);
			imagejpeg($final_image,null,100);
			break;
		case "jpeg":
			header('Content-type: image/jpeg');
			if($cache) imagejpeg($final_image,$cache_dir.$cachename,100);
			imagejpeg($final_image,null,100);
			break;
		case "gif":
			header('Content-type: image/gif');
			if($cache) imagegif($final_image,$cache_dir.$cachename,100);
			imagegif($final_image,null,100);
			break;
		case "png":
			header('Content-type: image/png');
			if($cache) imagepng($final_image,$cache_dir.$cachename,0);
			imagepng($final_image,null,0);
			break;
		default:
			header('Content-type: image/jpeg');
			if($cache) imagejpeg($final_image,$cache_dir.$cachename,100);
			imagejpeg($final_image,null,100);
	}
	
	imagedestroy($final_image);
	
	function draw_border($final_image, $color_black, $thickness = 1){
		
		$x1 = 0;
		$y1 = 0;
		$x2 = ImageSX($final_image) - 1;
		$y2 = ImageSY($final_image) - 1;

		for($i = 0; $i < $thickness; $i++){
			ImageRectangle($final_image, $x1++, $y1++, $x2--, $y2--, $color_black);
		}
		
		return $final_image;
		
	}
	function round_corners($final_image,$radius,$cornercolor="transparent"){
		
		// Get size of the final image
		
		$source_width = imagesx($final_image);
		$source_height = imagesy($final_image);
		
		// Get the color of the corners
		
		if($cornercolor && $cornercolor != "transparent") $cornercolor = hex2dec($_GET['cornercolor']);
		else $cornercolor = "transparent";
			
		// Create the corners
		
		$corner_image = imagecreatetruecolor($radius,$radius);
		$clear_cornercolor = imagecolorallocate($corner_image,0,0,0);
		imagecolortransparent($corner_image,$clear_cornercolor);
		
		if($cornercolor == "transparent"){

			// Find a color not used in the picture
		
			$palette = imagecreatetruecolor(400, 400);
			$found = false;
			while($found == false) {
			   
				$r = rand(0, 255);
				$g = rand(0, 255);
				$b = rand(0, 255);
			   
				if(imagecolorexact($final_image, $r, $g, $b) != (-1)) {
				   
					$colorcode = imagecolorallocate($palette, $r, $g, $b);
					$found = true;
				
				}
			   
			}
			
			$solid_cornercolor = imagecolorallocate($corner_image, $r, $g, $b);
			imagecolortransparent($final_image,$solid_cornercolor);

			// Force type to be gif or png
			
			if($GLOBALS['type'] != "png" and $GLOBALS['type'] != "gif") $GLOBALS['type'] = "png";		
			
		}
		else {
			$solid_cornercolor = imagecolorallocate($corner_image, $cornercolor['red'], $cornercolor['green'], $cornercolor['blue']);
		}

		imagefill($corner_image,0,0,$solid_cornercolor);
		imagefilledellipse($corner_image,$radius,$radius,$radius * 2,$radius * 2,$clear_cornercolor);
		imagecopymerge($final_image,$corner_image,0,0,0,0,$radius,$radius,100);
		$corner_image = imagerotate($corner_image, 90, 0);
		imagecopymerge($final_image,$corner_image,0,$source_height - $radius,0,0,$radius,$radius,100);
		$corner_image = imagerotate( $corner_image, 90, 0 );
		imagecopymerge($final_image,$corner_image,$source_width - $radius,$source_height - $radius,0,0,$radius,$radius,100);
		$corner_image = imagerotate( $corner_image, 90, 0 );
		imagecopymerge($final_image,$corner_image,$source_width - $radius,0,0,0,$radius,$radius,100);
		return $final_image;
		
	}
	function hex2dec($hex){
	
		// Clean the hex and check if it's valid
	
		$hex = trim($hex);
		if(!preg_match("/^#?[0-9ABCDEFabdcd]{3,6}$/i",$hex)) error("Invalid hex color!");
		$hex = str_replace("#","",$hex);
		if(strlen($hex) != 3 and strlen($hex) != 6) error("Invalid hex color!");
		
		// Check if the hex is 3 charactioners and make it 6 charactioners
		
		if(strlen($hex) == 3) $finalhex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
		if(strlen($hex) == 6) $finalhex = $hex;
		
		// Convert to rgb
		
		$rgb['red'] = hexdec(substr($finalhex,0,2));
		$rgb['green'] = hexdec(substr($finalhex,2,2));
		$rgb['blue'] = hexdec(substr($finalhex,4,2));
		
		// Return the value
		
		return $rgb;
		
	}
	function error($error_message){

		$error_message = wordwrap($error_message, 36, "|||");
		$errors = explode("|||",$error_message);
		
		$im = imagecreatetruecolor(300, 100);
		
		$text_color = imagecolorallocate($im, 255, 255, 255);
		
		if($errors[0]) imagestring($im, 3, 12, 10, $errors[0], $text_color);
		if($errors[1]) imagestring($im, 3, 12, 25, $errors[1], $text_color);
		if($errors[2]) imagestring($im, 3, 12, 40, $errors[2], $text_color);
		if($errors[3]) imagestring($im, 3, 12, 55, $errors[3], $text_color);
		
		$errorcolor = hex2dec("949494");
		$errorcolorallocate = imagecolorallocate($im, $errorcolor['red'], $errorcolor['green'], $errorcolor['blue']);
		$im = draw_border($im, $errorcolorallocate, 1);
		
		header('Content-type: image/png');
		imagepng($im, NULL, 8);
		imagedestroy($im);
		die();
		
	}
	function apply_watermark($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		if(!isset($pct)){
			return false;
		}
		$pct /= 100;
		// Get image width and height
		$w = imagesx( $src_im );
		$h = imagesy( $src_im );
		// Turn alpha blending off
		imagealphablending( $src_im, false );
		// Find the most opaque pixel in the image (the one with the smallest alpha value)
		$minalpha = 127;
		for( $x = 0; $x < $w; $x++ )
		for( $y = 0; $y < $h; $y++ ){
			$alpha = ( imagecolorat( $src_im, $x, $y ) >> 24 ) & 0xFF;
			if( $alpha < $minalpha ){
				$minalpha = $alpha;
			}
		}
		//loop through image pixels and modify alpha for each
		for( $x = 0; $x < $w; $x++ ){
			for( $y = 0; $y < $h; $y++ ){
				//get current alpha value (represents the TANSPARENCY!)
				$colorxy = imagecolorat( $src_im, $x, $y );
				$alpha = ( $colorxy >> 24 ) & 0xFF;
				//calculate new alpha
				if( $minalpha !== 127 ){
					$alpha = 127 + 127 * $pct * ( $alpha - 127 ) / ( 127 - $minalpha );
				} else {
					$alpha += 127 * $pct;
				}
				//get the color index with new alpha
				$alphacolorxy = imagecolorallocatealpha( $src_im, ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha );
				//set pixel with the new color + opacity
				if( !imagesetpixel( $src_im, $x, $y, $alphacolorxy ) ){
					return false;
				}
			}
		}
		// The image copy
		imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
	} 
	
?>