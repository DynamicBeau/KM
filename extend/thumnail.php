<?php

/*
�̸� : get_image_resource_from_file

�뵵 : �̹�������(gif, jpg, png �� ����)�κ��� �̹��� ���ҽ��� �����Ѵ�

������ ���ϰ� : �̹��� ���ҽ� id �� getimagesize �� �޾ƿ� �̹��� ������ �迭�� ��ȯ
==> Array(0=>image resource, 1=>image width, 2=>image height, 3=>image type, 4=>image attribute);

���н� ���ϰ� : �� �迭 ��ȯ
==> Array()

���� :
==> $path_file : �̹����� ������ �Ǵ� �����
*/

function get_image_resource_from_file ($path_file){

  if (!is_file($path_file)) {//������ �ƴ϶��

    $GLOBALS['errormsg'] = $path_file . '�� ������ �ƴմϴ�.';

    return Array();
  }

  $size = @getimagesize($path_file);
  if (empty($size[2])) {//�̹��� Ÿ���� ���ٸ�

    $GLOBALS['errormsg'] = $path_file . '�� �̹��� ������ �ƴմϴ�.';

    return Array();
  }

  if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {//�����ϴ� �̹��� Ÿ���� �ƴ϶��

    $GLOBALS['errormsg'] = $path_file . '�� gif �� jpg, png ������ �ƴմϴ�.';

    return Array();
  }

  switch($size[2]){//image type�� ���� �̹��� ���ҽ��� �����Ѵ�.

    case 1 : //gif

      $im = @imagecreatefromgif($path_file);
      break;

    case 2 : //jpg

      $im = @imagecreatefromjpeg($path_file);
      break;

    case 3 : //png

      $im = @imagecreatefrompng($path_file);
      break;
  }

  if ($im === false) {//�̹��� ���ҽ��� �������⿡ �����Ͽ��ٸ�

    $GLOBALS['errormsg'] = $path_file . ' ���� �̹��� ���ҽ��� �������� �Ϳ� �����Ͽ����ϴ�.';

    return Array();
  }
  else {//�̹��� ���ҽ��� �������⿡ �����Ͽ��ٸ�

    $return = $size;
    $return[0] = $im;
    $return[1] = $size[0];//�ʺ�
    $return[2] = $size[1];//����
    $return[3] = $size[2];//�̹���Ÿ��
    $return[4] = $size[3];//�̹��� attribute

    return $return;
  }
}






/*
�̸� : get_size_by_rule

�뵵 : ū�̹����� �ʺ�� ���̸� ������ �������� ���� �̹��� �ʺ� �� ���̸� ����

������ ���ϰ� : 0���� ū ������

���н� ���ϰ� : false

���� :
==> $src_w : ū�̹����� �ʺ�, 0���� ū ������ ����
==> $src_h : ū�̹����� ����, 0���� ū ������ ����
==> $dst_size : ���� �̹����� ������ �ʺ� �� ����, �ʺ� �� ��� ���� ��ȯ, ���� �� ��� �ʺ� ��ȯ
==> $rule : $dst_size �� ���� �ʺ� ���� �������� ����
          ==> �����δ� width, height �� �ü� �ִ�.
          ==> �����ϰų� height �� �ƴϸ� ��� width�� �ν�
*/

function get_size_by_rule($src_w, $src_h, $dst_size, $rule='width'){

  //�������� �ƴ϶�� ���������� ���� ����ȯ
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_size)) settype($dst_size, 'int');

  if ($src_w < 1 || $src_h < 1){//������ �ʺ�� ���̰� ���߿� �ϳ��� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������ �ʺ�� ���̰� 0���� ū ������ �ƴմϴ�. ($src_w, $src_h)";

    return false;
  }

  if ($dst_size < 1){//�������� �� ����� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "��������� ����� 0���� ū ������ �ƴմϴ�. ($dst_size)";

    return false;
  }

  if ($rule != 'height') {//���ذ��� �ʺ��� ���, ���� height �� �ƴϸ� ���� width �� �Ǵ�

    return ceil($dst_size / $src_w * $src_h);
  }
  else {//���ذ��� ������ ���

    return ceil($dst_size / $src_h * $src_w);
  }
}



