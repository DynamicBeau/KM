<?
function formatcontent2($string, $byte = 0, $suffix = '...')
{
	$return = strip_tags($string);
	$return = preg_replace('/(\&nbsp\;)/i', ' ', $return);
	$return = preg_replace('/\<br?.*\>/i', ' ', $return);
	$return = preg_replace('/[\t\r?\n]/', ' ', $return);
	$return = preg_replace('/[\s]{2,}/', ' ', $return);
	$return = trim($return);
	$return = cut_str($return, $byte, $suffix);
	return $return;
}
?>
