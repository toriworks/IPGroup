<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#keeper_id').focus();
            $("#keeper_id ").bind("keydown", function(e) {
                if (e.keyCode == 13) { // enter key
                    try_login();
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript" src="./js/message.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
</head>
<body>

<div id="admin_login">

    <div class="title">
        <h1>IPGROUP 관리자 페이지</h1>
    </div>

    <fieldset>
        <legend>관리자 로그인 폼</legend>

        <div class="form">
            <form name="login_form" action="" method="post">
            <label for="admin_pw">접속ID :</label>
            <input id="keeper_id" class="text" type="password" name="keeper_id" />
            </form>
        </div>

        <div class="button">
            <a href="javascript:try_login();"><img class="btn_login" src="./images/btn_login.png" alt="로그인" /></a>
        </div>
    </fieldset>

</div>

</body>
</html>
