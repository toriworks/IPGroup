<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 10. 27
 * Time: 오전 10:42
 * To change this template use File | Settings | File Templates.
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/domain/Work.php");

interface IWorkService {
    public function add( $conn, Work $obj );
    public function update( $conn, Work $obj );
    public function delete( $conn, Work $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );
    public function detail( $conn, Work $obj );

    public function lists4Work($conn, $year, $category);
}