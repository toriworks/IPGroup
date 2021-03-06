<?php
/**
 * User: JobsDaoImpl (toriworks@gmail.com)
 * Date: 13. 10. 25
 * Time: 오후 6:29
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IJobsDao.php");
class JobsDaoImpl implements IJobsDao {

    public function add($conn, Jobs $obj)
    {
        $resultOfQuery = 0;
        $sql = "INSERT INTO jobs (id, title, start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d, is_always, career_types, career_years, how_many";
        $sql .= ", hire_types, school_types, hire_part, position, gender, old_types, how_old, descriptions, add_descriptions, keeper_name, keeper_contacts";
        $sql .= ", applicants_cnt, is_show, regdate) VALUES ";
        $sql .= "('".$obj->getId()."', '".$obj->getTitle()."', '".$obj->getStartDateY()."', '".$obj->getStartDateM()."', '".$obj->getStartDateD()."', '".$obj->getEndDateY()."', '".$obj->getEndDateM()."', '".$obj->getEndDateD()."'";
        $sql .= ", '".$obj->getIsAlways()."', '".$obj->getCareerTypes()."', '".$obj->getCareerYears()."', ".$obj->getHowMany();
        $sql .= ", '".$obj->getHireTypes()."', '".$obj->getSchoolTypes()."', '".$obj->getHirePart()."', '".$obj->getPosition()."', '".$obj->getGender()."', '".$obj->getOldTypes()."', '".$obj->getHowOld()."'";
        $sql .= ", '".$obj->getDescriptions()."', '".$obj->getAddDescriptions()."', '".$obj->getKeeperName()."', '".$obj->getKeeperContacts()."'";
        $sql .= ", 0, '".$obj->getIsShow()."', now())";

        $resultOfQuery = mysql_query($sql, $conn) or die("JobsDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn, Jobs $obj)
    {
        $resultofQuery = 0;
        $sql = "UPDATE jobs SET title='".$obj->getTitle()."', start_date_y='".$obj->getStartDateY()."', start_date_m='".$obj->getStartDateM()."', start_date_d='".$obj->getStartDateD()."'";
        $sql .= ", end_date_y='".$obj->getEndDateY()."', end_date_m='".$obj->getEndDateM()."', end_date_d='".$obj->getEndDateD()."', is_always='".$obj->getIsAlways()."'";
        $sql .= ", career_types='".$obj->getCareerTypes()."', career_years='".$obj->getCareerYears()."', how_many=".$obj->getHowMany();
        $sql .= ", hire_types='".$obj->getHireTypes()."', school_types='".$obj->getSchoolTypes()."', hire_part='".$obj->getHirePart()."', position='".$obj->getPosition()."'";
        $sql .= ", gender='".$obj->getGender()."', old_types='".$obj->getOldTypes()."'";
        $sql .= ", how_old='".$obj->getHowOld()."', descriptions='".$obj->getDescriptions()."', add_descriptions='".$obj->getAddDescriptions()."'";
        $sql .= ", keeper_name='".$obj->getKeeperName()."', keeper_contacts='".$obj->getKeeperContacts()."', applicants_cnt='".$obj->getApplicantsCnt()."', is_show='".$obj->getIsShow()."'";
        $sql .= " WHERE id='".$obj->getId()."'";

        //echo $sql;

        $resultOfQuery = mysql_query($sql, $conn) or die("JobsDaoImpl update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete($conn, Jobs $obj)
    {
        $resultOfQuery = 0;
        $sql = "DELETE FROM jobs";
        $sql .= " WHERE id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql, $conn) or die("JobsDaoImpl delete error : ".mysql_error());
        return $resultOfQuery;
    }

    public function lists($conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax)
    {
        $sql = "SELECT id, title, start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d, is_always, career_types, career_years, how_many";
        $sql .= ", hire_types, school_types, hire_part, position, gender, old_types, how_old, descriptions, add_descriptions, keeper_name, keeper_contacts";
        $sql .= ", applicants_cnt, is_show, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r, datediff(now(), regdate) as is_old ";
        $sql .= ", datediff(now(), concat(end_date_y, end_date_m, end_date_d)) as is_closed ";
        $sql .= " FROM jobs ";
        if(!empty($wParam)) {
            $sql .= " WHERE 1=1 ".$wParam;
        }
        if(!empty($orderBy)) {
            if(empty($orderDir)) {
                $orderDir = " DESC ";
            }
            $sql .= " ORDER BY ".$orderBy." ".$orderDir;
        }

        $sql = $sql." LIMIT ".(($curPage-1) * $pageMax)." , ".$pageMax;

        $result = mysql_query($sql) or die("JobsDaoImpl lists error : ".mysql_error());
        return $result;
    }

    public function listsCount($conn, $wParam)
    {
        $sql = "SELECT COUNT(0) cnt FROM jobs ";
        if($wParam != "") {
            $sql .= "WHERE 1=1 ".$wParam;
        }

        $result = mysql_query($sql) or die("JobsDaoImpl listsCount error : ".mysql_error());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }

    public function detail($conn, Jobs $obj)
    {
        $sql = "SELECT title, start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d, is_always, career_types, career_years, how_many ";
        $sql .= ", hire_types, school_types, hire_part, position, gender, old_types, how_old, descriptions, add_descriptions, keeper_name, keeper_contacts ";
        $sql .= ", applicants_cnt, is_show, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r FROM jobs ";
        $sql .= " WHERE id='".$obj->getId()."' ";

        $result = mysql_query($sql) or die("JobsDaoImpl detail error : ".mysql_error());
        return $result;
    }

    public function addCount($conn, Jobs $obj)
    {
        $sql = "UPDATE jobs SET applicants_cnt = applicants_cnt+1 WHERE id='".$obj->getId()."'";

        $result = mysql_query($sql) or die("JobsDaoImpl addCount error : ".mysql_error());
        return $result;
    }
}