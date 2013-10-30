<?php
/**
 * Created by IntelliJ IDEA.
 * User: toriworks
 * Date: 2013. 10. 30.
 * Time: 오전 12:45
 * To change this template use File | Settings | File Templates.
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
        <span>홍길동</span><br />
        <a href="login.html">[로그아웃]</a>
    </p>

    <ul class="menu">
        <li><a href="work_list.html">Work</a></li>
        <li><a href="request_list.html">Request</a></li>
        <li class="active"><a href="recruit_list.html">Recruit</a></li>
        <li><a href="job_posting_list.html">Job Posting</a></li>
        <li><a href="company_introduction.html">Company Introduction</a></li>
        <li><a href="member_list.html">Member</a></li>
    </ul>
</div>

<div id="admin_contents">
<div class="page_top">
    <h2>Recruit</h2>
</div>
<div class="container">
<!-- 본문 영역 -->

<div class="section">
    <div class="form_search">
        <dl>
            <dt class="t">기간선택 : </dt>
            <dd>
                <input type="checkbox" />
                지원일자
                <input id="date_from" class="i_text date" type="text" />
                ~
                <input id="date_to" class="i_text date" type="text" />
            </dd>
            <script type="text/javascript">
                $(document).ready(function() { init_from_to_date(); });
            </script>

            <dt>경력 : </dt>
            <dd>
                <input id="ck_a_1" type="checkbox" /><label for="ck_a_1">신입</label>
                <input id="ck_a_2" type="checkbox" /><label for="ck_a_2">경력</label>
                <input id="ck_a_3" type="checkbox" /><label for="ck_a_3">무관</label>
            </dd>

            <dt>지원분야 : </dt>
            <dd>
                <input id="ck_b_1" type="checkbox" /><label for="ck_b_1">기획실</label>
                <input id="ck_b_2" type="checkbox" /><label for="ck_b_2">디자인실</label>
                <input id="ck_b_3" type="checkbox" /><label for="ck_b_3">퍼블리싱팀</label>
                <input id="ck_b_4" type="checkbox" /><label for="ck_b_4">경영지원팀</label>
            </dd>

            <dt>학력 : </dt>
            <dd>
                <input id="ck_c_1" type="checkbox" /><label for="ck_c_1">고졸</label>
                <input id="ck_c_2" type="checkbox" /><label for="ck_c_2">전문대졸</label>
                <input id="ck_c_3" type="checkbox" /><label for="ck_c_3">대졸</label>
                <input id="ck_c_4" type="checkbox" /><label for="ck_c_4">무관</label>
            </dd>

            <dt>상태 : </dt>
            <dd>
                <input id="ck_d_1" type="checkbox" /><label for="ck_d_1">접수</label>
                <input id="ck_d_2" type="checkbox" /><label for="ck_d_2">심사</label>
                <input id="ck_d_3" type="checkbox" /><label for="ck_d_3">합격</label>
                <input id="ck_d_4" type="checkbox" /><label for="ck_d_4">불합격</label>
            </dd>
        </dl>

        <div class="keyword_area">
            <select class="select" name="" id="">
                <option value="">이름</option>
                <option value="">연락처</option>
                <option value="">E-Mail</option>
            </select>
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
        <a class="txt_button" href="recruit_list.html">삭제</a>
    </div>
</div>
<!-- //상단 영역 -->

<!-- 데이터 테이블 -->
<div class="data_table">
<table class="tbl" border="1" cellspacing="0">
<colgroup>
    <col width="4%" />
    <col width="7%" />
    <col width="7%" />
    <col width="10%" />
    <col width="14%" />
    <col width="14%" />
    <col width="10%" />
    <col width="10%" />
    <col width="8%" />
    <col width="8%" />
    <col width="8%" />
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
    <th><span class="hide">아이콘</span></th>
    <th><a class="desc" href="#">이름</a></th>
    <th><a class="desc" href="#">연락처</a></th>
    <th><a class="desc" href="#">E-Mail</a></th>
    <th><a class="desc" href="#">지원분야</a></th>
    <th><a class="desc" href="#">경력</a></th>
    <th><a class="desc" href="#">학력</a></th>
    <th><a class="desc" href="#">지원일</a></th>
    <th><a class="desc" href="#">상태</a></th>
</tr>
</thead>
<tbody>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>10</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="ready">접수</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>9</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="ready">접수</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>8</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>디자인실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="ready">접수</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>7</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>경영지원팀</td>
    <td>경력3년</td>
    <td>전문대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="pass">합격</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>6</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>퍼블리싱팀</td>
    <td>신입</td>
    <td>고졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="fail">불합격</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>5</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>기타</td>
    <td>2012.12.25</td>
    <td class="status"><span class="fail">불합격</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>4</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="fail">불합격</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>3</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="pass">합격</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>2</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="pass">합격</span></td>
</tr>
<tr>
    <td class="check"><input type="checkbox" /></td>
    <td>1</td>
    <td>
        <img src="./images/save.png" alt="첨부파일" title="첨부파일" />
        <img src="./images/new-message.png" alt="신규항목" title="신규항목" />
    </td>
    <td class="name"><a href="recruit_view.html">홍길동</a></td>
    <td>070-8730-8080<br />/ 010-1216-8888</td>
    <td>abcduser@ipgroup.co.kr</td>
    <td>기획실</td>
    <td>신입</td>
    <td>대졸</td>
    <td>2012.12.25</td>
    <td class="status"><span class="pass">합격</span></td>
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