/*
�̸� : get_bigsize_by_rule

�뵵 : ���� �̹����� �ʺ�� ���̸� ������ �������� ū �̹��� �ʺ� �� ���̸� ����

������ ���ϰ� : 0���� ū ������

���н� ���ϰ� : false

���� :
==> $dst_w : �����̹����� �ʺ�, 0���� ū ������ ����
==> $dst_h : �����̹����� ����, 0���� ū ������ ����
==> $src_size : ū �̹����� ������ �ʺ� �� ����, �ʺ� �� ��� ���� ��ȯ, ���� �� ��� �ʺ� ��ȯ
==> $rule : $src_size �� ���� �ʺ� ���� �������� ����
          ==> �����δ� width, height �� �ü� �ִ�.
          ==> �����ϰų� height �� �ƴϸ� ��� width�� �ν�
*/

function get_bigsize_by_rule($dst_w, $dst_h, $src_size, $rule='width'){

  //�������� �ƴ϶�� ���������� ���� ����ȯ
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');
  if (!is_int($src_size)) settype($src_size, 'int');

  if ($dst_w < 1 || $dst_h < 1){//������� �ʺ�� ���̰� ���߿� �ϳ��� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������� �ʺ�� ���̰� 0���� ū ������ �ƴմϴ�. ($dst_w, $dst_h)";

    return false;
  }

  if ($src_size < 1){//������ ����� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������ ����� 0���� ū ������ �ƴմϴ�. ($src_size)";

    return false;
  }

  if ($rule != 'height') {//���ذ��� �ʺ��� ���, ���� height �� �ƴϸ� ���� width �� �Ǵ�

    return ceil($src_size / $dst_w * $dst_h);
  }
  else {//���ذ��� ������ ���

    return ceil($src_size / $dst_h * $dst_w);
  }
}



/*
�̸� : get_image_resize

�뵵 : ������ ���ҽ��� ������ �־��� �������� �������� ó���� �̹��� ���ҽ��� ����

������ ���ϰ� : ����� ���ҽ� id

���н� ���ϰ� : false

���� :
==> $src : ������ ���ҽ� id
==> $src_w : ������ �ʺ�
==> $src_h : ������ ����
==> $dst_w : ������ ������� �ʺ�, 0 �̻��� ����
==> $dst_h : ������ ������� ����, 0 �̻��� ����
             ==> ���� �����ϸ� �����ÿ��� �ڵ����� 0���� ���� ��

���� :
==> $dst_w �� $dst_h ��� ���� 0�� �ɼ� ����
==> �Ѵ� 0���� Ŭ ���, ���� ���������Ͽ� ����� ���ҽ� ����
==> ���� �ϳ��� 0 �̸�, 0�� �ƴ� ���� �������� �������� �������� �Ͽ� ����� ����
*/

