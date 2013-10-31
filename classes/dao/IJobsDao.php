<?php
/**
 * User: IJobsDao (toriworks@gmail.com)
 * Date: 13. 10. 25
 * Time: 오후 6:28
 */

interface IJobsDao {
    public function add( $conn, Jobs $obj );
    public function update( $conn, Jobs $obj );
    public function delete( $conn, Jobs $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );

    public function detail($conn, Jobs $obj);
}