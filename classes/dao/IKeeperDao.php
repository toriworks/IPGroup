<?php
/**
 * User: IKeeperDao (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 1:38
 */

interface IKeeperDao {
    public function add( $conn, Keeper $obj );
    public function update( $conn, Keeper $obj );
    public function delete( $conn, Keeper $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );
    public function detail( $conn, Keeper $obj );

    // 로그인 수 증가
    public function addLoginCnt( $conn, Keeper $obj );
}