function get_image_resize($src, $src_w, $src_h, $dst_w, $dst_h=0, $pro=0){

  if (empty($src))  {//������ ���ҽ� id �� ���� ���

    $GLOBALS['errormsg'] = '���� ���ҽ��� �����ϴ�.';

    return false;
  }

  //�������� �ƴ϶�� ���������� ���� ����ȯ
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//������ �ʺ�� ���̰� ���߿� �ϳ��� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������ �ʺ�� ���̰� 0���� ū ������ �ƴմϴ�. ($src_w, $src_h)";

    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//������� �ʺ�� ���� �Ѵ� ���� ���

    $GLOBALS['errormsg'] = '������� �ʺ�� ���̴� ���߿� �ϳ��� �ݵ��� �־�� �մϴ�.';

    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//������� �ʺ� �����ϴµ� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������� �ʺ� 0���� ū ������ �ƴմϴ�. ($dst_w)";

    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//������� ���̰� �����ϴµ� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������� ���̰� 0���� ū ������ �ƴմϴ�. ($dst_h)";

    return false;
  }


  //������� �ʺ�� ���̰� ���߿� �ϳ��� ���� ��쿡�� �������� �ǹ��ϸ�, �������� �ʺ�� ���̸� �����Ѵ�.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }
	// $pro ������� ������� ������ ���
	if($pro ==1){
		if($src_w/$src_h < $dst_w / $dst_h){
			$dst_w = floor($src_w*$dst_h/$src_h);
			$dst_h = $dst_h;
		}else if($src_w/$src_h > $dst_w / $dst_h) {
			$dst_h = floor($src_h*$dst_w/$src_w);
			$dst_w = $dst_w;
		}
	}

  //$dst_w , $dst_h ũ���� ����� ���ҽ��� �����Ѵ�.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {

    $GLOBALS['errormsg'] = "$dst_w , $dst_h ũ���� ����� ���ҽ��� �������� ���߽��ϴ�.";

    return false;
  }


  //�������� ó��
  $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , 0 , 0 , $dst_w , $dst_h , $src_w , $src_h );
  if ($result_resize === false) {

    $GLOBALS['errormsg'] = "$dst_w , $dst_h ũ��� ������� �����Ͽ����ϴ�.";

    return false;
  }

  return $dst;
}



/*
�̸� : get_image_cropresize

�뵵 : ������ ���ҽ��� ������ �־��� �������� ũ�� �� �������� ó���� �̹��� ���ҽ��� ����

������ ���ϰ� : ����� ���ҽ� id

���н� ���ϰ� : false

���� :
==> $src : ������ ���ҽ� id
==> $src_w : ������ �ʺ�
==> $src_h : ������ ����
==> $dst_w : ������ ������� �ʺ�, 0 �̻��� ����
==> $dst_h : ������ ������� ����, 0 �̻��� ����
             ==> ���� �����ϸ� �����ÿ��� �ڵ����� 0���� ���� ��
==> $pos_width : �ʺ� �������� ũ���Ҷ� ����κ��� ũ������ ����
                   ==> 1 �ϰ�쿡�� ������ �������� ũ��
                   ==> 2 �ϰ�쿡�� �߾��� �������� ũ��
                   ==> 3 �ϰ�쿡�� �������� �������� ũ��
                   ==> ���������ϸ� �����ÿ��� �ڵ����� 2 �� ���� ��
==> $pos_height : ���̸� �������� ũ���Ҷ� ����κ��� ũ������ ����
                   ==> 1 �ϰ�쿡�� ����� �������� ũ��
                   ==> 2 �ϰ�쿡�� ����� �������� ũ��
                   ==> 3 �ϰ�쿡�� �ϴ��� �������� ũ��
                   ==> ���������ϸ� �����ÿ��� �ڵ����� 2 �� ���� ��

���� :
==> $dst_w �� $dst_h ��� ���� 0�� �ɼ� ����
==> �Ѵ� 0���� Ŭ ���, ���� ���������Ͽ� ����� ���ҽ� ����
==> ���� �ϳ��� 0 �̸�, 0�� �ƴ� ���� �������� �������� �������� �Ͽ� ����� ����
*/

