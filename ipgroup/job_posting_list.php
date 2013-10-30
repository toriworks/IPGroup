<?php
/**
 * User: ${NAME} (toriworks@gmail.com)
 * Date: 13. 10. 30
 * Time: 오후 3:06
 */
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
        <a class="txt_button" href="job_posting_list.php">삭제</a>
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
        <tr>
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
            <td>8</td>
            <td class="job_subject"><a href="job_posting_view.php">[운영디자인] 면세점 디자이너를 모집합니다.</a></td>
            <td>무관</td>
            <td>정규직</td>
            <td>2013.01.01 ~<br />2013.03.30</td>
            <td>퍼블리싱팀</td>
            <td>15</td>
            <td>Y</td>
            <td>2013.01.05</td>
        </tr>
        <tr>
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
            <td class="check"><input type="checkbox" /></td>
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
