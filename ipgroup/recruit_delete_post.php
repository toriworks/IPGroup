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

require_once('../classes/dao/ApplicantsCompanyDaoImpl.php');
require_once('../classes/service/ApplicantsCompanyServiceImpl.php');
require_once('../classes/domain/ApplicantsCompany.php');

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

// 지원자 회사정보
$appCDaoImpl = new ApplicantsCompanyDaoImpl();
$appCServiceImpl = new ApplicantsCompanyServiceImpl();
$appCServiceImpl->setApplicantsCompanyDao($appCDaoImpl);


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

//        // 지원자 학교 삭제
//        $appC = new ApplicantsCompany();
//        $appC->setApplicantsId($arrApplicants[$i]);
//
//        $appCServiceImpl->delete($conn, $appC);
    }

}

?>
<script type="text/javascript">
    location.href = "./redirect.php?page=recruit_list.php";
</script>