function get_image_cropresize($src, $src_w, $src_h, $dst_w, $dst_h=0, $pos_width=2, $pos_height=2){

  if (empty($src))  {//������ ���ҽ� id �� ���� ���

    $GLOBALS['errormsg'] = '���� ���ҽ��� �����ϴ�.';

    return false;
  }

  //�������� �ƴ϶�� ���������� ���� ����ȯ
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//������ �ʺ�� ���̰� ���߿� �ϳ��� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������ �ʺ�� ���̰� 0���� ū ������ �ƴմϴ�. ($src_w, $src_h)";

    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//������� �ʺ�� ���� �Ѵ� ���� ���

    $GLOBALS['errormsg'] = '������� �ʺ�� ���̴� ���߿� �ϳ��� �ݵ��� �־�� �մϴ�.';

    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//������� �ʺ� �����ϴµ� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������� �ʺ� 0���� ū ������ �ƴմϴ�. ($dst_w)";

    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//������� ���̰� �����ϴµ� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������� ���̰� 0���� ū ������ �ƴմϴ�. ($dst_h)";

    return false;
  }


  //������� �ʺ�� ���̰� ���߿� �ϳ��� ���� ��쿡�� �������� �ǹ��ϸ�, �������� �ʺ�� ���̸� �����Ѵ�.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }


  //$dst_w , $dst_h ũ���� ����� ���ҽ��� �����Ѵ�.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {

    $GLOBALS['errormsg'] = "$dst_w , $dst_h ũ���� ����� ���ҽ��� �������� ���߽��ϴ�.";

    return false;
  }


  //������� �ʺ� �������� �������� ������� ���̸� ���Ѵ�.
  $s_w = $dst_w;
  $s_h = get_size_by_rule($src_w, $src_h, $s_w, 'width');


  //�⺻��
  $src_x = 0;
  $src_y = 0;
  $src_nw = $src_w;
  $src_nh = $src_h;


  if ($dst_h != $s_h) {//���̰� �ٸ�, ��, ũ���� �ؾ� �Ѵٴ� ��

    if ($dst_h < $s_h) {//������ ���̰� ������ ���� ���� �������, ���̸� �������� $pos_height �� ũ��

      //������� �ʺ�� ���̸� ������ �������� ū�̹����� ���̸� ���Ѵ�.
      $src_nh = get_bigsize_by_rule($dst_w, $dst_h, $src_w, 'width');

      $src_x = 0;

      if ($pos_height == 1) $src_y = 0;//��� ������ y��ǥ ����
      else if ($pos_height == 2) $src_y = ceil(($src_h - $src_nh) / 2);//��� ������ y��ǥ ����
      else $src_y = $src_h - $src_nh;//�ϴ� ������ y��ǥ ����
    }
    else {//������ ���̰� ������ ���� ���� ū���, �ʺ� �������� $pos_width ũ��

      ////������� �ʺ�� ���̸� ������ �������� ���� �ʺ� ���Ѵ�.
      $src_nw = get_bigsize_by_rule($dst_w, $dst_h, $src_h, 'height');

      if ($pos_width == 1) $src_x = 0;//���� ������ y��ǥ ����
      else if ($pos_width == 2) $src_x = ceil(($src_w - $src_nw) / 2);//�߾� ������ y��ǥ ����
      else $src_x = $src_w - $src_nw;//������ ������ y��ǥ ����

      $src_y = 0;
    }
  }

  $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , $src_x , $src_y , $dst_w , $dst_h , $src_nw , $src_nh );
  if ($result_resize === false) {

    $GLOBALS['errormsg'] = "$dst_w , $dst_h ũ��� ũ�� �� ������� �����Ͽ����ϴ�.";

    return false;
  }

  return $dst;
}



