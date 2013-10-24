<? //$DOCUMENT_ROOT = "/home/hosting_users/chulminz00/www"; ?>
<? include $DOCUMENT_ROOT."/worklist/lib.php"; ?>
<? 

db_connect();

$seq = mysql_result(mysql_query("SELECT max(seq)+1 FROM ".$prefix."type_info", $connect),0 ,0);
if ($seq == '') $seq = '1';

query(Array(
	"INSERT INTO ".$prefix."type_info (seq, name) VALUES (".$seq.", '".iconv("UTF-8","EUC-KR",$_POST['name'])."')"
));

?>