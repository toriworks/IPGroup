<?php
/**
 * User: RequestsDaoImpl (toriworks@gmail.com)
 * Date: 13. 10. 25
 * Time: 오후 7:16
 */

class RequestsDaoImpl implements IRequests {

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
        // TODO: Implement update() method.
    }

    public function delete($conn, Requests $obj)
    {
        // TODO: Implement delete() method.
    }

    public function lists($conn, $wParam, $orderBy, $curPage, $pageMax)
    {
        // TODO: Implement lists() method.
    }

    public function listsCount($conn, $wParam)
    {
        // TODO: Implement listsCount() method.
    }
}