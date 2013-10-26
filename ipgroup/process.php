<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

header('Content-Type: application/json');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/KeeperDaoImpl.php');
require_once('../classes/service/KeeperServiceImpl.php');

// get parameter from previous page
$call_type = $_REQUEST['call_type'];
if ($call_type == 'login') {

    $keeper_id = $_REQUEST['keeper_id'];

    // process login
    $conn = ConnectionFactory::create();

    $keeperDaoImpl = new KeeperDaoImpl();

    $keeperServiceImpl = new KeeperServiceImpl();
    $keeperServiceImpl->setKeeperDao($keeperDaoImpl);

    $wParam = " id='".$keeper_id ."'";
    $countOfKeeper = $keeperServiceImpl->listsCount($conn, $wParam);

    if ($conn) {
        try {
            mysql_close($conn);
        } catch (Exception $e) {
            printf("Error %s", $e->getMessage());
        }
    }

    $ret = "{\"ipg\": {\"call_type\": \"".$call_type."\",\"result\": \"".$countOfKeeper."\"}}";
    echo $ret;
}
?>