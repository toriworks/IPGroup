<?php
/**
 * User: toriworks
 * Date: 2013. 10. 31.
 * Time: 오전 12:27
 */

require_once('../classes/ConnectionFactory.php');
require_once('../classes/domain/Jobs.php');
require_once('../classes/dao/JobsDaoImpl.php');
require_once('../classes/service/JobsServiceImpl.php');

$conn = ConnectionFactory::create();
$jobsDaoImpl = new JobsDaoImpl();
$jobsServiceImpl = new JobsServiceImpl();
$jobsServiceImpl->setJobsDao($jobsDaoImpl);

// get parameter
$jobs_ids = $_REQUEST['jids'];
$arrJobs = explode("^", $jobs_ids);

for($i = 0; $i<count($arrJobs); $i++) {
    // TODO : 인재풀로 이동할 수 있게 함

    // 실제 데이터 삭제
    $jobsObj = new Jobs();
    $jobsObj->setId($arrJobs[$i]);

    $jobsServiceImpl->delete($conn, $jobsObj);
}
?>
<script type="text/javascript">
    location.href = "./redirect.php?page=job_posting_list.php";
</script>