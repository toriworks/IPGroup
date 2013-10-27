<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

if($_COOKIE["keeper_id"] == "") {
    // 강제로 로그인 페이지로 이동하게 함
    header("Location: /ipgroup/login.php");
    exit;
}
?>