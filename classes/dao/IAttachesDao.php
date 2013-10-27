<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 10. 27
 * Time: 오후 1:52
 * To change this template use File | Settings | File Templates.
 */

interface IAttachesDao {
    public function add( $conn, Attaches $obj );
    public function update( $conn, Attaches $obj );
    public function delete( $conn, Attaches $obj );
    public function lists($conn, $id);
    public function listsCount( $conn, $wParam );
}