<?php
/**
 * User: IRequestsService (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오후 12:21
 */

interface IRequestsService {
    public function add( $conn, Requests $obj );
    public function update( $conn, Requests $obj );
    public function delete( $conn, Requests $obj );
    public function lists( $conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );

    public function detail($conn, Requests $obj);
    public function updateMemos($conn, Requests $obj);
}