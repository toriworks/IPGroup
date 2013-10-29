<?php
/**
 * User: IRequests (toriworks@gmail.com)
 * Date: 13. 10. 25
 * Time: 오후 7:11
 */

interface IRequestsDao {
    public function add( $conn, Requests $obj );
    public function update( $conn, Requests $obj );
    public function delete( $conn, Requests $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );

    public function detail($conn, Requests $obj);
    public function updateMemos($conn, Requests $obj);
}