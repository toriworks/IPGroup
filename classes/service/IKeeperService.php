<?php
/**
 * User: IKeeperService (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 2:48
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/domain/Keeper.php");

interface IKeeperService {
    public function add( $conn, Keeper $obj );
    public function update( $conn, Keeper $obj );
    public function delete( $conn, Keeper $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );
    public function detail( $conn, Keeper $obj );

    public function tryLogin( $conn,  Keeper $obj );
    public function tryLogout(Keeper $obj);
}
?>