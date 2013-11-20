<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

require_once('./auth.php');

require_once('../classes/utils/CommonUtils.php');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');
require_once('../classes/domain/Work.php');

require_once('../classes/dao/AttachesDaoImpl.php');
require_once('../classes/service/AttachesServiceImpl.php');

require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');
require_once('../classes/domain/Keeper.php');


$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

$attachesDaoImpl = new AttachesDaoImpl();
$attachesServiceImpl = new AttachesServiceImpl();
$attachesServiceImpl->setAttachesDao($attachesDaoImpl);


// get parameters
$work_id = $_REQUEST['work_id'];

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
$strWT = CommonUtils::getProjectTypes($wtypes);


// 메뉴 관련 권한 얻기
$keeperDaoImpl = new KeeperDaoImpl();
$keeperServiceImpl = new KeeperServiceImpl();
$keeperServiceImpl->setKeeperDao($keeperDaoImpl);
$keeper = new Keeper();
$keeper->setId($_COOKIE["keeper_id"]);

$keeper = $keeperServiceImpl->detail($conn, $keeper);
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

        changeRcpp = function(obj) {
            var sV = obj[obj.selectedIndex].value;

            var form = document.forms.sch_form;
            form.rcpp.value = sV;
            form.curPage.value = 1;

            form.submit();
        }

        orderb = function(ids, idt, idx) {

            // 모두 asc로 변경함
            for(var i=0; i<6; i++) {
                document.getElementById('o' + (i+1)).className = 'asc';
            }

            var ods = '<?= $orderDirS ?>';
            var arrOds = ods.split("^");
            for(var x=0; x<6; x++) {
                if(idx == x) {
                    if(arrOds[idx] == 'f') {
                        arrOds[idx] = 't';
                    } else {
                        arrOds[idx] = 'f';
                    }
                } else {
                    arrOds[x] = 'f';
                }
            }

            var nOds = '';
            for(var x=0; x<6; x++) {
                nOds += arrOds[x] + "^";
            }

            var form = document.forms.sch_form;
            form.curPage.value = 1;
            form.orderBy.value = ids;
            form.orderDirS.value = nOds;
            form.orderDir.value = (arrOds[idx] == 't') ? 'desc' : 'asc';
            form.submit();
        }

        goPaging = function(c, r) {
            var form = document.forms.sch_form;

            form.curPage.value = c;
            form.rcpp.value = r;

            form.submit();
        }

        goDetail = function(id) {
            var form = document.sch_form;
            form.work_id.value = id;

            form.action = "work_list_view.php";
            form.submit();
        }

        goList = function() {
            var form = document.sch_form;
            form.action = "work_list.php";
            form.submit();
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
        <? if(($keeper->getMenu1() & 32) > 0) { ?><a class="txt_button" href="javascript:del_data('<?=  $work_id ?>');">삭제하기</a><? } ?>
    </div>
    <div class="right">
        <a class="txt_button" href="javascript:goList();">리스트 가기</a>
        <? if(($keeper->getMenu1() & 16) > 0) { ?><a class="txt_button" href="work_revise.php?work_id=<?= $work_id ?>&order_by=<?= $orderBy ?>&order_dir=<?= $orderDir ?>wParam=<?= $wParam ?>">수정하기</a><? } ?>
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

<?
// 한 페이지에서 보여줄 갯수
$rowCountPerPage = 0;
$rowCountPerPage = ($_REQUEST['rcpp'] != '') ?  $_REQUEST['rcpp'] : 10;

$orderBy = $_REQUEST['orderBy'];
if($orderBy == '') {
    $orderBy = ' regdate_r ';
}

$orderDir = $_REQUEST['orderDir'];
if($orderDir == '') {
    $orderDir = ' DESC ';
}

$orderDirS = $_REQUEST['orderDirS'];
if($orderDirS == '') {
    $orderDirS = 't^t^t^t^t^t^';
}

$curPage = $_REQUEST['curPage'];
if($curPage == '') {
    $curPage = 1;
}

// 검색조건
$schPeriod = $_REQUEST['sch_period'];
$schDateType = $_REQUEST['sch_date_type'];
$schDateFrom = $_REQUEST['sch_date_from'];
$schDateTo = $_REQUEST['sch_date_to'];
$schIsShopR = $_REQUEST['sch_is_shop_r'];
$schWtypesR = (int) ('0' + $_REQUEST['sch_wtypes_r']);
$schGubun = $_REQUEST['sch_gubun'];
$schText = $_REQUEST['sch_text'];

// 조건절 구성
$wParam = '';
if($schPeriod == 'Y') {
    // 기간 선택이 체크 되어야지만 기간 선택이 수행
    if($schDateType == 'R') {
        $wParam .= " AND (regdate >= '".$schDateFrom."' AND regdate <= '".$schDateTo."') ";
    } else {
        $wParam .= " AND (moddate >= '".$schDateFrom."' AND moddate <= '".$schDateTo."') ";
    }
}

// 전시여부
if($schIsShopR != '') {
    if($schIsShopR == 1) {
        $wParam .= " AND is_shop='Y' ";
    } else if($schIsShopR == 2) {
        $wParam .= " AND is_shop='N' ";
    } else if($schIsShopR == 3) {
        $wParam .= " AND (is_shop='Y' OR is_shop='N') ";
    }
}

// 유형
if($schWtypesR > 0) {
    $wParam .= " AND (wtypes & ".$schWtypesR.") > 0 ";
}

// 검색어
if($schText != '') {
    if($schGubun == 'P') {
        $wParam .= " AND name LIKE '%".$schText."%' ";
    } else if($schGubun == 'C') {
        $wParam .= " AND client_name LIKE '%".$schText."%' ";
    } else {
        $wParam .= " AND url LIKE '%".$schText."%' ";
    }
}

$totalCnt = $workServiceImpl->listsCount($conn, $wParam);
$result = $workServiceImpl->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $rowCountPerPage);
?>
<div class="section">
    <form name="sch_form" action="<?= $_SERVER['PHP_SELF'] ?>?rcpp=<?= $rowCountPerPage ?>&curPage=<?= $curPage ?>" method="GET">
        <input type="hidden" name="sch_is_shop_r" value="<?= $schIsShopR ?>" />
        <input type="hidden" name="sch_wtypes_r" value="<?= $schWtypesR ?>" />
        <input type="hidden" name="rcpp" value="<?= $rowCountPerPage ?>" />
        <input type="hidden" name="curPage" value="<?= $curPage ?>" />
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>" />
        <input type="hidden" name="orderDir" value="<?= $orderDir ?>" />
        <input type="hidden" name="orderDirS" value="<?= $orderDirS ?>" />
        <input type="hidden" name="work_id" value="<?= $work_id ?>" />
    </form>

    <!-- 상단 영역 -->
    <div class="area_top">
        <div class="left">
            <select class="select" name="rcpp" onchange="changeRcpp(this);">
                <option value="10" <? if($rowCountPerPage == '10') echo ' selected'; ?>>10개씩보기</option>
                <option value="20" <? if($rowCountPerPage == '20') echo ' selected'; ?>>20개씩보기</option>
                <option value="50" <? if($rowCountPerPage == '50') echo ' selected'; ?>>50개씩보기</option>
                <option value="100" <? if($rowCountPerPage == '100') echo ' selected'; ?>>100개씩보기</option>
            </select>
        </div>
        <div class="right">
            <?  if(($keeper->getMenu1() & 8) > 0) {  ?><a class="txt_button" href="work_write.php">신규등록</a><? } ?>
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
<?
$arrASC = explode('^', $orderDirS);
$a1 = ($arrASC[0] == 'f') ? 'asc' : 'desc';
$a2 = ($arrASC[1] == 'f') ? 'asc' : 'desc';
$a3 = ($arrASC[2] == 'f') ? 'asc' : 'desc';
$a4 = ($arrASC[3] == 'f') ? 'asc' : 'desc';
$a5 = ($arrASC[4] == 'f') ? 'asc' : 'desc';
$a6 = ($arrASC[5] == 'f') ? 'asc' : 'desc';
?>
            <tr>
                <th><a class="<?= $a1 ?>" id="o1" href="javascript:orderb('regdate', 'o1', 0);">No</a></th>
                <th><a class="<?= $a2 ?>" id="o2" href="javascript:orderb('name', 'o2', 1);">제목</a></th>
                <th><a class="<?= $a3 ?>" id="o3" href="javascript:orderb('regdate', 'o3', 2);">등록일</a></th>
                <th><a class="<?= $a4 ?>" id="o4" href="javascript:orderb('moddate', 'o4', 3);">수정일</a></th>
                <th><a class="<?= $a5 ?>" id="o5" href="javascript:orderb('keeper_id', 'o5', 4);">등록ID</a></th>
                <th><a class="<?= $a6 ?>" id="o6" href="javascript:orderb('is_shop', 'o6', 5);">전시</a></th>
            </tr>
            </thead>
            <tbody>
