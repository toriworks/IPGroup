<?php
// get parameter
$redirect_page = $_REQUEST['page'];
if($redirect_page == 'job_posting_view.php') {
    $redirect_page = $redirect_page.'?jids='.$_REQUEST['jids'];
}
?>
<form name="form" id="form" method="post" action="<?= $redirect_page ?>">
</form>
<script type="text/javascript">
    var form = document.forms[0];
    form.submit();
</script>