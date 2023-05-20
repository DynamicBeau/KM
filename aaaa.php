<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr" />
<title></title>
<style type="text/css">
@charset 'utf-8';

#menu{font-size:12px;position:relative;z-index:10000;}
#menu:after{content:"";display:block;clear:both;}
#menu ul{list-style:none;margin:0;padding:0;}
#menu ul.mother li{position:relative;}
#menu ul.child{position:absolute;top:26px;left:0;}

#menu ul.child{border:solid 1px #ddd;background-color:#fff;z-index:10001;}
#menu ul.child{display:none;}

#menu .active{display:block !important;background-color:red !important;}

#menu ul.child li a{display:block;width:100%;padding:4px;}
#menu ul.mother{}
#menu ul.mother li{float:left;padding:8px 20px;}
#menu ul.child li{margin:0;padding:0;}


#menu{border:solid 1px #ccc;background-color:#f1f1f1;font:13px "맑은 고딕","나눔고딕";}
#menu{-moz-border-radius:8px;}
#menu ul.child{-moz-border-radius:10px;}
#menu a{color:#000;text-decoration:none;}

</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
jQuery(function($){
function dd(){
  $('ul.active').removeClass('active'); // 기존에 선택된 것 제거하고,
  $(this).parent('li').children('ul').addClass('active'); // 선택된 것의 하위 ul에 active를 추가해준다.
}
$('ul.mother>li>a').mouseover(dd).focus(dd);

})
</script>
</head>
<body>
<div id="menu">
<ul class="mother">
<li class="m1"><a href="#">메뉴1</a>
<ul class="child">
<li><a href="#">메뉴1-1</a></li>
</ul>
</li>
<li class="m2"><a href="#">메뉴2</a>
<ul class="child">
<li><a href="#">메뉴2-1</a></li>
<li><a href="#">메뉴2-2</a></li>
<li><a href="#">메뉴2-3</a></li>
</ul>
</li>
<li class="m3"><a href="#">메뉴3</a>
<ul class="child">
<li><a href="#">메뉴3-1</a></li>
<li><a href="#">메뉴3-2</a></li>
<li><a href="#">메뉴3-3</a></li>
<li><a href="#">메뉴3-3</a></li>
</ul>
</li>
<li class="m4"><a href="#">메뉴4</a>
<ul class="child">
<li><a href="#">메뉴4-1</a></li>
<li><a href="#">메뉴4-2</a></li>
<li><a href="#">메뉴4-3</a></li>
<li><a href="#">메뉴4-3</a></li>
<li><a href="#">메뉴4-3</a></li>
</ul>
</li>
</ul>
</div>
</body>
</html> 