/*
�̸� : proc_watermark

�뵵 : ������ ���ҽ��� ������ ���͸�ũ �̹����� �־��� ���ǿ� ���� ��´�.

������ ���ϰ� : true

���н� ���ϰ� : false

���� :
==> $src : ������ ���ҽ� id
==> $src_w : ������ �ʺ�
==> $src_h : ������ ����
==> $path_mark_file : ���͸�ũ�� ���� �̹��������� ��ü��� �Ǵ� �����
==> $pos : ���͸�ũ�� ���� �������� ���ڷ� ����
          ==> 1 �ϰ�쿡�� ��� ���ʿ� �ѹ���
          ==> 2 �ϰ�쿡�� ��� �����ʿ� �ѹ���
          ==> 3 �ϰ�쿡�� �ϴ� ���ʿ� �ѹ���
          ==> 4 �ϰ�쿡�� �ϴ� �����ʿ� �ѹ���
          ==> 5 �� ��쿡�� �߾ӿ� �ѹ���
          ==> 10 �� ��쿡�� ��ü�� �ݺ��ؼ�
          ==> �� ���� ���� 4�� ó��
==> $sharpness : ���͸�ũ�� ����, 0���� 100 ������ ������ ����
                    ==> 100 �� ��쿡�� �����̹����� ����ϴ°����� ����, �����̹����� ���͸�ũ ó��
==> $padding : ���͸�ũ ������ ����, ���������ϸ� ������ �ڵ����� 0 �� ���� ��
*/

function proc_watermark($src, $src_w, $src_h, $path_mark_file, $pos, $sharpness, $padding=0){

  if (empty($src))  {//������ ���ҽ� id �� ���� ���

    $GLOBALS['errormsg'] = '���� ���ҽ��� �����ϴ�.';

    return false;
  }



  //�������� �ƴ϶�� ���������� ���� ����ȯ
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($sharpness)) settype($sharpness, 'int');
  if (!is_int($padding)) settype($padding, 'int');



  if ($src_w < 1 || $src_h < 1){//������ �ʺ�� ���̰� ���߿� �ϳ��� 0���� ū ������ �ƴҰ��

    $GLOBALS['errormsg'] = "������ �ʺ�� ���̰� 0���� ū ������ �ƴմϴ�. ($src_w, $src_h)";

    return false;
  }



  if (empty($path_mark_file)) {//���͸�ũ �̹��� ��ΰ��� ���ٸ�

    $GLOBALS['errormsg'] = '���͸�ũ �̹�����ΰ��� �����ϴ�.';

    return false;
  }

  list($mark, $mark_w, $mark_h) = get_image_resource_from_file ($path_mark_file);

  if (empty($mark)) return false;//���� �޽��� �ۼ��� get_image_resource_from_file ���ο��� ��

