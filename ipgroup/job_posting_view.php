<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 31
 * Time: 오후 3:24
 */

require_once('./auth.php');

require_once('../classes/dao/ICommons.php');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/JobsDaoImpl.php');
require_once('../classes/service/JobsServiceImpl.php');
require_once('../classes/domain/Jobs.php');

require_once('../classes/utils/CommonUtils.php');

// 파라미터 받기
$jids = $_REQUEST['jids'];

$conn = ConnectionFactory::create();
$jobsDao = new JobsDaoImpl();
$jobsService= new JobsServiceImpl();
$jobsService->setJobsDao($jobsDao);

$jobsObj = new Jobs();
$jobsObj->setId($jids);

$result = $jobsService->detail($conn, $jobsObj);
$row = @mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>IPGROUP 관리자페이지</title>
    <link rel="stylesheet" type="text/css" href="./css/admin.css" />
    <link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui-1.10.3.custom.css" />
    <script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
    <script type="text/javascript" src="./js/admin.js"></script>
    <script type="text/javascript" src="./js/message.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
    <script type="text/javascript">
        del_data = function() {
            if(confirm(CONFIRM_DELETE)) {
                location.href = "./jobs_delete_post.php?jids=<?= $jids ?>^";
            } else {
                return;
            }
        }

        update_data = function() {
            location.href = "./job_posting_revise.php?jids=<?= $jids ?>";
        }
    </script>
</head>
<body>

<div id="admin_wrap">

<div id="admin_left">
    <h1>IPGROUP</h1>

    <p class="username">
        <span><?= $_COOKIE["keeper_kor_name"] ?></span><br />
        <a href="javascript:try_logout();">[로그아웃]</a>
    </p>

    <ul class="menu">
        <li><a href="work_list.php">Work</a></li>
        <li><a href="request_list.php">Request</a></li>
        <li><a href="recruit_list.php">Recruit</a></li>
        <li class="active"><a href="job_posting_list.php">Job Posting</a></li>
        <li><a href="company_introduction.php">Company Introduction</a></li>
        <li><a href="member_list.php">Member</a></li>
    </ul>
</div>

<div id="admin_contents">
<div class="page_top">
    <h2>Job Posting</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<div class="button_area">
    <div class="left">
        <a class="txt_button" href="javascript:del_data();">삭제하기</a>
    </div>
    <div class="right">
        <a class="txt_button" href="job_posting_list.php">리스트 가기</a>
        <a class="txt_button" href="javascript:update_data();">수정하기</a>
    </div>
</div>

<div class="section">
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="18%" />
                <col width="15%" />
                <col width="18%" />
                <col width="15%" />
                <col width="19%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">등록일자</th>
                <td class="val"><?= $row['regdate'] ?></td>
                <th class="tit" scope="row">전시여부</th>
                <td class="val"><?= ($row['is_show'] == 'Y') ? 'YES' : 'NO'  ?></td>
                <th class="tit" scope="row">지원자</th>
                <td class="val"><?= $row['applicants_cnt'] ?></td>
            </tr>
            </tbody>
        </table>

        <br />

        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="35%" />
                <col width="15%" />
                <col width="35%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">제목</th>
                <td class="val" colspan="3"><strong>[<?= CommonUtils::getHirePart($row['hire_part']) ?>] <?= $row['title'] ?></strong></td>
            </tr>
<?
// 모집기간 문자열
$str_is_always = '';
$start_date = ''; $end_date = '';

if($row['is_always'] == 'Y') {
    $str_is_always = '상시';
} else {
    $sy = $row['start_date_y'];
    $sm = $row['start_date_m'];
    $sd = $row['start_date_d'];
    $start_date = $sy.'.'.$sm.'.'.$sd;

    $ey = $row['end_date_y'];
    $em = $row['end_date_m'];
    $ed = $row['end_date_d'];
    $end_date = $ey.'.'.$em.'.'.$ed;

    $str_is_always = $start_date.' ~ '.$end_date;
}
?>
            <tr>
                <th class="tit" scope="row">모집기간</th>
                <td class="val" colspan="3"><?= $str_is_always ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">고용형태</th>
                <td class="val"><?= CommonUtils::getHireTypes($row['hire_types']) ?></td>
                <th class="tit" scope="row">모집인원</th>
                <td class="val"><?= $row['how_many'] ?>명</td>
            </tr>
            <tr>
                <th class="tit" scope="row">근무부서</th>
                <td class="val"><?= CommonUtils::getHirePart($row['hire_part']) ?></td>
                <th class="tit" scope="row">채용직급</th>
                <td class="val"><?= CommonUtils::getPosition($row['position']) ?></td>
            </tr>
