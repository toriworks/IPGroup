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

            job_form.action = "./job_posting_write_post.php";
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
        <a class="txt_button" href="javascript:history.back();">취소</a>
        <a class="txt_button" href="job_posting_view.php">수정완료</a>
    </div>
</div>
<form name="job_form" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="is_show" value="" />
<input type="hidden" name="is_always" value="" />
<input type="hidden" name="old_types" value="" />
<input type="hidden" name="career_types" value="" />
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
                        <input id="r1_1" class="i_radio" value="" type="radio" checked="checked" /><label for="r1_1">YES</label>
                        <input id="r1_2" class="i_radio" value="" type="radio" /><label for="r1_2">NO</label>
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
                        <input id="job_title" class="i_text" type="text" value="[운영디자인] 면세점 디자이너를 모집합니다." style="width:550px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">모집기간</th>
                <td class="val" colspan="3">
                    <div class="item">
                        <input id="r2_1" class="i_radio" value="" type="radio" name="date" checked="checked" /><label for="r2_1">기간</label>

                        <input id="date_from" class="i_text date" type="text" style="width:70px;" value="2013.11.11" />
                        ~
                        <input id="date_to" class="i_text date" type="text" style="width:70px;" value="2013.11.20" />
                        <script type="text/javascript">
                            init_from_to_date2();
                        </script>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="r2_2" class="i_radio" value="" type="radio" name="date" /><label for="r2_2">상시</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_type">고용형태</label></th>
                <td class="val">
                    <div class="item">
                        <select name="" id="job_type" class="select">
                            <option value="">선택해주세요</option>
                            <option value="" selected="selected">정규직</option>
                            <option value="">계약직</option>
                            <option value="">인턴</option>
                            <option value="">파견</option>
                            <option value="">아르바이트</option>
                            <option value="">협의</option>
                        </select>
                    </div>
                </td>
                <th class="tit" scope="row"><label for="job_count">모집인원</label></th>
                <td class="val">
                    <div class="item">
                        <input id="job_count" class="i_text" type="text" value="2" style="width:30px;" />
                        명
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_department">근무부서</label></th>
                <td class="val">
                    <div class="item">
                        <select name="" id="job_department" class="select">
                            <option value="">선택해주세요</option>
                            <option value="">기획실</option>
                            <option value="" selected="selected">디자인실</option>
                            <option value="">퍼블리싱팀</option>
                            <option value="">경영지원팀</option>
                        </select>
                    </div>
                </td>
                <th class="tit" scope="row"><label for="job_rank">채용직급</label></th>
                <td class="val">
                    <div class="item">
                        <select name="" id="job_rank" class="select">
                            <option value="">선택해주세요</option>
                            <option value="">임원</option>
                            <option value="">실장</option>
                            <option value="">팀장</option>
                            <option value="" selected="selected">과장</option>
                            <option value="">대리</option>
                            <option value="">주임</option>
                            <option value="">사원</option>
                            <option value="">협의</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">경력사항</th>
                <td class="val">
                    <div class="item">
                        <input id="r3_1" class="i_radio" value="" type="radio" name="career_y" /><label for="r3_1">신입</label>
                        <input id="r3_2" class="i_radio" value="" type="radio" name="career_y" checked="checked" /><label for="r3_2">경력</label>
                        <input id="job_year" class="i_text" type="text" value="7" style="width:30px;" />
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
                        <select name="" id="job_lastedu" class="select">
                            <option value="">선택해주세요</option>
                            <option value="" selected="selected">대졸</option>
                            <option value="">전문대졸</option>
                            <option value="">고졸</option>
                            <option value="">무관</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_sex">성별</label></th>
                <td class="val">
                    <div class="item">
                        <select name="" id="job_sex" class="select">
                            <option value="">선택해주세요</option>
                            <option value="">남자</option>
                            <option value="">여자</option>
                            <option value="" selected="selected">무관</option>
                        </select>
                    </div>
                </td>
                <th class="tit" scope="row">나이</th>
                <td class="val">
                    <div class="item">
                        <input id="r4_1" class="i_radio" value="" type="radio" name="age_y" /><label for="r4_1">무관</label>
                        <input id="r4_2" class="i_radio" value="" type="radio" name="age_y" checked="checked" /><label for="r4_2">제한</label>
                        <input id="job_age" class="i_text" type="text" value="35세 이상" style="width:100px;" />
                        <script type="text/javascript">
                            $('input[name="age_y"]').bind('change',function(){
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
                        <textarea id="job_welfare" class="i_text" name="" id="" cols="96" rows="10"></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row">담당자 정보</th>
                <td class="val" colspan="3">
                    <div class="item">
                        이름 : <input id="job_count" class="i_text" type="text" value="홍길동 팀장" style="width:100px;" />
                        연락처 : <input id="job_count" class="i_text" type="text" value="070-8730-0000" style="width:100px;" />
                    </div>
                </td>
            </tr>
            <tr>
                <th class="tit" scope="row"><label for="job_contents">추가내용</label></th>
                <td class="val">
                    <div class="item">
                        <textarea id="job_contents" class="i_text" name="" id="" cols="96" rows="10"></textarea>
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