/*

  if ($src_w < $mark_w + (2 * $padding)) {//�����ʺ� ���͸�ũ �̹��� �ʺ񺸴� ������ ���͸�ũ ó�� ����, return true;

    return true;
  }

  if ($src_h < $mark_h + (2 * $padding)) {//�������̰� ���͸�ũ �̹��� ���̺��� ������ ���͸�ũ ó�� ����, return true;

    return true;
  }
*/


  if ($sharpness < 0 || $sharpness > 100) $sharpness = 30;//$sharpness �� ������ ���� �̻��� ���ڶ�� 30���� ���� �缳��

  if ($padding < 0 || $padding > $mark_w || $padding > $mark_h) $padding = 0;//$padding�� 0���� �۰ų� ���͸�ũ�� �ʺ� ���̺��� ũ�� 10���� ���� �缳��



  if ($pos == 10) {//���͸�ũ ��ü�� ���� ����� ó��

    $w_max = $src_w - $padding;
    $h_max = $src_h - $padding;

    //x ������ ���͸�ũ�� ��� ���� ������ ���, �е��� ���ؼ� ����
    $x_max = ceil($w_max / ($mark_w + $padding));

    //y ������ ���͸�ũ�� ��� ���� ������ ���
    $y_max = ceil($h_max / ($mark_h + $padding));

    //������ �����鼭 ���͸�ũ�� ����
    for($x = 0; $x < $x_max; $x++){

      for($y = 0; $y < $y_max; $y++){

        //�������� ���Ѵ�.
        $src_x = $x * ($mark_w + $padding) + $padding;
        $src_y = $y * ($mark_h + $padding) + $padding;

        $copy_w = $mark_w;
        $copy_h = $mark_h;

        if ($src_x + $mark_w > $w_max) $copy_w = $w_max - $src_x;
        if ($src_y + $mark_h > $h_max) $copy_h = $h_max - $src_y;

        if ($sharpness != 100) {//������ 100 �� �ƴҰ�쿡�� ������ ����Ҽ� �ִ� imagecopymerge ���

          $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
        }
        else {//������ 100 �� ��쿡�� �����̹����� ����Ҽ� ���� imagecopyresampled ���

          $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
        }

        if ($result_watermark === false) {

          @imagedestroy($mark);

          $GLOBALS['errormsg'] = "���͸�ũ ó���� �����Ͽ����ϴ�.";

          return false;
        }
      }
    }
  }
  else {//���͸�ũ�� �ϳ��� ���� ��쿡�� ó��

    //���͸�ũ�� ������ �ʺ�, ���� �⺻�� ����
    $copy_w = $mark_w;
    $copy_h = $mark_h;

    switch($pos){

      case 1 : //��� ����

        $src_x = 0 + $padding;
        $src_y = 0 + $padding;

        break;

      case 2 : //��� ������

        $src_x = $src_w - $mark_w - $padding;
        $src_y = 0 + $padding;

        break;

      case 3 : //�ϴ� ����

        $src_x = 0 + $padding;
        $src_y = $src_h - $mark_h - $padding;

        break;

      case 4 : //�ϴ� ������

        $src_x = $src_w - $mark_w - $padding;
        $src_y = $src_h - $mark_h - $padding;

        break;

      case 5 : //�߾�

        $src_x = ceil(($src_w - $mark_w) / 2);
        $src_y = ceil(($src_h - $mark_h) / 2);

        break;

      default : // �� ���� ���� ���� ��� ���� ġ��

        $src_x = 0 + $padding;
        $src_y = 0 + $padding;

    }

    if ($sharpness != 100) {//������ 100 �� �ƴҰ�쿡�� ������ ����Ҽ� �ִ� imagecopymerge ���

      $result_watermark = imagecopymerge($src, $mark, $src_x, $src_y, 0, 0, $copy_w, $copy_h, $sharpness);
    }
    else {//������ 100 �� ��쿡�� �����̹����� ����Ҽ� ���� imagecopyresampled ���

      $result_watermark = imagecopyresampled ($src , $mark , $src_x, $src_y, 0 , 0 , $copy_w, $copy_h , $copy_w, $copy_h);
    }

    @imagedestroy($mark);

    if ($result_watermark === false) {

      $GLOBALS['errormsg'] = "���͸�ũ ó���� �����Ͽ����ϴ�.";

      return false;
    }
  }

  return true;
}



/*
�̸� : thumnail

�뵵 : ������ ���ǿ� ���� ��������, ũ��, ���͸�ũ�� ó���Ͽ� ���Ϸ� ������

������ ���ϰ� : true

���н� ���ϰ� : false

���� :
==> $path_src_file : ���������� ������ �Ǵ� �����
==> $path_save_file : ������� ������ ������ �Ǵ� �����
==> $save_w : ���� ������� �ʺ�
==> $save_h : ���� ������� ����, ���� �����ϸ� ������ �⺻���� 0
==> $options : �Լ� ���ο� ���ǵ� �������� ���� �����Ҷ� ���, �迭����, ���������ϸ� ������ �⺻���� ��迭(Array())
                ==> $options['save_quality'] : ���Ϸ� ����� ����� ������ ǰ��, 100 ������ ���� ������ ���, gif�� �ǹ� ����
                ==> $options['save_force'] : �̹� ������ ��ο� �����̸��� ������ �����Ҷ��� ó�� ����
                                                            0 �̸� false ��ȯ, 1 �̸� ���̻� ������ϰ� true ��ȯ, 2 �̸� �����Ŵ� ����� ���� ����
                ==> $options['crop_use'] : ũ�� ��� ����, 0 �� ������, 1�� �����
                ==> $options['crop_pos_width'] : �ʺ� �������� ũ���Ҷ� ���غ��� ����, 1�� ����, 2�� ���, 3�� ������
                ==> $options['crop_pos_height'] : ���� �������� ũ���Ҷ� ���غ��� ����, 1�� ���, 2�� �ߴ�, 3�� �ϴ�
                ==> $options['watermark_path_file'] : ���͸�ũ �̹��� ������ ������ �Ǵ� �����
                ==> $options['watermark_pos'] : ���͸�ũ ��� ��ġ ����, 1 �� ��� ����, 2�� ��� ������, 3�� �ϴ� ����, 4�� �ϴ� ������, 5�� �߾�, 10 �� ��ü�� �ݺ�
                ==> $options['watermark_sharpness'] : ���͸�ũ�� ����, 100 ������ ���� ������ ���
                                                                     ==> 100 �ϰ�쿡�� �����̹��� ��밡��
                ==> $options['watermark_padding'] : ���͸�ũ�� ����, 0�̻��� ���� ����, �е��� ũ��� ���͸�ũ�̹����� �ʺ� ���̺��� Ŭ�� ����
*/



