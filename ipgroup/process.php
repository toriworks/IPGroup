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

require_once('../classes/dao/RequestsDaoImpl.php');
require_once('../classes/service/RequestsServiceImpl.php');
require_once('../classes/domain/Requests.php');

require_once('../classes/dao/ApplicantsDaoImpl.php');
require_once('../classes/service/ApplicantsServiceImpl.php');
require_once('../classes/domain/Applicants.php');


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
        setcookie("menu1", $keeperObj->getMenu1());
        setcookie("menu2", $keeperObj->getMenu2());
        setcookie("menu3", $keeperObj->getMenu3());
        setcookie("menu4", $keeperObj->getMenu4());
        setcookie("menu5", $keeperObj->getMenu5());
        setcookie("menu6", $keeperObj->getMenu6());
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
    setcookie("menu1");
    setcookie("menu2");
    setcookie("menu3");
    setcookie("menu4");
    setcookie("menu5");
    setcookie("menu6");

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
    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\":\"".$result."\", \"stypes\":\"".$stypes."\"}}";
    echo $ret;
} else if($call_type == 'save_memos') {
    $requests_id = $_REQUEST['requests_id'];
    $memos = $_REQUEST['memos'];

    $conn = ConnectionFactory::create();
    $reqDao = new RequestsDaoImpl();
    $reqService = new RequestsServiceImpl();
    $reqService->setRequestsDao($reqDao);
    $reqObj = new Requests();
    $reqObj->setId($requests_id);
    $reqObj->setMemos($memos);

    $result = $reqService->updateMemos($conn, $reqObj);
    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\": \"".$result."\"}}";
    echo $ret;
} else if($call_type == 'save_recruit') {
    $recruit_id = $_REQUEST['requests_id'];
    $memos = $_REQUEST['memos'];
    $status = $_REQUEST['status'];
    $hire_date = $_REQUEST['hire_date'];
    $hire_part = $_REQUEST['hire_part'];
    $hire_task = $_REQUEST['hire_task'];
    $keeper_name = $_REQUEST['keeper_name'];
    $keeper_contact = $_REQUEST['keeper_contact'];

    $conn = ConnectionFactory::create();
    $appDao = new ApplicantsDaoImpl();
    $appService = new ApplicantsServiceImpl();
    $appService->setApplicantsDao($appDao);
    $app = new Applicants();
    $app->setId($recruit_id);
    $app->setMemos($memos);
    $app->setStatus($status);
    $app->setHireDate($hire_date);
    $app->setHirePart($hire_part);
    $app->setHireTask($hire_task);
    $app->setKeeperName($keeper_name);
    $app->setKeeperContact($keeper_contact);

    $result = $appService->update_keeper($conn, $app);
    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\": \"".$result."\"}}";
    echo $ret;
} else if($call_type == 'check_success') {
    $mobile_1 = $_REQUEST['mobile_1'];
    $mobile_2 = $_REQUEST['mobile_2'];
    $mobile_3 = $_REQUEST['mobile_3'];

    $name = $_REQUEST['name'];

    $conn = ConnectionFactory::create();
    $appDao = new ApplicantsDaoImpl();
    $appService = new ApplicantsServiceImpl();
    $appService->setApplicantsDao($appDao);
    $app = new Applicants();
    $app->setKorName($name);
    $app->setMobile1($mobile_1);
    $app->setMobile2($mobile_2);
    $app->setMobile3($mobile_3);

    $status = ''; $hire_date = ''; $wday = ''; $hire_task = ''; $hire_part = '';
    $keeper_name = ''; $keeper_contact = '';
    $result = $appService->detail4Success($conn, $app);
    while($row = mysql_fetch_array($result)) {
        // 맨 마지막의 상태값만을 취득함
        $status = $row['status'];
        $hire_date = $row['hire_date'];
        $hire_task = $row['hire_task'];
        $hire_part = $row['hire_part'];
        $keeper_name = $row['keeper_name'];
        $keeper_contact = $row['keeper_contact'];
        $wday = $row['wday'];
    }

    $ret = '{"ipg":{"call_type":"'.$call_type.'","status":"'.$status.'","hire_date":"'.$hire_date.'"';
    $ret .= ',"hire_task":"'.$hire_task.'","hire_part":"'.$hire_part.'","keeper_name":"'.$keeper_name.'","keeper_contact":"'.$keeper_contact.'","wday":"'.$wday.'"}}';

    echo $ret;
}
?>