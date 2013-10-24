<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

$seq = mysql_result(mysql_query("SELECT seq FROM ".$prefix."worker_info WHERE wid=".$_POST['wid'], $connect),0 ,0);

query(Array(
	"UPDATE ".$prefix."worker_info SET seq = seq - 1 WHERE seq > ".$seq
	,
	"DELETE FROM ".$prefix."worker_info WHERE wid=".$_POST['wid']
	,
	"DELETE FROM ".$prefix."relation_gw WHERE wid=".$_POST['wid']
));

?>