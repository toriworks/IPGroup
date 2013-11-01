<?php
/**
 * User: ACDaoImpl (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 4:53
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IACDao.php");
class ACDaoImpl implements IACDao {

    public function add($conn, ApplicantsCompany $obj)
    {
        $resultOfQuery = 0;

        $sql = "INSERT INTO applicants_company (jobs_id, applicants_id, id, company_name";
        $sql .= ", start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d";
        $sql .= ", position, descriptions, regdate, moddate, order ) VALUES ";
        $sql .= "('".$obj->getJobsId()."', '".$obj->getApplicantsId()."', '".$obj->getCompanyName()."'";
        $sql .= ", '".$obj->getStartDateY()."', '".$obj->getStartDateM()."', '".$obj->getStartDateD()."', '".$obj->getEndDateY()."', '".$obj->getEndDateM()."', '".$obj->getEndDateD()."'";
        $sql .= ", '".$obj->getPosition()."', '".$obj->getDescriptions()."', now(), now(), ".$obj->getOrder().")";

        $resultOfQuery = mysql_query($sql, $conn) or die("ACDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn, ApplicantsCompany $obj)
    {
    }

    public function delete($conn, ApplicantsCompany $obj)
    {
        $resultOfQuery = 0;

        $sql = "DELETE FROM applicants_company ";
        $sql .= " WHERE id='".$obj->getId()."' AND jobs_id='".$obj->getJobsId()."' AND applicants_id='".$obj->getApplicantsId()."'";
    }

    public function lists($conn, ApplicantsCompany $obj)
    {
        $sql = "SELECT jobs_id, applicants_id, id, company_name";
        $sql .= ", start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d";
        $sql .= ", position, descriptions, regdate, moddate, order FROM applicants_company ";
        $sql .= " WHERE id='".$obj->getId()."' AND jobs_id='".$obj->getJobsId()."' AND applicants_id='".$obj->getApplicantsId()."' ";
        $sql .= " ORDER BY order ASC";

        $result = mysql_query($sql, $conn) or die("KeeperDaoImpl lists error : ".mysql_error());
        return $result;
    }

    public function listsCount($conn, ApplicantsCompany $obj)
    {
    }
}