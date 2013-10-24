<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

$sql = "
	DELETE FROM ".$prefix."work_data WHERE id=".$_POST['id']."
";
$result = mysql_query($sql, $connect);
if (!$result) {
	echo $sql;
} else {
	echo "COMPLETE";
}

?>