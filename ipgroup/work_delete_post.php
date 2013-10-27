<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

@define('class_path', '/home/host01/ipgroup');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/domain/Work.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');

require_once('../classes/domain/Attaches.php');
require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');


$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// get parameter
$work_id = $_REQUEST['work_id'];

$workObj = new Work();
$workObj->setId($work_id);

$resultOfDelete = $workServiceImpl->delete($conn, $workObj);
if($resultOfDelete == 1) {
    $attachObj = new Attaches();
     $attachObj->setRefId($work_id);

    $attachesServiceImpl->delete($conn, $attachObj);
}
?>
<script type="text/javascript">
    location.href = "./redirect.php?page=work_list.php";
</script>