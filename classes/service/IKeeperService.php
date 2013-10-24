<?php
/**
 * User: IKeeperService (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 2:48
 */

interface IKeeperService {
    public function add( $conn, Keeper $obj );
    public function update( $conn, Keeper $obj );
    public function delete( $conn, Keeper $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );

    public function tryLogin( $conn, Keeper $obj );
    public function tryLogout(Keeper $obj);
}
?>