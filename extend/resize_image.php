<?
// 큰이미지 리사이즈 및 썸네일 만들기 __2010-10-12 by 균이

//리사이징 이미지의 $wr_id 및 첨부순번($bf_no)이 반드시 필요함
function image_resizetg($org_img, $thumbx=600, $thumby=500,  $bo_table='', $wr_id, $bf_no){
global $g4, $config;
if(!$wr_id || !is_numeric($bf_no)) return;

 $img_path = "$g4[path]/data/file/$bo_table/";
 $img=$img_path. $org_img;
 $info=@getimagesize($img);
 $x=$info[0]; $y=$info[1]; $z=$info[2];
$img_old = "{$img}.old";

if($x>$thumbx || $y>$thumby){
 if($x>=$y){	$xx = $thumbx; $yy =ceil($y * $thumbx / $x); 
     if($yy>$thumby){$yy = $thumby; $xx =ceil($x * $thumby / $y); }
  } else{$yy = $thumby; $xx =ceil($x * $thumby / $y); }
	
} else{$xx = $x; $yy = $y; }

 rename( $img, $img_old);

	switch($z) {
	 case(1) :
	  if(function_exists('ImageCreateFromGif')) $src_img = ImageCreateFromGif($img_old);  break;
	 case(2) :
	  if(function_exists('ImageCreateFromJpeg')) $src_img = ImageCreateFromJpeg($img_old);	break;
	  case(3) :
		if(function_exists('ImageCreateFromPng')) $src_img = ImageCreateFromPng($img_old);	break;
	  }

     if(! $src_img) {rename( $img_old, $img); unset($src_img); return; }

 if(function_exists('ImageCreateTrueColor'))  $newimg = ImageCreateTrueColor($xx, $yy);
   else $newimg = ImageCreate($xx, $yy);

  if(function_exists('ImageCopyResampled'))
	  ImageCopyResampled($newimg, $src_img , 0,0,0,0, $xx, $yy, $x, $y ); 
  else ImageCopyResized($newimg, $src_img , 0,0,0,0, $xx, $yy, $x, $y ); 

if($z==1) imagegif($newimg, $img);
else if($z==2) imagejpeg($newimg, $img, 90); 
else imagepng($newimg, $img);

ImageDestroy($newimg); 
imagedestroy($src_img);
unset($src_img); 
unset($newimg); 
if(file_exists($img)) @unlink($img_old);
else rename( $img_old, $img); 

$size=filesize($img);
sql_query("update $g4[board_file_table] set  bf_filesize='$size', bf_width='$xx', bf_height ='$yy' where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no='$bf_no' ");

clearstatcache();
$wh[0]=$xx; $wh[1]=$yy;
return $wh;
}

////////////////////////////////////썸네일 만들기
function tg_thumb($img_src,$width='100', $height='70',$bo_table, $wr_id, $bf_no){
global $g4;
  $thumbx2=$thumbx= $width;
  $thumby2=$thumby=$height;


$img_path="$g4[path]/data/file/$bo_table";
$img = "$img_path/$img_src";
$thumb_path = "{$img_path}/thumbs";
$thumb_file = "{$thumb_path}/{$wr_id}_{$bf_no}.jpg";

		@mkdir($thumb_path);
		@chmod($thumb_path, 0707);

    if( !is_file($img)) return "file not exists";
	if(is_file($thumb_file)) return;

 $info=@getimagesize($img);
 $x=$info[0]; $y=$info[1]; $z=$info[2];

 if($z==0 || $z >3 ) return;
 if( $x <=$small_width && $y <= $small_height) return 'org';

	switch($z) {
	 case(1) :
	  if(function_exists('ImageCreateFromGif')) $src_img = ImageCreateFromGif($img);
	  break;
	 case(2) :
	  if(function_exists('ImageCreateFromJpeg')) $src_img = ImageCreateFromJpeg($img);
		break;
	  case(3) :
		if(function_exists('ImageCreateFromPng')) $src_img = ImageCreateFromPng($img);
		break;
	  }
     if(! $src_img) { unset($src_img); return "thum create fail"; }



	 $xx = $thumbx; $yy =ceil($y * $thumbx / $x); 
     if( $yy< $thumby){ $thumbx2 += ceil($thumbx2*0.5);
	      $xx = $thumbx2; $yy =ceil($y * $thumbx2 / $x); 
	 }

    $new_xx=$new_yy = 0;
 	 if($xx>$thumbx)  $new_xx = ceil( ($xx - $thumbx)/2 ) * -1;
     if($yy>$thumby) $new_yy= ceil( ($yy - $thumby)/3 ) * -1;

//   if($yy<$thumby) $yy=$thumby;

   if(function_exists('ImageCreateTrueColor'))  $newimg = ImageCreateTrueColor($thumbx, $thumby);
   else $newimg = ImageCreate($thumbx, $thumby);

  if(function_exists('ImageCopyResampled'))
	  ImageCopyResampled($newimg, $src_img , $new_xx,$new_yy,0,0, $xx, $yy, $x, $y ); 
  else ImageCopyResized($newimg, $src_img , $new_xx,$new_yy,0,0, $xx, $yy, $x, $y ); 

imagejpeg($newimg, $thumb_file, 95); 
ImageDestroy($newimg); 
imagedestroy($src_img);
unset($src_img); 
unset($newimg); 

return;
}

?>
