<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 30
 * Time: 오후 3:06
 */

require_once('./auth.php');

require_once('../classes/dao/ICommons.php');
require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/JobsDaoImpl.php');
require_once('../classes/service/JobsServiceImpl.php');
require_once('../classes/domain/Jobs.php');

require_once('../classes/utils/CommonUtils.php');

$conn = ConnectionFactory::create();
$jobsDaoImpl = new JobsDaoImpl();
$jobsServiceImpl = new JobsServiceImpl();
$jobsServiceImpl->setJobsDao($jobsDaoImpl);
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
        del_checked = function() {
            var checkVObj = document.getElementsByName("check_v");
            var checkCnt = checkVObj.length;
            var cCnt = 0;
            var sChecked = "";
            for(var k=0; k<checkCnt; k++) {
                if(checkVObj[k].checked == true) {
                    cCnt++;
                    sChecked = sChecked + checkVObj[k].value + "^";
                }
            }
            if(cCnt == 0) {
                alert(DEL_NO_CHECKED);
                return;
            }

            if(confirm("정말 삭제하시겠습니까?")) {
                location.href = "./jobs_delete_post.php?jids=" + sChecked;
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

<div class="section">
    <div class="form_search">
        <dl>
            <dt class="t">기간선택 : </dt>
            <dd>
                <input type="checkbox" />
                <select class="select" name="" id="">
                    <option value="" selected="selected">모집기간</option>
                    <option value="">등록일자</option>
                </select>
                <input id="date_from" class="i_text date" type="text" value="" />
                ~
                <input id="date_to" class="i_text date" type="text" value="" />
            </dd>
            <script type="text/javascript">
                init_from_to_date();
            </script>

            <dt>전시여부 : </dt>
            <dd>
                <input id="ck_a_1" type="checkbox" /><label for="ck_a_1">YES</label>
                <input id="ck_a_2" type="checkbox" /><label for="ck_a_2">NO</label>
            </dd>

            <dt>고용형태 : </dt>
            <dd>
                <input id="ck_b_1" type="checkbox" /><label for="ck_b_1">정규직</label>
                <input id="ck_b_2" type="checkbox" /><label for="ck_b_2">계약직</label>
            </dd>

            <dt>학력 : </dt>
            <dd>
                <input id="ck_c_1" type="checkbox" /><label for="ck_c_1">고졸</label>
                <input id="ck_c_2" type="checkbox" /><label for="ck_c_2">전문대졸</label>
                <input id="ck_c_3" type="checkbox" /><label for="ck_c_3">대졸</label>
                <input id="ck_c_4" type="checkbox" /><label for="ck_c_4">무관</label>
            </dd>

            <dt>경력 : </dt>
            <dd>
                <input id="ck_d_1" type="checkbox" /><label for="ck_d_1">신입</label>
                <input id="ck_d_2" type="checkbox" /><label for="ck_d_2">경력</label>
                <input id="ck_d_3" type="checkbox" /><label for="ck_d_3">무관</label>
            </dd>

            <dt>고용부서 : </dt>
            <dd>
                <input id="ck_e_1" type="checkbox" /><label for="ck_e_1">기획실</label>
                <input id="ck_e_2" type="checkbox" /><label for="ck_e_2">디자인실</label>
                <input id="ck_e_3" type="checkbox" /><label for="ck_e_3">퍼블리싱팀</label>
                <input id="ck_e_4" type="checkbox" /><label for="ck_e_4">경영지원팀</label>
            </dd>
        </dl>

        <div class="keyword_area">
            <input class="keyword" type="text" />
            <a class="txt_button" href="#">검색</a>
        </div>
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
        <a class="txt_button" href="javascript:del_checked();">삭제</a>
        <a class="txt_button" href="job_posting_write.php">신규등록</a>
    </div>
</div>
<!-- //상단 영역 -->

<!-- 데이터 테이블 -->
<div class="data_table">
    <table class="tbl" border="1" cellspacing="0">
        <colgroup>
            <col width="4%" />
            <col width="6%" />
            <col width="32%" />
            <col width="7%" />
            <col width="9%" />
            <col width="10%" />
            <col width="8%" />
            <col width="7%" />
            <col width="7%" />
            <col width="10%" />
        </colgroup>
        <thead>
        <tr>
            <th class="check">
                <input id="all_check" type="checkbox" />
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#all_check').bind('click',function(){
                            var cks = $(this).parents('table').find('> tbody td.check > input[type="checkbox"]');
                            if ($('#all_check').is(':checked')) {
                                cks.prop('checked',true);
                            } else {
                                cks.prop('checked',false);
                            }
                        });
                    });
                </script>
            </th>
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
<?
$rowCountPerPage = 7;
$wParam = '';
$orderBy = $_REQUEST['orderBy'];
$orderDir = $_REQUEST['orderDir'];
if($orderBy == '') {
    $orderBy = ' regdate DESC ';
}

$curPage = $_REQUEST['curPage'];
if($curPage == '') {
    $curPage = 1;
}

$totalCnt = $jobsServiceImpl->listsCount($conn, $wParam);
$result = $jobsServiceImpl->lists($conn, $wParam, $orderBy, $curPage, $rowCountPerPage);



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
            <td class="check"><input type="checkbox" id="check_v" name="check_v" value="<?= $row['id'] ?>" /></td>
            <td><?= $bPage - 1 ?></td>
            <td class="job_subject"><a href="job_posting_view.php"><?= $row['title'] ?></a></td>
            <td><?= CommonUtils::getCareerTypes($row['career_types']) ?></td>
            <td><?= CommonUtils::getHireTypes($row['hire_types']) ?></td>
            <td><?= $seDate ?>
            </td>
            <td><?= CommonUtils::getHirePart($row['hire_part']) ?></td>
            <td><?= $row['applicants_cnt'] ?></td>
            <td><?= $row['is_show'] ?></td>
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
