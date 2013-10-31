<?php
/**
 * User: IJobsService (toriworks@gmail.com)
 * Date: 13. 10. 30
 * Time: 오후 8:34
 */

interface IJobsService {
    public function add( $conn, Jobs $obj );
    public function update( $conn, Jobs $obj );
    public function delete( $conn, Jobs $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );

    public function detail($conn, Jobs $obj);
}