<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 26
 * Time: 오후 2:07
 */

interface IWorkDao {
    public function add( $conn, Work $obj );
    public function update( $conn, Work $obj );
    public function delete( $conn, Work $obj );
    public function lists( $conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );
    public function detail( $conn, Work $obj );

    public function lists4Work($conn, $year, $category);
}