<?php
/**
 * User: ApplicantsDaoImpl (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 5:30
 */

@define('class_path','/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IApplicantsDao.php");
class ApplicantsDaoImpl implements IApplicantsDao {

    public function add($conn,Applicants $obj)
    {
        $resultOfQuery = 0;
        $sql = "INSERT INTO applicants (jobs_id,id,kor_name,mobile_1,mobile_2,mobile_3,email,career_types,career_years,birth_year,tel_1,tel_2,tel_3,school_type,school_name,school_sub";
        $sql .= ",wish_pay,regdate,status,memos,hire_date,hire_part,hire_task,jobs_hire_part) VALUES ";
        $sql .= "('".$obj->getJobsId()."','".$obj->getId()."','".$obj->getKorName()."','".$obj->getMobile1()."','".$obj->getMobile2()."','".$obj->getMobile3()."'";
        $sql .= ",'".$obj->getEmail()."','".$obj->getCareerTypes()."','".$obj->getCareerYears()."','".$obj->getBirthYear()."'";
        $sql .= ",'".$obj->getTel1()."','".$obj->getTel2()."','".$obj->getTel3()."','".$obj->getSchoolType()."','".$obj->getSchoolName()."','".$obj->getSchoolSub()."'";
        $sql .= ",'".$obj->getWishPay()."',now(),'A','','','','','".$obj->getJobsHirePart()."')";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn,Applicants $obj)
    {
        $resultOfQuery = 0;
        $sql = "UPDATE applicants SET kor_name='".$obj->getKorName()."',mobile_1='".$obj->getMobile1()."',mobile_2='".$obj->getMobile2()."',mobile_3='".$obj->getMobile3()."'";
        $sql .= ",email='".$obj->getEmail()."',career_types='".$obj->getCareerTypes()."',career_years='".$obj->getCareerYears()."',birth_year='".$obj->getBirthYear()."'";
        $sql .= ",tel_1='".$obj->getTel1()."',tel_2='".$obj->getTel2()."',tel_3='".$obj->getTel3()."'";
        $sql .= ",school_type='".$obj->getSchoolType()."',school_name='".$obj->getSchoolName()."',school_sub='".$obj->getSchoolSub()."'";
        $sql .= ",wish_pay='".$obj->getWishPay()."',now() )";
        $sql .= " WHERE jobs_id='".$obj->getJobsId()."' AND id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsDaoImpl update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update_keeper($conn,Applicants $obj)
    {
        $resultOfQuery = 0;
        $sql = "UPDATE applicants SET status='".$obj->getStatus()."',memos='".$obj->getMemos()."',hire_date='".$obj->getHireDate()."',hire_part='".$obj->getHirePart()."',hire_task='".$obj->getHireTask()."'";
        $sql .= ",keeper_name='".$obj->getKeeperName()."',keeper_contact='".$obj->getKeeperContact()."' ";
        $sql .= " WHERE id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsDaoImpl update_keeper error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update_jobs_hire_part($conn,Applicants $obj) {
        $resultOfQuery = 0;
        $sql = "UPDATE applicants SET jobs_hire_part='".$obj->getJobsHirePart()."' ";
        $sql .= " WHERE jobs_id='".$obj->getJobsId()."'";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsDaoImpl update_jobs_hire_part error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete($conn,Applicants $obj)
    {
        $resultOfQuery = 0;
        $sql = "DELETE FROM applicants WHERE id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql,$conn) or die("ApplicantsDaoImpl delete error : ".mysql_error());
        return $resultOfQuery;
    }

    public function lists($conn,$wParam,$orderBy, $orderDir, $curPage,$pageMax)
    {
        $sql = "SELECT a.jobs_id,a.id,a.kor_name,a.mobile_1,a.mobile_2,a.mobile_3,a.email,a.career_types,a.career_years,a.birth_year,a.tel_1,a.tel_2,a.tel_3,a.school_type,a.school_name,a.school_sub";
        $sql .= ",a.wish_pay,date_format(a.regdate,'%Y.%m.%d') regdate,a.regdate as regdate_r,datediff(now(),a.regdate) as is_old,a.status,a.memos,a.hire_date,a.hire_part,a.hire_task ";
        $sql .= ",b.original_filename ";
        $sql .= " FROM applicants a LEFT OUTER JOIN attaches b ON a.id=b.ref_id ";

        if(!empty($wParam)) {
            $sql .= " WHERE 1=1 ".$wParam;
        }
        if(!empty($orderBy)) {
            if(empty($orderDir)) {
                $orderDir = " DESC ";
            }
            $sql .= " ORDER BY ".$orderBy." ".$orderDir;
        }

        $sql = $sql." LIMIT ".(($curPage-1) * $pageMax).",".$pageMax;
        $result = mysql_query($sql) or die("ApplicantsDaoImpl lists error : ".mysql_error());

        return $result;
    }

    public function listsCount($conn,$wParam)
    {
        $sql = "SELECT COUNT(0) cnt FROM applicants ";
        if($wParam != "") {
            $sql .= " WHERE1=1 ".$wParam;
        }

        $result = mysql_query($sql) or die("ApplicantsDaoImpl listsCount error : ".mysql_error());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }

    public function detail($conn,Applicants $obj)
    {
        $sql = "SELECT jobs_id,id,kor_name,mobile_1,mobile_2,mobile_3,email,career_types,career_years,birth_year,tel_1,tel_2,tel_3,school_type,school_name,school_sub";
        $sql .= ",wish_pay,regdate,status,memos,hire_date,hire_part,hire_task,keeper_name,keeper_contact ";
        $sql .= " FROM applicants ";

        $sql .= " WHERE jobs_id='".$obj->getJobsId()."' AND id='".$obj->getId()."'";

        $result = mysql_query($sql) or die("ApplicantsDaoImpl detail error : ".mysql_error());

        return $result;
    }

    public function detail4Success($conn, Applicants $obj) {
        $sql = "SELECT status, date_format(hire_date,'%Y.%m.%d') hire_date, WEEKDAY(hire_date) wday, hire_part, hire_task, keeper_name, keeper_contact FROM applicants ";
        $sql .= " WHERE kor_name='".$obj->getKorName()."' AND mobile_1='".$obj->getMobile1()."' AND mobile_2='".$obj->getMobile2()."' AND mobile_3='".$obj->getMobile3()."' ";
        $sql .= " ORDER BY regdate ASC";

        $result = mysql_query($sql) or die("ApplicantsDaoImpl detail4Success error : ".mysql_error());

        return $result;
    }

}