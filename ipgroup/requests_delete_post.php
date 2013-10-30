<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오후 5:43
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/domain/Requests.php');
require_once('../classes/dao/RequestsDaoImpl.php');
require_once('../classes/service/RequestsServiceImpl.php');

require_once('../classes/domain/Attaches.php');
require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');


$conn = ConnectionFactory::create();
$requestsDaoImpl = new RequestsDaoImpl();
$requestsServiceImpl = new RequestsServiceImpl();
$requestsServiceImpl->setRequestsDao($requestsDaoImpl);

// 첨부 파일도 삭제함
$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// get parameter
$requests_ids = $_REQUEST['rids'];
$arrRequests = explode("^", $requests_ids);

for($i = 0; $i<count($arrRequests); $i++) {
    //echo $arrRequests[$i]."<br/>";

    // 첨부파일 먼저 삭제
    $attachObj = new Attaches();
    $attachObj->setRefId($arrRequests[$i]);
    $attachObj->setMtypes("RQ");

    $attachesServiceImpl->delete($conn, $attachObj);


    // 실제 데이터 삭제
    $requestsObj = new Requests();
    $requestsObj->setId($arrRequests[$i]);

    $requestsServiceImpl->delete($conn, $requestsObj);
}
?>
<script type="text/javascript">
    location.href = "./redirect.php?page=request_list.php";
</script>
