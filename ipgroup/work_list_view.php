<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

require_once('./auth.php');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');
require_once('../classes/domain/Work.php');

require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');


$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// get parameters
$work_id = $_REQUEST['work_id'];
$orderBy = $_REQUEST['order_by'];
$orderDir = $_REQUEST['order_dir'];
$wParam = $_REQUEST['wParam'];

// get detail informations
$workObj = new Work();
$workObj->setId($work_id);

$result = $workServiceImpl->detail($conn, $workObj);
$row = @mysql_fetch_array($result);


// get file attaches
$result2 =  $attachesServiceImpl->lists($conn, $work_id);


// 오픈일 날짜 조합
$oy = $row['open_date_y'];
$om = $row['open_date_m'];
$od = $row['open_date_d'];

$open_date = ($oy != '') ? $oy.'.'.$om.'.'.$od : '';


// 프로젝트 시작,종료 날짜 조합
$sy = $row['start_date_y'];
$sm = $row['start_date_m'];
$sd = $row['start_date_d'];

$start_date = ($oy != '') ? $sy.'.'.$sm.'.'.$sd : '';

$ey = $row['end_date_y'];
$em = $row['end_date_m'];
$ed = $row['end_date_d'];

$end_date = ($oy != '') ? $ey.'.'.$em.'.'.$ed : '';


// 유형선택을 문자열로 변경
$wtypes = (int) $row['wtypes'];
$strWT = '';