<?
// 권한에서 리스트 권한이 있는 경우에만 출력됨
if(($keeper->getMenu1() & 2) > 0) {

if($totalCnt > 0) {
    //$bPage = (($curPage - 1) * $rowCountPerPage) + 1;
    $bPage = $totalCnt - (($curPage - 1) * $rowCountPerPage) + 1;
    $idx = 0;
    while($row = mysql_fetch_array($result)) {
        $bPage--;
        $idx = $row['id'];
?>
                    <tr>
                        <td><?= $bPage ?></td>
                        <td class="title"><? if(($keeper->getMenu1() & 4) > 0) { ?><a href="javascript:goDetail('<?= $idx ?>');"><?= $row['name'] ?></a><? } else { ?><?= $row['name'] ?><? } ?></td>
                        <td><?= $row['regdate'] ?></td>
                        <td><?= $row['moddate'] ?></td>
                        <td><?= $row['keeper_id'] ?></td>
                        <td class="active y"><?= $row['is_shop'] ?></td>
                    </tr>
<?
    }
}
?>
            </tbody>
        </table>
    </div>
    <!-- //데이터 테이블 -->


    <!-- 페이징 -->
<?
$divPage = (int) ($totalCnt / $rowCountPerPage);
$modPage = $totalCnt % $rowCountPerPage;

$totalPage = ($modPage == 0) ? $divPage : ($divPage + 1);
?>
    <div class="paginate">
<?
// Prev block
if($curPage > 1) {
    //echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam='.$wParam.'&orerBy=&curPage='.($curPage-1).'&rcpp='.$rowCountPerPage.'"><span>‹</span> 이전페이지</a>';
    echo "<a class='direction' href='javascript:goPaging(".($curPage-1).",".$rowCountPerPage.");'><span>‹</span> 이전페이지</a>";
} else {
    echo '<span>‹</span> 이전페이지';
}

$strPage = '';
for($k = 1; $k <= $totalPage; $k++) {
    if($curPage == $k) {
        $strPage = '<a href=><strong>'.$k.'</strong></a>';
    } else {
        //$strPage = '<a href="'.$_SERVER[PHP_SELF].'?wParam='.$wParam.'&orderBy=&curPage='.$k.'&rcpp='.$rowCountPerPage.'">'.$k.'</a>';
        $strPage = "<a href='javascript:goPaging(".$k.",".$rowCountPerPage.");'>".$k."</a>";
    }

    // 1, 2, 3, 4, 5, 6 ...
    echo $strPage;
}

// Next block
if($curPage < $totalPage) {
    //echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam='.$wParam.'&orderBy=&curPage='.($curPage+1).'&rcpp='.$rowCountPerPage.'">다음페이지 <span>›</span></a>';
    echo "<a class='direction' href='javascript:goPaging(".($curPage+1).",".$rowCountPerPage.");'>다음페이지 <span>›</span></a>";
} else {
    echo '다음페이지 <span>›</span>';
}
?>
        <!-- //페이징 -->
    </div>
<?
}
?>

<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
