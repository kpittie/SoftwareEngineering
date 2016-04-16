<?php
/**
 * Created by NOTEPAD++.
 * User: INDRANIL OJHA
 * Date: 14-04-2016
 * Time: 1:10 PM
 */
session_start();
header('Content-type: image/jpeg'); 

$text=$_SESSION['secure'];

$font_size=30;
$image_width=150;
$image_height=40;
$image=imagecreate($image_width,$image_height);//creating the image
imagecolorallocate($image,255,255,255);//background color
$text_color=imagecolorallocate($image,0,0,0);//Text color
for($x=1;$x<=100;$x++)
{
$x1=rand(1,100);
$x2=rand(1,100);
$y1=rand(1,100);
$y2=rand(1,100);
imageline($image,$x1,$y1,$x2,$y2,$text_color);
}

imagettftext($image,$font_size,0,15,30,$text_color,'../../Plugins/captcha4.ttf',$text);
imagejpeg($image);
?>