//thumnail(���ϰ��, ����ϳʺ�, ����� ����, ����Ƽ, ��������(0�ȸ���, 1: ������ ����, 2: ���θ���), ũ�ӻ��,����������, ���̹���, ���͸�ũ���)
function thumnail($path_src_file, $save_w, $save_h,$save_quality,$save_force=1,$crop_use,$pro_use="0", $noimage="",$watermark_path_file=""){

  $crop_pos_width = 2;//�ʺ� ���� ũ�ӽ� �߾��� ����
  $crop_pos_height = 1;//���� ���� ũ�ӽ� ����� ����

  $watermark_pos = 4;//���͸�ũ ��� ��ġ : �ϴ� ������
  $watermark_sharpness = 60;//���͸�ũ �̹����� ���� : 30 %
  $watermark_padding = 0;//������ ���͸�ũ ������ ����
//$path_save_file


    // ����� ���丮
    $dir = dirname(file_path($path_src_file));
    $file_name = basename($path_src_file);
	if(!$file_name) return $noimage;

    $thumb_path = $dir . "/thumb_".$save_w."x".$save_h."_".$save_quality;
    if (!file_exists($thumb_path)) {
        @mkdir($thumb_path, 0707);
        @chmod($thumb_path, 0707);
    }
	$path_save_file = $thumb_path."/".$file_name;
	
	
	if($save_force=="1" && file_exists($path_save_file))
		return $path_save_file;

  //�⺻�� �缳��
  if (!empty($options)) @extract($options);

  //���� ���ҽ� ����
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return $noimage;

  //�������� �Ǵ� ũ�� ��������
  if ($crop_use == 1) {//ũ�� ��������

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);
  }
  else {//��������

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h, $pro_use);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//������ ����� ���ҽ����� ���� �ʺ� ���Ѵ�.
  $save_h = imagesy($dst);//������ ����� ���ҽ����� ���� ���̸� ���Ѵ�.

  //���͸�ũ �̹����� ������ ���, ���͸�ũ ó��
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);


	if(file_exists($path_save_file))
		return $path_save_file;
	else
		return $noimage;
}


