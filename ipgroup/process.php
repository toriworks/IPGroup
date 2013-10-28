<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

header('Content-Type: text/html');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');
require_once('../classes/domain/Keeper.php');

require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');
require_once('../classes/domain/Attaches.php');


// get parameter from previous page
$call_type = $_REQUEST['call_type'];
if ($call_type == 'login') {

    $keeper_id = $_REQUEST['keeper_ids'];

    // process login
    $conn = ConnectionFactory::create();
    $keeperDaoImpl = new KeeperDaoImpl();
    $keeperServiceImpl = new KeeperServiceImpl();
    $keeperServiceImpl->setKeeperDao($keeperDaoImpl);

    $keeperObj = new Keeper();
    $keeperObj->setId($keeper_id);

    $result = $keeperServiceImpl->tryLogin($conn, $keeperObj);

    if($result == "1") {
        // read personal informations
        $keeperObj = $keeperServiceImpl->detail($conn, $keeperObj);

        setcookie("keeper_id", $keeper_id);
        setcookie("keeper_kor_name", $keeperObj->getKorName());
    } else if($result == "2") {
    }

    if ($conn) {
        try {
            mysql_close($conn);
        } catch (Exception $e) {
            printf("Error %s", $e->getMessage());
        }
    }

    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\": \"".$result."\"}}";
    echo $ret;
} else if ($call_type == 'logout') {
    setcookie("keeper_id");
    setcookie("keeper_kor_name");

    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\":\"1\"}}";
    echo $ret;
} else if ($call_type == 'del_attach') {
    $work_id = $_REQUEST['work_id'];
    $stypes = $_REQUEST['stypes'];
    $mtypes = $_REQUEST['mtypes'];

    $conn = ConnectionFactory::create();
    $attacheObj = new Attaches();
    $attacheObj->setRefId($work_id);
    $attacheObj->setMtypes($mtypes);
    $attacheObj->setStypes($stypes);

    $attacheDao = new AttachesDaoImpl();
    $attacheService = new AttachesServiceImpl();
    $attacheService->setAttachesDao($attacheDao);

    $result = $attacheService->delete($conn, $attacheObj);
    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\":\"".$result."\"}}";
    echo $ret;
}
?>