<?
$str_career_years = '';
if($row['career_types'] == 'Y') {
    $str_career_years = $row['career_years'].'년';
} else {
    $str_career_years = '';
}
?>
            <tr>
                <th class="tit" scope="row">경력사항</th>
                <td class="val"><?= CommonUtils::getCareerTypes($row['career_types']) ?> <?= $str_career_years ?></td>
                <th class="tit" scope="row">최종학력</th>
                <td class="val"><?= CommonUtils::getSchoolTypes($row['school_types']) ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">성별</th>
                <td class="val"><?= CommonUtils::getGender($row['gender']) ?></td>
                <th class="tit" scope="row">나이</th>
                <td class="val"><? if($row['old_types'] == 'NO') { echo '무관'; } else { echo $row['how_old']; } ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">복리후생</th>
                <td class="val" colspan="3"><?= nl2br($row['descriptions']) ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">담당자 정보</th>
                <td class="val" colspan="3">
                    <?= $row['keeper_name'] ?> / <?= $row['keeper_contacts'] ?>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">내용</th>
                <td class="val" colspan="3"><?= nl2br($row['add_descriptions']) ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <!-- 상단 영역 -->
    <div class="area_top">
        <div class="left">
            <select class="select">
                <option value="10">10개씩보기</option>
                <option value="20">20개씩보기</option>
                <option value="50">50개씩보기</option>
                <option value="100">100개씩보기</option>
            </select>
        </div>
    </div>
    <!-- //상단 영역 -->

    <!-- 데이터 테이블 -->
    <div class="data_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="6%" />
                <col width="32%" />
                <col width="7%" />
                <col width="10%" />
                <col width="10%" />
                <col width="9%" />
                <col width="8%" />
                <col width="8%" />
                <col width="10%" />
            </colgroup>
            <thead>
            <tr>
                <th><a class="asc" href="#">No</a></th>
                <th><a class="desc" href="#">제목</a></th>
                <th><a class="desc" href="#">경력</a></th>
                <th><a class="desc" href="#">고용형태</a></th>
                <th><a class="desc" href="#">모집기간</a></th>
                <th><a class="desc" href="#">부서</a></th>
                <th><a class="desc" href="#">지원</a></th>
                <th><a class="desc" href="#">전시</a></th>
                <th><a class="desc" href="#">등록일자</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>10</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>Y</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>9</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>경력4년</td>
                <td>계약직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>디자인실</td>
                <td>15</td>
                <td>Y</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>8</td>
                <td class="job_subject"><strong class="current">[운영디자인] 면세점 디자이너를 모집합니다.</strong></td>
                <td>무관</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>퍼블리싱팀</td>
                <td>15</td>
                <td>Y</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>7</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>Y</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>6</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>Y</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>5</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>Y</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>4</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>N</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>3</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>N</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>2</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>N</td>
                <td>2013.01.05</td>
            </tr>
            <tr>
                <td>1</td>
                <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
                <td>신입</td>
                <td>정규직</td>
                <td>2013.01.01 ~<br />2013.03.30</td>
                <td>기획실</td>
                <td>15</td>
                <td>N</td>
                <td>2013.01.05</td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- //데이터 테이블 -->

    <!-- 페이징 -->
    <div class="paginate">
        <a class="direction" href="#"><span>‹</span> 이전페이지</a>
        <a href="#">11</a>
        <strong>12</strong>
        <a href="#">13</a>
        <a href="#">14</a>
        <a href="#">15</a>
        <a href="#">16</a>
        <a href="#">17</a>
        <a href="#">18</a>
        <a href="#">19</a>
        <a href="#">20</a>
        <a class="direction" href="#">다음페이지 <span>›</span></a>
    </div>
    <!-- //페이징 -->
</div>

<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
