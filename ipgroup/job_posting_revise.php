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

require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');
require_once('../classes/domain/Keeper.php');

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
        clear_dates = function(a) {
            if(a == 'Y') {
                document.getElementById('date_from').value = "";
                document.getElementById('date_to').value = "";
            } else {
                init_from_to_date2();
            }
        }

        del_data = function() {
            if(confirm(CONFIRM_DELETE)) {
                location.href = "./jobs_delete_post.php?jids=<?= $jids ?>^";
            } else {
                return;
            }
        }

        enroll_form = function() {
            var job_form = document.forms.job_form;
            if(job_form.title.value == "") {
                alert("제목" + PLZ_INPUT);
                return;
            }

            // 고용형태
            var hire_types = (job_form.hire_types.options[job_form.hire_types.selectedIndex].value);
            if(hire_types == '') {
                alert("고용형태" + PLZ_SELECT);
                return;
            }

            var job_department = (job_form.job_department.options[job_form.job_department.selectedIndex].value);
            if(job_department == '') {
                alert("근무부서" + PLZ_SELECT);
                return;
            }

            var position = (job_form.position.options[job_form.position.selectedIndex].value);
            if(position == '') {
                alert("채용직급" + PLZ_SELECT);
                return;
            }

            var school_types = (job_form.school_types.options[job_form.school_types.selectedIndex].value);
            if(school_types == '') {
                alert("최종학력" + PLZ_SELECT);
                return;
            }

            var gender = (job_form.gender.options[job_form.gender.selectedIndex].value);
            if(gender == '') {
                alert("성별" + PLZ_SELECT);
                return;
            }

            // 전시여부
            for(var i=0; i<2; i++) {
                if(job_form.is_show_t[i].checked == true) {
                    job_form.is_show.value = job_form.is_show_t[i].value;
                }
            }

            // 기간, 상시여부
            for(var i=0; i<2; i++) {
                if(job_form.is_always_t[i].checked == true) {
                    job_form.is_always.value = job_form.is_always_t[i].value;
                }
            }

            // 경력사항
            for(var i=0; i<2; i++) {
                if(job_form.career_types_t[i].checked == true) {
                    job_form.career_types.value = job_form.career_types_t[i].value;
                }
            }

            // 경력사항
            for(var i=0; i<2; i++) {
                if(job_form.old_types_t[i].checked == true) {
                    job_form.old_types.value = job_form.old_types_t[i].value;
                }
            }

            job_form.action = "./job_posting_revise_post.php";
            job_form.submit();
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
        <? if(($keeper->getMenu1() & 1) > 0) { ?><li><a href="work_list.php">Work</a></li><? } ?>
        <? if(($keeper->getMenu2() & 1) > 0) { ?><li><a href="request_list.php">Request</a></li><? } ?>
        <? if(($keeper->getMenu3() & 1) > 0) { ?><li><a href="recruit_list.php">Recruit</a></li><? } ?>
        <? if(($keeper->getMenu4() & 1) > 0) { ?><li class="active"><a href="job_posting_list.php">Job Posting</a></li><? } ?>
        <? if(($keeper->getMenu5() & 1) > 0) { ?> <li><a href="company_introduction.php">Company Introduction</a></li><? } ?>
        <? if(($keeper->getMenu6() & 1) > 0) { ?><li><a href="member_list.php">Member</a></li><? } ?>
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
        <?  if(($keeper->getMenu4() & 32) > 0) {  ?><a class="txt_button" href="javascript:del_data();">삭제하기</a><? } ?>
    </div>
    <div class="right">
        <a class="txt_button" href="javascript:history.back();">취소</a>
        <a class="txt_button" href="javascript:enroll_form();">수정완료</a>
    </div>
</div>
<form name="job_form" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $jids ?>" />
<input type="hidden" name="is_show" value="<?= $row['is_show'] ?>" />
<input type="hidden" name="is_always" value="<?= $row['is_always'] ?>" />
<input type="hidden" name="old_types" value="<?= $row['old_types'] ?>" />
<input type="hidden" name="career_types" value="<?= $row['career_types'] ?>" />
<div class="section">
    <div class="form_table">
        <table class="tbl" border="1" cellspacing="0">
            <colgroup>
                <col width="15%" />
                <col width="85%" />
            </colgroup>
            <tbody>
            <tr>
                <th class="tit" scope="row">전시여부</th>
                <td class="val">
                    <div class="item">
                        <input id="r1_1" class="i_radio" value="Y" name="is_show_t" type="radio" <? if($row['is_show'] == 'Y') echo ' checked'; ?> /><label for="r1_1">YES</label>
                        <input id="r1_2" class="i_radio" value="N" name="is_show_t" type="radio" <? if($row['is_show'] == 'N') echo ' checked'; ?> /><label for="r1_2">NO</label>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section">
    <h3>모집안내 등록</h3>
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
                <th class="tit" scope="row"><label for="job_title">제목</label></th>
                <td class="val" colspan="3">
                    <div class="item">
                        <input id="job_title" name="title" class="i_text" type="text" value="<?= $row['title'] ?>" style="width:550px;" />
                    </div>
                </td>
            </tr>
<?
$sDate = ''; $eDate = '';
if($row['is_always'] == 'N') {
    $sDate = $row['start_date_y'].'.'.$row['start_date_m'].'.'.$row['start_date_d'];
    $eDate = $row['end_date_y'].'.'.$row['end_date_m'].'.'.$row['end_date_d'];
} else {
    $sDate = '';
    $eDate = '';
}
?>
            <tr>
                <th class="tit" scope="row">모집기간</th>
                <td class="val" colspan="3">
                    <div class="item">
                        <input id="r2_1" class="i_radio" value="N" type="radio" name="is_always_t" <? if($row['is_always'] == 'N') echo ' checked'; ?>  onclick="clear_dates('N');" /><label for="r2_1">기간</label>

                        <input id="date_from" name="start_date" class="i_text date" type="text" style="width:70px;" value="<?= $sDate ?>" />
                        ~
                        <input id="date_to" name="end_date" class="i_text date" type="text" style="width:70px;" value="<?= $eDate ?>" />
                        <script type="text/javascript">
                            //init_from_to_date2();
                        </script>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="r2_2" class="i_radio" value="Y" type="radio" name="is_always_t" <? if($row['is_always'] == 'Y') echo ' checked'; ?> onclick="clear_dates('Y');" /><label for="r2_2">상시</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_type">고용형태</label></th>
                <td class="val">
                    <div class="item">
                        <select id="job_type" name="hire_types" class="select">
                            <option value="">선택해주세요</option>
                            <option value="RG" <? if($row['hire_types'] == 'RG') echo ' selected'; ?>>정규직</option>
                            <option value="PT" <? if($row['hire_types'] == 'PT') echo ' selected'; ?>>계약직</option>
                            <option value="IT" <? if($row['hire_types'] == 'IT') echo ' selected'; ?>>인턴</option>
                            <option value="SD" <? if($row['hire_types'] == 'SD') echo ' selected'; ?>>파견</option>
                            <option value="AB" <? if($row['hire_types'] == 'AB') echo ' selected'; ?>>아르바이트</option>
                            <option value="NG" <? if($row['hire_types'] == 'NG') echo ' selected'; ?>>협의</option>
                        </select>
                    </div>
                </td>
                <th class="tit" scope="row"><label for="job_count">모집인원</label></th>
                <td class="val">
                    <div class="item">
                        <input id="job_count" class="i_text" type="text" name="how_many" value="<?= ($row['how_many'] == '') ? '0' : $row['how_many']; ?>" style="width:30px;" />
                        명
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_department">근무부서</label></th>
                <td class="val">
                    <div class="item">
                        <select name="hire_part" id="job_department" class="select">
                            <option value="">선택해주세요</option>
                            <option value="PL" <? if($row['hire_part'] == 'PL') echo ' selected'; ?>>기획실</option>
                            <option value="DN" <? if($row['hire_part'] == 'DN') echo ' selected'; ?>>디자인실</option>
                            <option value="PB" <? if($row['hire_part'] == 'PB') echo ' selected'; ?>>퍼블리싱팀</option>
                            <option value="MN" <? if($row['hire_part'] == 'MN') echo ' selected'; ?>>경영지원팀</option>
                        </select>
                    </div>
                </td>
                <th class="tit" scope="row"><label for="job_rank">채용직급</label></th>
                <td class="val">
                    <div class="item">
                        <select name="position" id="job_rank" class="select">
                            <option value="">선택해주세요</option>
                            <option value="CO" <? if($row['position'] == 'CO') echo ' selected'; ?>>임원</option>
                            <option value="TO" <? if($row['position'] == 'TO') echo ' selected'; ?>>실장</option>
                            <option value="TM" <? if($row['position'] == 'TM') echo ' selected'; ?>>팀장</option>
                            <option value="PK" <? if($row['position'] == 'PK') echo ' selected'; ?>>과장</option>
                            <option value="PD" <? if($row['position'] == 'PD') echo ' selected'; ?>>대리</option>
                            <option value="PJ" <? if($row['position'] == 'PJ') echo ' selected'; ?>>주임</option>
                            <option value="PS" <? if($row['position'] == 'PS') echo ' selected'; ?>>사원</option>
                            <option value="NG" <? if($row['position'] == 'NG') echo ' selected'; ?>>협의</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">경력사항</th>
                <td class="val">
                    <div class="item">
                        <input id="r3_1" class="i_radio" value="N" type="radio" name="career_types_t" <? if($row['career_types'] == 'N') echo ' checked'; ?> /><label for="r3_1">신입</label>
                        <input id="r3_2" class="i_radio" value="Y" type="radio" name="career_types_t" <? if($row['career_types'] == 'Y') echo ' checked'; ?> /><label for="r3_2">경력</label>
                        <input id="job_year" class="i_text" name="career_years" type="text" value="<?= $row['career_years'] ?>" style="width:30px;" />
                        년
                        <script type="text/javascript">
                            $('input[name="career_y"]').bind('change',function(){
                                if ($('#r3_2').prop('checked')) {
                                    $('#job_year').prop('disabled',false);
                                    $('#job_year').css('background','#fff');
                                } else {
                                    $('#job_year').prop('disabled',true);
                                    $('#job_year').css('background','#f4f4f4');
                                }
                            }).trigger('change');
                        </script>
                    </div>
                </td>
                <th class="tit" scope="row"><label for="job_lastedu">최종학력</label></th>
                <td class="val">
                    <div class="item">
                        <select name="school_types" id="job_lastedu" class="select">
                            <option value="">선택해주세요</option>
                            <option value="UV" <? if($row['school_types'] == 'UV') echo ' selected'; ?>>대졸</option>
                            <option value="CL" <? if($row['school_types'] == 'CL') echo ' selected'; ?>>전문대졸</option>
                            <option value="HS" <? if($row['school_types'] == 'HS') echo ' selected'; ?>>고졸</option>
                            <option value="NG" <? if($row['school_types'] == 'NG') echo ' selected'; ?>>무관</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_sex">성별</label></th>
                <td class="val">
                    <div class="item">
                        <select name="gender" id="job_sex" class="select">
                            <option value="">선택해주세요</option>
                            <option value="ML" <? if($row['gender'] == 'ML') echo ' selected'; ?>>남자</option>
                            <option value="FL" <? if($row['gender'] == 'FL') echo ' selected'; ?>>여자</option>
                            <option value="NG" <? if($row['gender'] == 'NG') echo ' selected'; ?>>무관</option>
                        </select>
                    </div>
                </td>
                <th class="tit" scope="row">나이</th>
                <td class="val">
                    <div class="item">
                        <input id="r4_1" class="i_radio" value="NO" type="radio" name="old_types_t" <? if($row['old_types'] == 'NO') echo ' checked'; ?> /><label for="r4_1">무관</label>
                        <input id="r4_2" class="i_radio" value="YS" type="radio" name="old_types_t" <? if($row['old_types'] != 'NO') echo ' checked'; ?> /><label for="r4_2">제한</label>
                        <input id="job_age" class="i_text" name="how_old" type="text" value="<?= $row['how_old'] ?>" style="width:100px;" />
                        <script type="text/javascript">
                            $('input[name="old_types_t"]').bind('change',function(){
                                if ($('#r4_2').prop('checked')) {
                                    $('#job_age').prop('disabled',false);
                                    $('#job_age').css('background','#fff');
                                } else {
                                    $('#job_age').prop('disabled',true);
                                    $('#job_age').css('background','#f4f4f4');
                                }
                            }).trigger('change');
                        </script>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_welfare">복리후생</label></th>
                <td class="val">
                    <div class="item">
                        <textarea id="job_welfare" class="i_text" name="descriptions" id="" cols="96" rows="10"><?= $row['descriptions'] ?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">담당자 정보</th>
                <td class="val" colspan="3">
                    <div class="item">
                        이름 : <input id="job_count" class="i_text" type="text" value="<?= $row['keeper_name'] ?>" name="keeper_name" style="width:100px;" />
                        연락처 : <input id="job_count" class="i_text" type="text" value="<?= $row['keeper_contacts'] ?>" name="keeper_contacts" style="width:100px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_contents">추가내용</label></th>
                <td class="val">
                    <div class="item">
                        <textarea id="job_contents" class="i_text" name="add_descriptions" cols="96" rows="10"><?= $row['add_descriptions'] ?></textarea>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</form>

<!-- //본문 영역 -->
</div>
</div>

</div>

</body>
</html>
