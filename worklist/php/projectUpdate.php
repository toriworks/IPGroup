<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

if ($_POST['act'] == 'name') {
	query(Array(
		"UPDATE ".$prefix."project_info SET name = '".iconv("UTF-8","EUC-KR",$_POST['name'])."' WHERE pid = ".$_POST['pid']
	));
} else if ($_POST['act'] == 'active') {
	query(Array(
		"UPDATE ".$prefix."project_info SET active = ".$_POST['active']." WHERE pid = ".$_POST['pid']
	));
}

?>
