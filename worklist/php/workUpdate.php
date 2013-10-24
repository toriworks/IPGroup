<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

$sql = "
	UPDATE ".$prefix."work_data SET
		date = '".$_POST['d']."',
		pid = ".$_POST['p'].",
		wid = ".$_POST['wk'].",
		tid = ".$_POST['t'].",
		worktime = ".$_POST['wt'].",
		work = '".iconv("UTF-8","EUC-KR",$_POST['w'])."'
	WHERE
		id = ".$_POST['id']."
";
$result = mysql_query($sql, $connect);
if (!$result) {
    //die('Invalid query: ' . mysql_error());
	echo $sql;
	//echo "ERROR";
} else {
	echo "COMPLETE";
}

?>