<?php
/**
 * User: toriworks
 * Date: 2013. 10. 31.
 * Time: 오전 12:27
 */

require_once('../classes/ConnectionFactory.php');
require_once('../classes/domain/Applicants.php');
require_once('../classes/dao/ApplicantsDaoImpl.php');
require_once('../classes/service/ApplicantsServiceImpl.php');

require_once('../classes/domain/Attaches.php');
require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');


$conn = ConnectionFactory::create();
$applicantsDaoImpl = new ApplicantsDaoImpl();
$applicantsServiceImpl = new ApplicantsServiceImpl();
$applicantsServiceImpl->setApplicantsDao($applicantsDaoImpl);

$attachesServiceImpl = new AttachesServiceImpl();
$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// get parameter
$applicants_ids = $_REQUEST['ids'];
$arrApplicants = explode("^", $applicants_ids);

for($i = 0; $i<count($arrApplicants); $i++) {

    // 실제 데이터 삭제
    $applicantsObj = new Applicants();
    $applicantsObj->setId($arrApplicants[$i]);

    $rDelete = $applicantsServiceImpl->delete($conn, $applicantsObj);
    if($rDelete > 0) {
        // 첨부파일 삭제
        $attachesObj = new Attaches();
        $attachesObj->setRefId($arrApplicants[$i]);

        $attachesServiceImpl->delete($conn, $attachesObj);
    }

}
?>
<script type="text/javascript">
    location.href = "./redirect.php?page=recruit_list.php";
</script>