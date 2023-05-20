<?php
$allow_site = ''; // for security

/*========================================================

 DO NOT EDIT BELOW THIS LINE

=========================================================*/
error_reporting(0);
if (!preg_match('@^http://(www\.)?'.preg_quote($allow_site).'@', $_SERVER['HTTP_REFERER'])) exit;

putenv('GDFONTPATH='.realpath('./'));

$fname = $_GET['font']; // font name
$fsize = $_GET['size']; // font size
$bgcolor = $_GET['bgcolor'] or 'FFFFFF'; // background color
$txtcolor = $_GET['txtcolor'] or '000000'; // text color
$notcolor = $_GET['notcolor'] or '000000'; // notice color

$text = $_GET['text'];
$bound = imagettfbbox($fsize, 0, $fname, $text);
$width = max($bound[2],$bound[4])+10;
$height = $fsize * 1.5;

// create an image
$im = imagecreatetruecolor($width, $height);

// anti-aliasing
if (function_exists('imageantialias')) imageantialias($im, true);

list($r,$g,$b) = txt2rgb($bgcolor);
$bgcol = imagecolorallocate($im, $r, $g, $b);

list($r,$g,$b) = txt2rgb($_GET['notice']==='true'?$notcolor:$txtcolor);
$txtcol = imagecolorallocate($im, $r, $g, $b);
imagefill($im, 0, 0, $bgcol);
imagettftext($im, $fsize, 0, 5, $height*0.8, $txtcol, $fname, $text);
imagetruecolortopalette($im, true, 256);

// set transparent color
$bgcol = imagecolorat($im, 1, 1); // color of (1,1) is background!
imagecolortransparent($im, $bgcol);

// print out
header("Content-type: " . image_type_to_mime_type(IMAGETYPE_GIF));
imagegif($im);
imagedestroy($im);

function txt2rgb($txt) {
	return array(
		hexdec(substr($txt,0,2)),
		hexdec(substr($txt,2,2)),
		hexdec(substr($txt,4,2))
	);
}
?>
