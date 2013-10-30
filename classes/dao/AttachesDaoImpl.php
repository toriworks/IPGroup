<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 10. 27
 * Time: 오후 1:53
 * To change this template use File | Settings | File Templates.
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IAttachesDao.php");
class AttachesDaoImpl implements IAttachesDao {

    public function add($conn, Attaches $obj)
    {
        $resultOfQuery = 0;

        // 기존에 있는 파일을 업데이트 하는지 여부 체크
        $sql = "DELETE FROM attaches WHERE ref_id='".$obj->getRefId()."' AND stypes='".$obj->getStypes()."'";
        mysql_query($sql);

        $sql = "INSERT INTO attaches (ref_id, stypes, mtypes, original_filename, transfer_filename, regdate) VALUES ";
        $sql .= "('".$obj->getRefId()."', '".$obj->getStypes()."','".$obj->getMtypes()."', '".$obj->getOriginalFilename()."', '".$obj->getTransferFilename()."', now())";

        $resultOfQuery = mysql_query($sql) or die("AttachesDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn, Attaches $obj)
    {
        // TODO: Implement update() method.
    }

    public function delete($conn, Attaches $obj)
    {
        $resultOfQuery = 0;
        $id = $obj->getRefId();
        $stypes = $obj->getStypes();
        $mtypes = $obj->getMtypes();

        $sql = "DELETE FROM attaches ";
        $sql .= " WHERE ref_id='".$id."' AND stypes='".$stypes."' AND mtypes='".$mtypes."'";

        $resultOfQuery = mysql_query($sql) or die("AttachesDaoImpl delete error : ".mysql_error());
        return $resultOfQuery;
    }

    public function lists($conn, $id)
    {
        $sql = "SELECT stypes, mtypes, original_filename, transfer_filename, regdate FROM attaches ";
        $sql .= " WHERE ref_id='".$id."'";

        $result = mysql_query($sql) or die("AttachesDaoImpl lists error : ".mysql_error());
        return $result;
    }

    public function listsCount($conn, $wParam)
    {
        // TODO: Implement listsCount() method.
    }
}