if(($wtypes & 1) == 1) {
    $strWT .= 'Project ';
}
if(($wtypes & 2) == 2) {
    $strWT = $strWT.'Promotion ';
}
if(($wtypes & 4) == 4) {
    $strWT = $strWT.'UX/UI ';
}
if(($wtypes & 8) == 8) {
    $strWT = $strWT.'Mobile ';
}
if(($wtypes & 16) == 16) {
    $strWT = $strWT.'Offer ';
}
if(($wtypes & 32) == 32) {
    $strWT = $strWT.'Consulting ';
}
if(($wtypes & 64) == 64) {
    $strWT = $strWT.'AD ';
}

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
        del_data = function(wi) {
            if(confirm(CONFIRM_DELETE)) {
                location.href = "./work_delete_post.php?work_id=" + wi;
            } else {
                return;
            }
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
        <li class="active"><a href="work_list.php">Work</a></li>
        <li><a href="request_list.php">Request</a></li>
        <li><a href="recruit_list.php">Recruit</a></li>
        <li><a href="job_posting_list.php">Job Posting</a></li>
        <li><a href="company_introduction.php">Company Introduction</a></li>
        <li><a href="member_list.php">Member</a></li>
    </ul>
</div>

<div id="admin_contents">
<div class="page_top">
    <h2>Work</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<div class="button_area">
    <div class="left">
        <a class="txt_button" href="javascript:del_data('<?=  $work_id ?>');">삭제하기</a>
    </div>
    <div class="right">
        <a class="txt_button" href="work_list.php">리스트 가기</a>
        <a class="txt_button" href="work_revise.php?work_id=<?= $work_id ?>&order_by=<?= $orderBy ?>&order_dir=<?= $orderDir ?>wParam=<?= $wParam ?>">수정하기</a>
    </div>
</div>

<div class="section">
    <h3>등록 정보</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="35%" />
                <col width="15%" />
                <col width="35%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">등록일</th>
                <td class="val"><?= $row['regdate'] ?></td>
                <th class="tit" scope="row">등록ID</th>
                <td class="val"><?= $row['keeper_id'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">최종 수정일</th>
                <td class="val"><?= $row['moddate'] ?></td>
                <th class="tit" scope="row">최종 수정ID</th>
                <td class="val"><?= $row['mod_id'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">전시여부</th>
                <td class="val"><?= $row['is_shop'] ?></td>
                <th class="tit" scope="row">NO</th>
                <td class="val"><?= $row['id'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <h3>썸네일 정보</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="85%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">썸네일 유형</th>
                <td class="val"><?= $row['thumb_types'] ?>단</td>
            </tr>
            <tr>
                <th class="tit" scope="row">썸네일 제목</th>
                <td class="val"><?= $row['thumb_title'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">썸네일 부제목</th>
                <td class="val"><?= $row['thumb_sub_title'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">오픈일</th>
                <td class="val"><?= $open_date ?></td>
            </tr>
<?
$ta1 = ''; $ta2 = '';
$ta1_transfer = ''; $ta2_transfer = '';
while($row2 = mysql_fetch_array($result2)) {

    if($row2['stypes'] == 'T1') {
        $ta1 = $row2['original_filename'];
        $ta1_transfer = $row2['transfer_filename'];
    } else if($row2['stypes'] == 'T2') {
        $ta2 = $row2['original_filename'];
        $ta2_transfer = $row2['transfer_filename'];
    }
}
?>
            <tr>
                <th class="tit" scope="row">썸네일 첨부 1단</th>
                <td class="val">
                    <ul class="fileinfo">
                        <li>
                            <span class="filename"><?= ($ta1 != "") ? $ta1 : "" ?></span>
                            <? if($ta1_transfer != "") { ?><a href="/uploaded/work/<?= $ta1_transfer ?>" target="_blank">[보기]</a><? } ?>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">썸네일 첨부 2단</th>
                <td class="val">
                    <ul class="fileinfo">
                        <li>
                            <span class="filename"><?= ($ta2 != "") ? $ta2 : "" ?></span>
                            <? if($ta2_transfer != "") { ?><a href="/uploaded/work/<?= $ta2_transfer ?>" target="_blank">[보기]</a><? } ?>
                        </li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <h3>상세 정보</h3>
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="85%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">유형선택</th>
                <td class="val"><?= $strWT ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">프로젝트명</th>
                <td class="val"><?= $row['name'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">클라이언트</th>
                <td class="val"><?= $row['client_name'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">프로젝트 기간</th>
                <td class="val"><?= $start_date ?> ~ <?= $end_date ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">URL</th>
                <td class="val"><?= $row['url'] ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">내용설명</th>
                <td class="val"><?= nl2br($row['descriptions']) ?>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">첨부파일</th>
                <td class="val">
                    <ul class="fileinfo">
<?
$wa = ''; $wa_t = '';
mysql_data_seek($result2, 0);
while($row3 = mysql_fetch_array($result2)) {
    if($row3['stypes'] != 'T1' && $row3['stypes'] != 'T2') {
        $wa = $row3['original_filename'];
        $wa_t = $row3['transfer_filename'];
?>
                        <li>
                            <span class="filename"><?= ($wa != "") ? $wa : "" ?></span>
                            <? if($wa_t != "") { ?><a href="/uploaded/work/<?= $wa_t ?>" target="_blank">[보기]</a><? } ?>
                        </li>
<?
    }
}
?>
                    </ul>
                </td>
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
        <div class="right">
            <a class="txt_button" href="work_write.php">신규등록</a>
        </div>
    </div>
    <!-- //상단 영역 -->

    <!-- 데이터 테이블 -->
    <div class="data_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="7%" />
                <col width="49%" />
                <col width="12%" />
                <col width="12%" />
                <col width="12%" />
                <col width="8%" />
            </colgroup>
            <thead>
            <tr>
                <th><a class="asc" href="#">No</a></th>
                <th><a class="desc" href="#">제목</a></th>
                <th><a class="desc" href="#">등록일</a></th>
                <th><a class="desc" href="#">수정일</a></th>
                <th><a class="desc" href="#">등록ID</a></th>
                <th><a class="desc" href="#">전시</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>10</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>9</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>8</td>
                <td class="title"><strong class="current">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분 프로젝트 제목 나오는 부분</strong></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>7</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>6</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active n">N</td>
            </tr>
            <tr>
                <td>5</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active n">N</td>
            </tr>
            <tr>
                <td>4</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>3</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>2</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
            </tr>
            <tr>
                <td>1</td>
                <td class="title"><a href="work_list_view.php">아이피그룹 웹사이트 리뉴얼 프로젝트 제목 나오는 부분</a></td>
                <td>2012/12/28</td>
                <td>2012/12/28</td>
                <td>admin</td>
                <td class="active y">Y</td>
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
