<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

if (!$is_member)
    alert_close('ȸ���� ������ �߼��� �� �ֽ��ϴ�.');

// �������� ���� �ڵ� ���� 060809
//if (substr_count($to_email, "@") > 3) alert("�ִ� 3������� ������ �߼��� �� �ֽ��ϴ�.");
if (substr_count($to_email, "@") > 1) alert('���� �ּҴ� �ϳ����� �Է��� �ֽʽÿ�.');

if ($_SESSION["ss_recommend_datetime"] >= ($g4[server_time] - 120))
    alert("�ʹ� ���� �ð����� ������ �����ؼ� ���� �� �����ϴ�.");
set_session("ss_recommend_datetime", $g4[server_time]);

$recommendmail_count = (int)get_session('ss_recommendmail_count') + 1;
if ($recommendmail_count > 3)
    alert_close('�ѹ� ������ �������� ���ϸ� �߼��� �� �ֽ��ϴ�.\n\n����ؼ� ������ �����÷��� �ٽ� �α��� �Ǵ� �����Ͽ� �ֽʽÿ�.');
set_session('ss_recommendmail_count', $recommendmail_count);

// ���ǿ� ����� ��ū�� �������� �Ѿ�� ��ū�� ���Ͽ� Ʋ���� ������ �߼��� �� ����.
if ($_POST["token"] && get_session("ss_token") == $_POST["token"]) {
    // ������ ������ ���� �ٽ� �Է����� ���ؼ� �������� �Ѵ�.
    set_session("ss_token", "");
} else {
    alert_close("���� �߼۽� ������ �߻��Ͽ����ϴ�.");
    exit;
}

// ��ǰ
$sql = " select * from $g4[yc4_item_table] where it_id = '$it_id' ";
$it = sql_fetch($sql);
if (!$it[it_id])
    alert("��ϵ� ��ǰ�� �ƴմϴ�.");

$subject = stripslashes($subject);
$content = nl2br(stripslashes($content));

$from_name = $member[mb_name];
$from_email = $member[mb_email];
$it_id = $it[it_id];
$it_name = $it[it_name];
$it_mimg = $it[it_id]."_m";

ob_start();
include "./mail/itemrecommend.mail.php";
$content = ob_get_contents();
ob_end_clean();

mailer($from_name, $from_email, $to_email, $subject, $content, 1);

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
?>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<script language="JavaScript">
alert("������ �����Ͽ����ϴ�");
window.close();
</script>
