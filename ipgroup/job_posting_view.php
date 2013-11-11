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

        goList = function() {
            var form = document.sch_form;
            form.action = "job_posting_list.php";
            form.submit();
        }

        goSearch = function() {
            var form = document.forms.sch_form;

            var sch_period = form.sch_period.checked;
            var sch_date_from = form.sch_date_from.value;
            var sch_date_to = form.sch_date_to.value;

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

            // 전시여부
            var sch_is_show = 0;
            for(var j=0; j<2; j++) {
                if(form.sch_is_show[j].checked == true) {
                    sch_is_show += parseInt('0' + form.sch_is_show[j].value);
                }
            }
            form.sch_is_show_r.value = sch_is_show;

            // 고용형태
            var sch_hire_types = 0;
            for(var k=0; k<2; k++) {
                if(form.sch_hire_types[k].checked == true) {
                    sch_hire_types += parseInt(form.sch_hire_types[k].value);
                }
            }
            form.sch_hire_types_r.value = sch_hire_types;

            // 학력
            var sch_school_type = 0;
            for(var k=0; k<4; k++) {
                if(form.school_type[k].checked == true) {
                    sch_school_type += parseInt(form.school_type[k].value);
                }
            }
            form.sch_school_types_r.value = sch_school_type;

            // 경력
            var sch_career_types = 0;
            for(var k=0; k<2; k++) {
                if(form.career_types[k].checked == true) {
                    sch_career_types += parseInt(form.career_types[k].value);
                }
            }
            form.sch_career_types_r.value = sch_career_types;

            // 고용부서
            var sch_hire_part = 0;
            for(var k=0; k<4; k++) {
                if(form.hire_part[k].checked == true) {
                    sch_hire_part += parseInt(form.hire_part[k].value);
                }
            }
            form.sch_hire_part_r.value = sch_hire_part;

            var sch_text = form.sch_text.value;
            form.submit();
        }

        orderb = function(ids, idt, idx) {

            // 모두 asc로 변경함
            for(var i=0; i<9; i++) {
                document.getElementById('o' + (i+1)).className = 'asc';
            }

            var ods = '<?= $orderDirS ?>';
            var arrOds = ods.split("^");
            for(var x=0; x<9; x++) {
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
            for(var x=0; x<9; x++) {
                nOds += arrOds[x] + "^";
            }

            var form = document.forms.sch_form;
            form.curPage.value = 1;
            form.orderBy.value = ids;
            form.orderDirS.value = nOds;
            form.orderDir.value = (arrOds[idx] == 't') ? 'asc' : 'desc';
            form.submit();
        }

        goDetail = function(id) {
            var form = document.sch_form;
            form.jids.value = id;

            form.action = "job_posting_view.php";
            form.submit();
        }

        changeRcpp = function(obj) {
            var sV = obj[obj.selectedIndex].value;

            var form = document.forms.sch_form;
            form.rcpp.value = sV;
            form.curPage.value = 1;

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

$seDate = '';
if($row['is_always'] == 'N') {
    $sDate = $row['start_date_y'].'.'.$row['start_date_m'].'.'.$row['start_date_d'];
    $eDate = $row['end_date_y'].'.'.$row['end_date_m'].'.'.$row['end_date_d'];
    $seDate = $sDate.' ~<br />'.$eDate;
} else {
    $seDate = '상시';
}

// 모집인원
$hmS = '';
if($row['how_many'] > 0) {
    $hmS = $row['how_many'];
} else {
    $hmS = '0';
}
?>
            <tr>
                <th class="tit" scope="row">모집기간</th>
                <td class="val" colspan="3"><?= $seDate ?></td>
            </tr>
            <tr>
                <th class="tit" scope="row">고용형태</th>
                <td class="val"><?= CommonUtils::getHireTypes($row['hire_types']) ?></td>
                <th class="tit" scope="row">모집인원</th>
                <td class="val"><?= $hmS ?>명</td>
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

<?
// 한 페이지에서 보여줄 갯수
$rowCountPerPage = 0;
$rowCountPerPage = ($_REQUEST['rcpp'] != '') ? $_REQUEST['rcpp'] : 10;

$orderBy = $_REQUEST['orderBy'];
if ($orderBy == '') {
    $orderBy = ' regdate_r ';
}

$orderDir = $_REQUEST['orderDir'];
if ($orderDir == '') {
    $orderDir = ' DESC ';
}

$orderDirS = $_REQUEST['orderDirS'];
if ($orderDirS == '') {
    $orderDirS = 'f^f^f^f^f^f^f^f^f^';
}

$curPage = $_REQUEST['curPage'];
if ($curPage == '') {
    $curPage = 1;
}

// 검색조건
$schPeriod = $_REQUEST['sch_period'];
$schDateType = $_REQUEST['sch_date_type'];
$schDateFrom = $_REQUEST['sch_date_from'];
$schDateTo = $_REQUEST['sch_date_to'];
$schIsShopR = $_REQUEST['sch_is_show_r'];
$schCareerTypesR = (int)('0' + $_REQUEST['sch_career_types_r']);
$schSchoolTypesR = (int)('0' + $_REQUEST['sch_school_types_r']);
$schHireTypesR = (int)('0' + $_REQUEST['sch_hire_types_r']);
$schHirePartR = (int)('0' + $_REQUEST['sch_hire_part_r']);
$schText = $_REQUEST['sch_text'];

// 조건절 구성
$wParam = '';
if ($schPeriod == 'Y') {
// 기간 선택이 체크 되어야지만 기간 선택이 수행
    if ($schDateType == 'R') {
        $wParam .= " AND (concat(start_date_y,'.',start_date_m,'.',start_date_d) >= '" . $schDateFrom . "' AND concat(end_date_y,'.',end_date_m,'.',end_date_d) <= '" . $schDateTo . "') ";
    } else {
        $wParam .= " AND (regdate >= '" . $schDateFrom . "' AND regdate <= '" . $schDateTo . "') ";
    }
}

// 전시여부
if ($schIsShopR != '') {
    if ($schIsShopR == 1) {
        $wParam .= " AND is_show='Y' ";
    } else if ($schIsShopR == 2) {
        $wParam .= " AND is_show='N' ";
    } else if ($schIsShopR == 3) {
        $wParam .= " AND (is_show='Y' OR is_show='N') ";
    }
}

// 고용형태(정규직, 계약직)
if ($schHireTypesR != '') {
    if ($schHireTypesR == 1) {
        $wParam .= " AND hire_types='RG' ";
    } else if ($schHireTypesR == 2) {
        $wParam .= " AND hire_types='PT' ";
    } else if ($schHireTypesR == 3) {
        $wParam .= " AND (hire_types='RG' OR hire_types='PT') ";
    }
}

// 학력
if ($schSchoolTypesR > 0) {
//$wParam .= " AND (a.school_type & ".$schSchoolTypesR.") > 0 ";
    $arrSS = array();
    if (($schSchoolTypesR & 1) > 0) {
        array_push($arrSS, 'HS');
    }
    if (($schSchoolTypesR & 2) > 0) {
        array_push($arrSS, 'CL');
    }
    if (($schSchoolTypesR & 4) > 0) {
        array_push($arrSS, 'UV');
    }
    if (($schSchoolTypesR & 8) > 0) {
        array_push($arrSS, 'NG');
    }

    $strSS = '';
    $sizeSS = count($arrSS);
    for ($i = 0; $i < $sizeSS; $i++) {
        $strSS .= "'" . $arrSS[$i] . "'";
        if ($i < $sizeSS - 1) {
            $strSS .= ",";
        }
    }

    $wParam .= " AND school_types IN (" . $strSS . ") ";
}

// 경력
if ($schCareerTypesR > 0) {
    if ($schCareerTypesR == 1) {
        $wParam .= " AND career_types='N' ";
    } else if ($schCareerTypesR == 2) {
        $wParam .= " AND career_types='Y' ";
    } else if ($schCareerTypesR == 3) {
        $wParam .= " AND (career_types='N' OR career_types='Y') ";
    }
}

// 고용부서
if ($schHirePartR > 0) {
    $arrSS = array();
    if (($schHirePartR & 1) > 0) {
        array_push($arrSS, 'PL');
    }
    if (($schHirePartR & 2) > 0) {
        array_push($arrSS, 'DN');
    }
    if (($schHirePartR & 4) > 0) {
        array_push($arrSS, 'PB');
    }
    if (($schHirePartR & 8) > 0) {
        array_push($arrSS, 'MN');
    }

    $strSS = '';
    $sizeSS = count($arrSS);
    for ($i = 0; $i < $sizeSS; $i++) {
        $strSS .= "'" . $arrSS[$i] . "'";
        if ($i < $sizeSS - 1) {
            $strSS .= ",";
        }
    }

    $wParam .= " AND hire_part IN (" . $strSS . ") ";
}

// 검색어
if ($schText != '') {
    if ($schGubun == 'P') {
        $wParam .= " AND name LIKE '%" . $schText . "%' ";
    } else if ($schGubun == 'C') {
        $wParam .= " AND client_name LIKE '%" . $schText . "%' ";
    } else {
        $wParam .= " AND url LIKE '%" . $schText . "%' ";
    }
}

?>
<div class="section">
    <form name="sch_form" action="<?= $_SERVER['PHP_SELF'] ?>?rcpp=<?= $rowCountPerPage ?>&curPage=<?= $curPage ?>" method="GET">
        <input type="hidden" name="sch_is_show_r" value="<?= $schIsShopR ?>" />
        <input type="hidden" name="sch_hire_types_r" value="<?= $schHireTypesR ?>" />
        <input type="hidden" name="rcpp" value="<?= $rowCountPerPage ?>" />
        <input type="hidden" name="curPage" value="<?= $curPage ?>" />
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>" />
        <input type="hidden" name="orderDir" value="<?= $orderDir ?>" />
        <input type="hidden" name="orderDirS" value="<?= $orderDirS ?>" />
        <input type="hidden" name="jids" value="<?= $jids ?>" />
        <input type="hidden" name="sch_career_types_r" value="<?= $schCareerTypesR ?>" />
        <input type="hidden" name="sch_school_types_r" value="<?= $schSchoolTypesR ?>" />
        <input type="hidden" name="sch_hire_part_r" value="<?= $schHirePartR ?>" />

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
<?
$arrASC = explode('^', $orderDirS);
$a1 = ($arrASC[0] == 'f') ? 'asc' : 'desc';
$a2 = ($arrASC[1] == 'f') ? 'asc' : 'desc';
$a3 = ($arrASC[2] == 'f') ? 'asc' : 'desc';
$a4 = ($arrASC[3] == 'f') ? 'asc' : 'desc';
$a5 = ($arrASC[4] == 'f') ? 'asc' : 'desc';
$a6 = ($arrASC[5] == 'f') ? 'asc' : 'desc';
$a7 = ($arrASC[6] == 'f') ? 'asc' : 'desc';
$a8 = ($arrASC[7] == 'f') ? 'asc' : 'desc';
$a9 = ($arrASC[8] == 'f') ? 'asc' : 'desc';
?>
            <tr>
                <th><a class="<?= $a1 ?>" id="o1" href="javascript:orderb('regdate', 'o1', 0);">No</a></th>
                <th><a class="<?= $a2 ?>" id="o2" href="javascript:orderb('title', 'o2', 1);">제목</a></th>
                <th><a class="<?= $a3 ?>" id="o3" href="javascript:orderb('career_types', 'o3', 2);">경력</a></th>
                <th><a class="<?= $a4 ?>" id="o4" href="javascript:orderb('hire_types', 'o4', 3);">고용형태</a></th>
                <th><a class="<?= $a5 ?>" id="o5" href="javascript:orderb('regdate', 'o5', 4);">모집기간</a></th>
                <th><a class="<?= $a6 ?>" id="o6" href="javascript:orderb('hire_part', 'o6', 5);">부서</a></th>
                <th><a class="<?= $a7 ?>" id="o7" href="javascript:orderb('applicants_cnt', 'o7', 6);">지원</a></th>
                <th><a class="<?= $a8 ?>" id="o8" href="javascript:orderb('is_show', 'o8', 7);">전시</a></th>
                <th><a class="<?= $a9 ?>" id="o9" href="javascript:orderb('regdate', 'o9', 8);">등록일자</a></th>
            </tr>
            </thead>
            <tbody>
<?
$totalCnt = $jobsService->listsCount($conn, $wParam);
$result = $jobsService->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $rowCountPerPage);

if($totalCnt > 0) {
    $bPage = (($curPage - 1) * $rowCountPerPage) + 1;
    while($row = mysql_fetch_array($result)) {
        $bPage++;

        if($row['is_always'] == 'N') {
            $sDate = $row['start_date_y'].'.'.$row['start_date_m'].'.'.$row['start_date_d'];
            $eDate = $row['end_date_y'].'.'.$row['end_date_m'].'.'.$row['end_date_d'];
            $seDate = $sDate.' ~<br />'.$eDate;
        } else {
            $seDate = '상시';
        }
?>
            <tr>
                <td><?= $bPage - 1 ?></td>
                <td class="job_subject"><a href="javascript:goDetail('<?= $row['id'] ?>');"><?= $row['title'] ?></a></td>
                <td><?= CommonUtils::getCareerTypes($row['career_types']) ?></td>
                <td><?= CommonUtils::getHireTypes($row['hire_types']) ?></td>
                <td><?= $seDate ?></td>
                <td><?= CommonUtils::getHirePart($row['hire_part']) ?></td>
                <td><?= $row['applicants_cnt'] ?></td>
                <td><?= ($row['is_show'] == 'Y') ? 'YES' : 'NO'  ?></td>
                <td><?= $row['regdate'] ?></td>
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
                echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam=&orerBy=&curPage='.($curPage-1).'"><span>‹</span> 이전페이지</a>';
            } else {
                echo '<span>‹</span> 이전페이지';
            }

            $strPage = '';
            for($k = 1; $k <= $totalPage; $k++) {
                if($curPage == $k) {
                    $strPage = '<a href=><strong>'.$k.'</strong></a>';
                } else {
                    $strPage = '<a href="'.$_SERVER[PHP_SELF].'?wParam=&orderBy=&curPage='.$k.'">'.$k.'</a>';
                }

                // 1, 2, 3, 4, 5, 6 ...
                echo $strPage;
            }

            // Next block
            if($curPage < $totalPage) {
                echo '<a class="direction" href="'.$_SERVER[PHP_SELF].'?wParam=&orderBy=&curPage='.($curPage+1).'">다음페이지 <span>›</span></a>';
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
