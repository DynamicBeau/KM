<?php
define('EMPTY_STRING', '');
//이미지 타입 설정
header('Content-type: image/png');

/*

<a href='<?=$g4[istown_path]?>/group.php?gr_id=<?=$gr_id?>' style="font-weight:bolder;font-size:17px; color:#ffffff;"><img src="txt2img.php?width=500&height=25&color=green&font=pen&left=0&font_size=18&txt=<?=$group[gr_subject]?>" alt="그룹 카테고리" /></a> 

*/


//이미지 가로 세로의 크기 (GET으로 받아옴)
$im = imagecreatetruecolor($_GET['width'], $_GET['height']);

// 이미지 텍스트의 색상을 정의 RGB
$white = imagecolorallocate($im, 255, 255, 255);
$gray = imagecolorallocate($im, 128, 128, 128);
$magenta = imagecolorallocate($im, 255, 0, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$violet = imagecolorallocate($im, 157, 60, 255);
$blue = imagecolorallocate($im, 68, 162, 255);
$gray = imagecolorallocate($im, 80, 80, 80);
$red = imagecolorallocate($im, 234, 0, 0);
$green = imagecolorallocate($im, 148, 203, 49);

$host_user = "webs_protest2";	// FTP 유져아이디 넣기


// 텍스트 이미지 기울기 설정 
imagefilledrectangle($im, 0, 0, $_GET['width'], $_GET['height'], $white);

// 폰트의 경로를 작성합니다.(네이버 나눔폰트)
$font_gothic_bold = '/home/hosting_users/'.$host_user.'/www/fonts/NanumGothicBold.ttf';
$font_pen = '/home/hosting_users/'.$host_user.'/www/fonts/NanumPen.ttf';
$font_jo = '/home/hosting_users/'.$host_user.'/www/fonts/NanumMyeongjoBold.ttf';

$font_yun310 = '/home/hosting_users/'.$host_user.'/www/fonts/yun310.ttf';
$font_yun320 = '/home/hosting_users/'.$host_user.'/www/fonts/yun320.ttf';
$font_yun330 = '/home/hosting_users/'.$host_user.'/www/fonts/yun330.ttf';
$font_yun340 = '/home/hosting_users/'.$host_user.'/www/fonts/yun340.ttf';
$font_yun350 = '/home/hosting_users/'.$host_user.'/www/fonts/yun350.ttf';
$font_yun360 = '/home/hosting_users/'.$host_user.'/www/fonts/yun360.ttf';

/*
영문
*/
$font_san1 = '/home/hosting_users/'.$host_user.'/www/fonts/Sansation_Bold.ttf';
$font_san2 = '/home/hosting_users/'.$host_user.'/www/fonts/Sansation_Bold_Italic.ttf';
$font_san3 = '/home/hosting_users/'.$host_user.'/www/fonts/Sansation_Light.ttf';
$font_san4 = '/home/hosting_users/'.$host_user.'/www/fonts/Sansation_Regular.ttf';


// 폰트 설정
if($_GET['font'] == 'pen'){
  $font = $font_pen;
}else if($_GET['font']== 'jo'){
	$font = $font_san1;
}else if($_GET['font']== 'san1'){
	$font = $font_san2;
}else if($_GET['font']== 'san2'){
	$font = $font_san3;
}else if($_GET['font']== 'san3'){
	$font = $font_san4;
}else if($_GET['font']== 'san4'){
	$font = $font_jo;
}else if($_GET['font']== 'yun310'){
	$font = $font_yun310;
}else if($_GET['font']== 'yun320'){
	$font = $font_yun320;
}else if($_GET['font']== 'yun330'){
	$font = $font_yun330;
}else if($_GET['font']== 'yun340'){
	$font = $font_yun340;
}else if($_GET['font']== 'yun350'){
	$font = $font_yun350;
}else if($_GET['font']== 'yun360'){
	$font = $font_yun360;
}else{
	$font = $font_gothic_bold;
}

$text = foxy_utf8_to_nce($_GET['txt']);

$int_x = $_GET['left'];
$int_y = ($_GET['height'] / 2) + ($_GET['font_size'] / 2);


// get으로 받아온 색상값에 따라서 텍스트 이미지 생상 지정
if($_GET['color'] == 'black'){
imagettftext($im, $_GET['font_size'], 0, $int_x , $int_y, $black, $font, $text);
}elseif($_GET['color'] == 'blue'){
imagettftext($im, $_GET['font_size'], 0, $int_x , $int_y, $blue, $font, $text);
}elseif($_GET['color'] == 'gray'){
imagettftext($im, $_GET['font_size'], 0, $int_x , $int_y, $gray, $font, $text);
}elseif($_GET['color'] == 'red'){
imagettftext($im, $_GET['font_size'], 0, $int_x , $int_y, $red, $font, $text);
}elseif($_GET['color'] == 'green'){
imagettftext($im, $_GET['font_size'], 0, $int_x , $int_y, $green, $font, $text);	
}elseif($_GET['color'] == 'violet'){
imagettftext($im, $_GET['font_size'], 0, $int_x , $int_y, $violet, $font, $text);	
}

// imagepng()함수가 imagejpeg() 함수보다 텍스트가 더 깨끗하게 표현됨
imagecolortransparent($im, $white); 
imagepng($im);
imagedestroy($im);

// imagettftext 함수에서 한글 UTF-8 방식의 오류를 보정한다.
function foxy_utf8_to_nce(
  $utf = EMPTY_STRING
) {
  if($utf == EMPTY_STRING) return($utf);

  $max_count = 5; // flag-bits in $max_mark ( 1111 1000 == 5 times 1)
  $max_mark = 248; // marker for a (theoretical ;-)) 5-byte-char and mask for a 4-byte-char;

  $html = EMPTY_STRING;
  for($str_pos = 0; $str_pos < strlen($utf); $str_pos++) {
    $old_chr = $utf{$str_pos};
    $old_val = ord( $utf{$str_pos} );
    $new_val = 0;

    $utf8_marker = 0;

    // skip non-utf-8-chars
    if( $old_val > 127 ) {
      $mark = $max_mark;
      for($byte_ctr = $max_count; $byte_ctr > 2; $byte_ctr--) {
        // actual byte is utf-8-marker?
        if( ( $old_val & $mark  ) == ( ($mark << 1) & 255 ) ) {
          $utf8_marker = $byte_ctr - 1;
          break;
        }
        $mark = ($mark << 1) & 255;
      }
    }

    // marker found: collect following bytes
    if($utf8_marker > 1 and isset( $utf{$str_pos + 1} ) ) {
      $str_off = 0;
      $new_val = $old_val & (127 >> $utf8_marker);
      for($byte_ctr = $utf8_marker; $byte_ctr > 1; $byte_ctr--) {

        // check if following chars are UTF8 additional data blocks
        // UTF8 and ord() > 127
        if( (ord($utf{$str_pos + 1}) & 192) == 128 ) {
          $new_val = $new_val << 6;
          $str_off++;
          // no need for Addition, bitwise OR is sufficient
          // 63: more UTF8-bytes; 0011 1111
          $new_val = $new_val | ( ord( $utf{$str_pos + $str_off} ) & 63 );
        }
        // no UTF8, but ord() > 127
        // nevertheless convert first char to NCE
        else {
          $new_val = $old_val;
        }
      }
      // build NCE-Code
      $html .= '&#'.$new_val.';';
      // Skip additional UTF-8-Bytes
      $str_pos = $str_pos + $str_off;
    }
    else {
      $html .= chr($old_val);
      $new_val = $old_val;
    }
  }
  return($html);
}

?>


