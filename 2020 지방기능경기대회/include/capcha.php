<?php 
	include("lib.php");

	$text="1234567890qazxswedcvfrtgbnhyujmkilopQAZXSWEDCVFRTGBNHYUJMKILOP";
	$str="";

	for($i=0;$i<5;$i++)
		$str .= $text[rand(0,strlen($text)-1)];

	$_SESSION['capcha']=$str;

	$img=imagecreatetruecolor(120,20);
	$text_color=imagecolorallocate($img,255,253,40);
	imagestring($img,6,40,0,$str,$text_color);

	imagepng($img);
	imagedestroy($img);
?>