function resize_image($path_src_file,$save_w,$save_quality=95,$watermark_path_file=""){

  $watermark_pos = 4;//���͸�ũ ��� ��ġ : �ϴ� ������
  $watermark_sharpness = 60;//���͸�ũ �̹����� ���� : 30 %
  $watermark_padding = 0;//������ ���͸�ũ ������ ����
	

//�ӵ��� ����������
  $size = @getimagesize($path_src_file);
	if($size[0] <= $save_w) return false;

  //���� ���ҽ� ����
  list($src, $src_w, $src_h) = get_image_resource_from_file ($path_src_file);
  if (empty($src)) return false;

	//���� �̹����� �������� �̹������� ������ ����
	//if($src_w < $save_w)
	//	return false;
	
	//��ʿ� ���� �̹��� ���̸� ���Ѵ�
	$save_h = (int)($save_w / $src_w *$src_h); 

	$dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);

	@imagedestroy($src);
	if (empty($dst)) return false;

  $save_w = imagesx($dst);//������ ����� ���ҽ����� ���� �ʺ� ���Ѵ�.
  $save_h = imagesy($dst);//������ ����� ���ҽ����� ���� ���̸� ���Ѵ�.

  //���͸�ũ �̹����� ������ ���, ���͸�ũ ó��
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_src_file, $save_quality, 2);

  @imagedestroy($dst);

  return $result_save;

}


/*
�̸� : save_image_from_resource

�뵵 : image resouce �� ������ ���Ϸ� ����

������ ���ϰ� : true

���н� ���ϰ� : false

���� :
==> $im : �̹��� ���ҽ� id
==> $path_save_file : ����� ������ ���� ��� �Ǵ� �����
==> $quality : ����Ǵ� ������ ���� ����
              ==> 100 ������ ������ ����, �������� ���� ����
              ==> �����ϸ� �ڵ����� �⺻���� 70
==> $save_force : ���� ��ο� �̹� ������ �����Ҷ�
                     ==> 0 �̸� �������� �ʰ� false ��ȯ
                     ==> 1 �̸� �������� �ʰ� true ��ȯ
                     ==> 2 �̸� ���� ���� ����� ���� ����
                     ==> �����ϸ� �ڵ����� �⺻���� 0

���� :
==> gif �̹����� $quality �� ������ ���� ����
*/

function save_image_from_resource ($im, $path_save_file, $quality=70, $save_force=0){


  if (is_file($path_save_file)){//���� �̸��� ������ �����ϸ�

    if ($save_force == 1) {//���� �������� �ʰ� true ��ȯ

      return true;
    }
    else if ($save_force == 2){//���� ������ ����

      $result_unlink = @unlink($path_save_file);
      if ($result_unlink === false) {//���� �̹��� ������ ����

        $GLOBALS['errormsg'] = '������ �����ϴ� ' . $path_save_file . '�� ������ �����Ͽ����ϴ�.';

        return false;
      }
    }
    else {//0 �̰ų� �������� ���� ���϶� false�� ��ȯ

      $GLOBALS['errormsg'] = $path_save_file . '�� �̹� ���� �̸��� ������ �����մϴ�.';

      return false;
    }
  }

  //���ϸ��� ������ . �� �������� Ȯ���ڸ� �����ͼ� �ҹ��ڷ� ��ȯ
	$extension = strtolower(substr($path_save_file, strrpos($path_save_file, '.') + 1));
  switch($extension){//Ȯ���ڿ� ���� �̹��� ���� ó��

	case 'gif' :
	$result_save = @imagegif($im, $path_save_file);
	break;

	case 'jpg' :
	case 'jpeg' :
	$result_save = @imagejpeg($im, $path_save_file, $quality);
	break;

	case 'png' :
	$result_save = @imagepng($im, $path_save_file);
	break;

}




  if ($result_save === false) {//�̹��� ���忡 ����

    $GLOBALS['errormsg'] = $path_save_file . '�� ���忡 �����Ͽ����ϴ�.';

    return false;
  }
  else {//�̹��� ���忡 ����

    return true;
  }
}





if(!function_exists('file_path')){
// ������ ��θ� ������ �ɴϴ� (�Ҵ���, /lib/common.lib.php�� ���ǵ� �Լ�)
function file_path($path) {

    $dir = dirname($path);
    $file = basename($path);
    
    if (substr($dir,0,1) == "/") {
        $real_dir = dirname($_SERVER['DOCUMENT_ROOT'] . "/nothing");
        $dir = $real_dir . $dir;
    }
    
    return $dir . "/" . $file;
}
}
?>
