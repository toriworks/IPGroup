<?php
/**
 * User: RequestsDaoImpl (toriworks@gmail.com)
 * Date: 13. 10. 25
 * Time: 오후 7:16
 */

@define('class_path', '/home/host01/ipgroup');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IRequestsDao.php");

class RequestsDaoImpl implements IRequestsDao {

    public function add($conn, Requests $obj)
    {
        $resultOfQuery = 0;
        $sql = "INSERT INTO requests (id, company_name, contact_tel, contact_mobile, email, url, types";
        $sql .= ", manager_name, manager_id, descriptions, memos, regdate) VALUES ";
        $sql .= "('".$obj->getId()."', '".$obj->getCompanyName()."', '".$obj->getContactTel()."', '".$obj->getContactMobile()."'";
        $sql .= ", '".$obj->getEmail()."', '".$obj->getUrl()."', '".$obj->getTypes()."', '".$obj->getManagerName()."', '".$obj->getManagerId()."'";
        $sql .= ", '".$obj->getDescriptions()."', '".$obj->getMemos()."', now())";

        $resultOfQuery = mysql_query($sql, $conn) or die("RequestsDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn, Requests $obj)
    {
        $resultOfQuery = 0;
        $sql = "UPDATE requests SET company_name='".$obj->getCompanyName()."', contact_tel='".$obj->getContactTel()."' ";
        $sql .= ", contact_mobile='".$obj->getContactMobile()."', email='".$obj->getEmail()."', url='".$obj->getUrl."' ";
        $sql .= ", types=".$obj->getTypes().", manager_name='".$obj->getManagerName()."', manager_id='".$obj->getManagerId()."' ";
        $sql .= ", descriptions='".$obj->getDescriptions()."', memos='".$obj->getMemos()."' ";
        $sql .= " WHERE id='".$obj->getId()."' ";

        $resultOfQuery = mysql_query($sql, $conn) or die("RequestsDaoImpl update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete($conn, Requests $obj)
    {
        $resultOfQuery = 0;

        $sql = "DELETE FROM requests WHERE id='".$obj->getId()."'";
        $resultOfQuery = mysql_query($sql) or die("RequestsDaoImpl delete error : ".mysql_error());

        return $resultOfQuery;
    }

    public function lists($conn, $wParam, $orderBy, $curPage, $pageMax)
    {
        $sql = "SELECT id, company_name, contact_tel, contact_mobile, email, url, types";
        $sql .= ", manager_name, manager_id, descriptions, memos, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r ";
        $sql .= ", datediff(now(), regdate) as is_old ";
        $sql .= " FROM requests ";
        if(!empty($wParam)) {
            $sql .= " WHERE ".$wParam;
        }
        if(!empty($orderBy)) {
            $sql .= " ORDER BY ".$orderBy;
        }

        $sql = $sql." LIMIT ".(($curPage-1) * $pageMax)." , ".$pageMax;
        $result = mysql_query($sql) or die("RequestsDaoImpl lists error : ".mysql_error());

        return $result;
    }

    public function listsCount($conn, $wParam)
    {
        $sql = "SELECT COUNT(0) cnt FROM requests";
        if($wParam != "") {
            $sql .= " WHERE ".$wParam;
        }

        $result = mysql_query($sql) or die("RequestsDaoImpl listsCount error : ".mysql_error());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }

    public function detail($conn, Requests $obj)
    {
        $sql = "SELECT company_name, contact_tel, contact_mobile, email, url, types";
        $sql .= ", manager_name, manager_id, descriptions, memos, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r FROM requests ";
        $sql .= " WHERE id='".$obj->getId()."' ";

        $result = mysql_query($sql) or die("RequestsDaoImpl detail error : ".mysql_error());

        return $result;
    }

    public function updateMemos($conn, Requests $obj)
    {
        $memos = $obj->getMemos();
        $rid = $obj->getId();

        $resultOfQuery = 0;
        $sql = "UPDATE requests SET memos='".$memos."' WHERE id='".$rid."'";
        $resultOfQuery = mysql_query($sql) or die("RequestsDaoImpl updateMemos error : ".mysql_error());

        return $resultOfQuery;
    }
}