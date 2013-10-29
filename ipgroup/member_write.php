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
    <script type="text/javascript" src="./js/login.js"></script>
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
            <li><a href="job_posting_list.php">Job Posting</a></li>
            <li><a href="company_introduction.php">Company Introduction</a></li>
            <li class="active"><a href="member_list.php">Member</a></li>
        </ul>
    </div>

    <div id="admin_contents">
        <div class="page_top">
            <h2>Member</h2>
        </div>
        <div class="container">
            <!-- 본문 영역 -->

            <div class="section">
                <!-- 상단 영역 -->
                <div class="area_top">
                    <div class="right">
                        <a class="txt_button" href="member_list.php">취소</a>
                        <a class="txt_button" href="member_view.php">생성하기</a>
                    </div>
                </div>
                <!-- //상단 영역 -->

                <!-- 멤버 테이블 -->
                <div class="member_table">
                    <table class="tbl" border="1" cellspacing="0">
                        <colgroup>
                            <col width="22%" />
                            <col width="13%" />
                            <col width="13%" />
                            <col width="13%" />
                            <col width="13%" />
                            <col width="13%" />
                            <col width="13%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <th scope="row" class="b">접속 ID</th>
                            <td colspan="6">
                                <div class="item">
                                    <input class="i_text" type="text" value="" style="width:200px;" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" class="b" rowspan="2">권한정보</th>
                            <td colspan="6">
                                <div class="item">
                                    이름 : <input class="i_text" type="text" value="" style="width:100px;" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="item">
                                    권한 :
                                    <input id="r_setting_1" class="i_radio" type="radio" name="mr" value="" checked="checked" /><label for="r_setting_1">기본 세팅</label>
                                    <select class="i_select" name="" id="permission_setting">
                                        <option value="">선택해주세요.</option>
                                        <option value="0">운영자</option>
                                        <option value="1">관리자</option>
                                    </select>

                                    <input id="r_setting_2" class="i_radio" type="radio" name="mr" value="" /><label for="r_setting_2">사용자 세팅</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" rowspan="2">항목</th>
                            <th scope="col" colspan="6" class="c">권한</th>
                        </tr>
                        <tr>
                            <th scope="col" class="c">게시판</th>
                            <th scope="col" class="c">리스트</th>
                            <th scope="col" class="c">내용보기</th>
                            <th scope="col" class="c">신규등록</th>
                            <th scope="col" class="c">수정</th>
                            <th scope="col" class="c">삭제</th>
                        </tr>
                        <tr>
                            <th scope="row">Work</th>
                            <td class="ck"><input id="r_work_0" type="checkbox" /></td>
                            <td class="ck"><input id="r_work_1" type="checkbox" /></td>
                            <td class="ck"><input id="r_work_2" type="checkbox" /></td>
                            <td class="ck"><input id="r_work_3" type="checkbox" /></td>
                            <td class="ck"><input id="r_work_4" type="checkbox" /></td>
                            <td class="ck"><input id="r_work_5" type="checkbox" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Request</th>
                            <td class="ck"><input id="r_request_0" type="checkbox" /></td>
                            <td class="ck"><input id="r_request_1" type="checkbox" /></td>
                            <td class="ck"><input id="r_request_2" type="checkbox" /></td>
                            <td class="ck"><input id="r_request_3" type="checkbox" /></td>
                            <td class="ck"><input id="r_request_4" type="checkbox" /></td>
                            <td class="ck"><input id="r_request_5" type="checkbox" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Recruit</th>
                            <td class="ck"><input id="r_recruit_0" type="checkbox" /></td>
                            <td class="ck"><input id="r_recruit_1" type="checkbox" /></td>
                            <td class="ck"><input id="r_recruit_2" type="checkbox" /></td>
                            <td class="ck"><input id="r_recruit_3" type="checkbox" /></td>
                            <td class="ck"><input id="r_recruit_4" type="checkbox" /></td>
                            <td class="ck"><input id="r_recruit_5" type="checkbox" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Job Posting</th>
                            <td class="ck"><input id="r_jobposting_0" type="checkbox" /></td>
                            <td class="ck"><input id="r_jobposting_1" type="checkbox" /></td>
                            <td class="ck"><input id="r_jobposting_2" type="checkbox" /></td>
                            <td class="ck"><input id="r_jobposting_3" type="checkbox" /></td>
                            <td class="ck"><input id="r_jobposting_4" type="checkbox" /></td>
                            <td class="ck"><input id="r_jobposting_5" type="checkbox" /></td>
                        </tr><tr>
                            <th scope="row">Company Introduction</th>
                            <td class="ck"><input id="r_company_0" type="checkbox" /></td>
                            <td class="ck"><input id="r_company_1" type="checkbox" /></td>
                            <td class="ck"><input id="r_company_2" type="checkbox" /></td>
                            <td class="ck"><input id="r_company_3" type="checkbox" /></td>
                            <td class="ck"></td>
                            <td class="ck"></td>
                        </tr>
                        <tr>
                            <th scope="row">Member</th>
                            <td class="ck"><input id="r_member_0" type="checkbox" /></td>
                            <td class="ck"><input id="r_member_1" type="checkbox" /></td>
                            <td class="ck"><input id="r_member_2" type="checkbox" /></td>
                            <td class="ck"><input id="r_member_3" type="checkbox" /></td>
                            <td class="ck"><input id="r_member_4" type="checkbox" /></td>
                            <td class="ck"><input id="r_member_5" type="checkbox" /></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <script type="text/javascript">
                    init_permission_setting();
                </script>
                <!-- //데이터 테이블 -->

            </div>

            <!-- //본문 영역 -->
        </div>
    </div>

</div>

</body>
</html>
