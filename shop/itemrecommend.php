<? 
include_once("./_common.php");

if (!$is_member)
    alert_close('ȸ���� ������ �߼��� �� �ֽ��ϴ�.');

// ������ �߼��� �� ������ ���ǿ� �ƹ����̳� �����Ͽ� hidden ���� �Ѱܼ� ���� ���������� ����
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$sql = " select it_name from $g4[yc4_item_table] where it_id='$it_id' ";
$it = sql_fetch($sql);
if (!$it[it_name]) 
    alert_close("��ϵ� ��ǰ�� �ƴմϴ�.");

$g4[title] =  "$it[it_name] - ��õ�ϱ�";
include_once("$g4[path]/head.sub.php");
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[shop_img_path]?>/icon_01.gif" width="5" height="5"></td>
            <td width="490" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?=get_text($g4[title])?></b></font></td>
            <td width="75" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>


<form name="fitemrecommend" method="post" action="./itemrecommendmail.php" onsubmit="return fitemrecommend_check(this);" style='margin:0px;' autocomplete='off'>
<input type=hidden name=token value='<?=$token?>'>
<input type=hidden name=it_id value='<?=$it_id?>'>
<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="300" align="center" valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF">
                <table width=100% cellpadding=0 cellspacing=0 border=0 height=40 bgcolor='#F6F6F6'>
                <colgroup width=130>
                <colgroup width=''>
                <tr> 
                    <td height="24" rowspan="2">&nbsp; ��õ�Ͻ� �� E-mail</td>
                    <td><input type=text id='to_email' name='to_email' required itemname='��õ�Ͻ� �� E-mail' class=ed style="width:97%;"></td>
                </tr>
                <!-- <tr align=center>
                    <td>�� ��õ�Ͻ� ���� �������� ��� E-mail�� �ĸ�(,)�� �����ϼ���. �ִ� 3��</td>
                </tr> -->
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#F6F6F6">
                <table width=100% cellpadding=0 cellspacing=0>
                <colgroup width=130>
                <colgroup width=''>
                <tr style='padding-top:7px; padding-bottom:7px;'>
                	<td>&nbsp; ����</td>
                	<td><input type=text name='subject' class=ed style='width:97%;' required itemname='����'></td>
                </tr>
                <tr style='padding-top:7px; padding-bottom:7px;'>
                	<td>&nbsp; ����</td>
                	<td><textarea name='content' rows=10 style='width:97%;' required itemname='����' class=ed></textarea></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom">
        <input id=btn_submit type=image src="<?=$g4[shop_img_path]?>/btn_confirm.gif" border=0>&nbsp;
        <a href="javascript:window.close();"><img src="<?=$g4[shop_img_path]?>/btn_close.gif" border="0"></a>
    </td>
</tr>
</table>
</form>

<script language="javascript">
function fitemrecommend_check(f) 
{
    return true;
}

document.getElementById('to_email').focus();
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>