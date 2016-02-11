<?php
	session_start();
	$file=$_SESSION["name"];
	$first=explode(".", $file);

	if($_SESSION["id"]==(int)$_GET["id"]){
	header("content-type:image/jpeg");
	$image=imagecreatefromjpeg("hb.jpg");
	$magnet=$_GET["magnet"];
	$color=imagecolorallocate($image,85,150,153);
	$fontfile='./x.ttf';
	//imagestring($image, 5, 60, 180, $magnet, $color);
	imagettftext($image, 22, 0, 15, 400, $color, $fontfile, $magnet);



	ob_clean();
	imagejpeg($image);
	imagejpeg($image,$first[0].".jpg",75);
	imagedestroy($image);
	//echo $first[0].".jpg";

	$zip= file_get_contents($file);
	file_put_contents($first[0].".jpg", $zip,FILE_APPEND);
	rename($first[0].".jpg", "image/".$first[0].".jpg");
	//unlink($file);
	rename($file, "zip/".$file);
	

	}

?>