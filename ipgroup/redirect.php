<?php
// get parameter
$redirect_page = $_REQUEST['page'];
?>
<form name="form" id="form" method="post" action="<?= $redirect_page ?>">
</form>
<script type="text/javascript">
    var form = document.forms[0];
    form.submit();
</script>