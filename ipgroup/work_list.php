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

$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

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
    $orderDirS = 'f^f^f^f^f^f^';
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

        goDetail = function(id) {
            var form = document.sch_form;
            form.work_id.value = id;

            form.action = "work_list_view.php";
            form.submit();
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
            form.orderDir.value = (arrOds[idx] == 't') ? 'asc' : 'desc';
            form.submit();
        }

        goPaging = function(c, r) {
            var form = document.forms.sch_form;

            form.curPage.value = c;
            form.rcpp.value = r;

            form.submit();
        }

        goSearch = function() {
            var form = document.forms.sch_form;

            var sch_period = form.sch_period.checked;
            var sch_date_type = '';
            for(var i=0; i<2; i++) {
                if(form.sch_date_type[i].selected == true) {
                    sch_date_type = form.sch_date_type[i].value;
                }
            }
            var sch_date_from = form.sch_date_from.value;
            var sch_date_to = form.sch_date_to.value;

            // 날짜 입력 검증
            if(sch_date_type == 'Y') {
                if(sch_date_from == '' || sch_date_to == '') {
                    alert("기간선택 시 날짜는 필수입력항목입니다.");
                    return;
                }
            }

            var sch_is_shop = 0;
            for(var j=0; j<2; j++) {
                if(form.sch_is_shop[j].checked == true) {
                    sch_is_shop += parseInt('0' + form.sch_is_shop[j].value);
                }
            }
            form.sch_is_shop_r.value = sch_is_shop;

            var sch_wtypes = 0;
            for(var k=0; k<7; k++) {
                if(form.sch_wtypes[k].checked == true) {
                    sch_wtypes += parseInt(form.sch_wtypes[k].value);
                }
            }
            form.sch_wtypes_r.value = sch_wtypes;

            var sch_gubun = '';
            for(var a=0; a<3; a++) {
                if(form.sch_gubun[a].selected == true) {
                    sch_gubun = form.sch_gubun[a].value;
                }
            }
            var sch_text = form.sch_text.value;
            form.submit();
            //alert(sch_period + ':' + sch_date_type + ':' + sch_date_from + ':' + sch_date_to + ':' + sch_wtypes + ':' + sch_gubun + ':' + sch_text);
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
<?
$totalCnt = $workServiceImpl->listsCount($conn, $wParam);
$result = $workServiceImpl->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $rowCountPerPage);
?>
<div id="admin_contents">
<div class="page_top">
    <h2>Work</h2>
</div>
<div class="container">
    <!-- 본문 영역 -->

    <form name="sch_form" action="<?= $_SERVER['PHP_SELF'] ?>?rcpp=<?= $rowCountPerPage ?>&curPage=<?= $curPage ?>" method="GET">
        <input type="hidden" name="sch_is_shop_r" value="<?= $schIsShopR ?>" />
        <input type="hidden" name="sch_wtypes_r" value="<?= $schWtypesR ?>" />
        <input type="hidden" name="rcpp" value="<?= $rowCountPerPage ?>" />
        <input type="hidden" name="curPage" value="<?= $curPage ?>" />
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>" />
        <input type="hidden" name="orderDir" value="<?= $orderDir ?>" />
        <input type="hidden" name="orderDirS" value="<?= $orderDirS ?>" />
        <input type="hidden" name="work_id" value="" />
    <div class="section">
        <div class="form_search">
            <dl>
                <dt class="t">기간선택 :</dt>
                <dd>
                    <input type="checkbox" id="sch_period" name="sch_period" value="Y"  <? if($schPeriod == 'Y') { echo ' checked'; } ?> />
                    <select class="select" name="sch_date_type" id="sch_date_type">
                        <option value="R"  <? if($schDateType == 'R') { echo ' selected'; } ?>>등록일자</option>
                        <option value="M"  <? if($schDataType == 'M') { echo ' selected'; } ?>>수정일자</option>
                    </select>
                    <input id="date_from" name="sch_date_from" class="i_text date" type="text" value="<?= $schDateFrom ?>" />
                    ~
                    <input id="date_to" name="sch_date_to" class="i_text date" type="text" value="<?= $schDateTo ?>" />
                </dd>
                <script type="text/javascript">
                    init_from_to_date();
                </script>

                <dt>전시여부 : </dt>
                <dd>
                    <input id="ck_a_1" type="checkbox" name="sch_is_shop" value="1" <? if(($schIsShopR & 1) > 0) { echo ' checked'; } ?> /><label for="ck_a_1">YES</label>
                    <input id="ck_a_2" type="checkbox" name="sch_is_shop" value="2" <? if(($schIsShopR & 2) > 0) { echo ' checked'; } ?> /><label for="ck_a_2">NO</label>
                </dd>

                <dt>유형 : </dt>
                <dd>
                    <input id="ck_b_1" name="sch_wtypes" value="1" type="checkbox" <? if(($schWtypesR & 1) > 0) { echo ' checked'; } ?> /><label for="ck_b_1">Project</label>
                    <input id="ck_b_2" name="sch_wtypes" value="2" type="checkbox" <? if(($schWtypesR & 2) > 0) { echo ' checked'; } ?> /><label for="ck_b_2">Promotion</label>
                    <input id="ck_b_3" name="sch_wtypes" value="4" type="checkbox" <? if(($schWtypesR & 4) > 0) { echo ' checked'; } ?> /><label for="ck_b_3">UX/UI</label>
                    <input id="ck_b_4" name="sch_wtypes" value="8" type="checkbox" <? if(($schWtypesR & 8) > 0) { echo ' checked'; } ?> /><label for="ck_b_4">Mobile</label>
                    <input id="ck_b_5" name="sch_wtypes" value="16" type="checkbox" <? if(($schWtypesR & 16) > 0) { echo ' checked'; } ?> /><label for="ck_b_5">Proposal</label>
                    <input id="ck_b_6" name="sch_wtypes" value="32" type="checkbox" <? if(($schWtypesR & 32) > 0) { echo ' checked'; } ?> /><label for="ck_b_6">Consulting</label>
                    <input id="ck_b_7" name="sch_wtypes" value="64" type="checkbox" <? if(($schWtypesR & 64) > 0) { echo ' checked'; } ?> /><label for="ck_b_7">AD</label>
                </dd>
            </dl>

            <div class="keyword_area">
                <select class="select" name="sch_gubun" id="sch_gubun">
                    <option value="P" <? if($schGubun == 'P') { echo ' selected'; } ?>>프로젝트명</option>
                    <option value="C" <? if($schGubun == 'C') { echo ' selected'; } ?>>클라이언트</option>
                    <option value="U" <? if($schGubun == 'U') { echo ' selected'; } ?>>URL</option>
                </select>
                <input class="keyword" type="text" name="sch_text" id="sch_text" value="<?= $schText ?>" />
                <a class="txt_button" href="javascript:goSearch();">검색</a>
            </div>
        </div>

    </div>
    </form>


    <div class="section">
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
if($totalCnt > 0) {
    $bPage = (($curPage - 1) * $rowCountPerPage) + 1;
    $idx = 0;
    while($row = mysql_fetch_array($result)) {
        $bPage++;
        $idx = $row['id'];
?>
                <tr>
                    <td><?= $bPage - 1 ?></td>
                    <td class="title"><a href="javascript:goDetail('<?= $idx ?>');"><?= $row['name'] ?></a></td>
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

    <!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
