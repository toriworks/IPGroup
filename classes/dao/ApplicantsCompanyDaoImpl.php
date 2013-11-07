<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 11. 7
 * Time: 오후 9:16
 * To change this template use File | Settings | File Templates.
 */

@define('class_path','/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IApplicantsCompanyDao.php");
class ApplicantsCompanyDaoImpl implements IApplicantsCompanyDao {

    public function add($conn, ApplicantsCompany $obj)
    {
        $resultOfQuery = 0;
        $sql = "INSERT INTO applicants_company (jobs_id, applicants_id, id, company_name, start_date, end_date, position, descriptions, regdate, moddate, orders) VALUES ";
        $sql .= "('".$obj->getJobsId()."', '".$obj->getApplicantsId()."', '".$obj->getId()."', '".$obj->getCompanyName()."', '".$obj->getStartDate()."', '".$obj->getEndDate()."' ";
        $sql .= ", '".$obj->getPosition()."', '".$obj->getDescriptions()."', now(), now(), ".$obj->getOrder().")";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsCompanyDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn, ApplicantsCompany $obj)
    {
        $resultOfQuery = 0;
        $sql = "UPDATE applicants_company SET company_name='".$obj->getCompanyName()."', start_date='".$obj->getStartDate()."', end_date='".$obj->getEndDate()."'";
        $sql .= ", position='".$obj->getPosition()."', descriptions='".$obj->getDescriptions()."', moddate=now(), orders=".$obj->getOrder();
        $sql .= " WHERE id='".$obj->getId()."' ";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsCompanyDaoImpl update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete($conn, ApplicantsCompany $obj)
    {
        $resultOfQuery = 0;
        $sql = "DELETE FROM applicants_company WHERE ";
        if($obj->getJobsId() != '') {
            // 모집공고 자체가 삭제된 경우
            $sql .= " jobs_id='".$obj->getJobsId()."'";
        }

        if($obj->getApplicantsId() != '') {
            // 지원자 정보가 삭제된 경우
            $sql .= " applicants_id='".$obj->getApplicantsId()."'";
        }

        if($obj->getId() != '') {
            // 단순한 행 삭제된 경우
            $sql .= " id='".$obj->getId()."'";
        }

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsCompanyDaoImpl delete error : ".mysql_error());
        return $resultOfQuery;
    }

    public function lists($conn, $wParam, $ordersBy, $curPage, $pageMax)
    {
        $sql = "SELECT jobs_id, applicants_id, id, company_name, start_date, end_date, position, descriptions, regdate, moddate, orders FROM applicants_company ";

        if(!empty($wParam)) {
            $sql .= " WHERE ".$wParam;
        }
        if(!empty($ordersBy)) {
            $sql .= " ORDER BY ".$ordersBy;
        }

        $sql = $sql." LIMIT ".(($curPage-1) * $pageMax).",".$pageMax;
        $result = mysql_query($sql) or die("ApplicantsCompanyDaoImpl lists error : ".mysql_error());

        return $result;
    }

    public function listsCount($conn, $wParam)
    {
        $sql = "SELECT COUNT(0) cnt FROM applicants_company ";
        if($wParam != "") {
            $sql .= " WHERE ".$wParam;
        }

        $result = mysql_query($sql) or die("ApplicantsCompanyDaoImpl listsCount error : ".mysql_error());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }
}