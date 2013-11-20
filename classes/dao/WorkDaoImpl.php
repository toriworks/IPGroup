<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 26
 * Time: 오후 2:07
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IWorkDao.php");

class WorkDaoImpl implements IWorkDao {

    public function add($conn, Work $obj)
    {
        $resultOfQuery = 0;
        $sql = "INSERT INTO work (id, regdate, moddate, keeper_id, mod_id, is_shop, thumb_types, thumb_title, thumb_sub_title";
        $sql .= ", open_date_y, open_date_m, open_date_d, wtypes, name, client_name";
        $sql .= ", start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d, url, descriptions) ";
        $sql .= " VALUES ('".$obj->getId()."', now(), now(), '".$obj->getKeeperId()."', '".$obj->getModId()."', '".$obj->getIsShop()."', '".$obj->getThumbTypes()."', '".$obj->getThumbTitle()."'";
        $sql .= ", '".$obj->getThumbSubTitle()."', '".$obj->getOpenDateY()."', '".$obj->getOpenDateM()."', '".$obj->getOpenDateD()."'";
        $sql .= ", ".$obj->getWtypes().", '".$obj->getName()."', '".$obj->getClientName()."'";
        $sql .= ", '".$obj->getStartDateY()."', '".$obj->getStartDateM()."', '".$obj->getStartDateD()."', '".$obj->getEndDateY()."', '".$obj->getEndDateM()."', '".$obj->getEndDateD()."'";
        $sql .= ", '".$obj->getUrl()."', '".$obj->getDescriptions()."')";

        $resultOfQuery = mysql_query($sql) or die("WorkDaoImpl add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update($conn, Work $obj)
    {
        $resultOfQuery = 0;
        $sql = "UPDATE work SET moddate=now(), mod_id='".$obj->getModId()."', is_shop='".$obj->getIsShop()."', thumb_types='".$obj->getThumbTypes()."'";
        $sql .= ", thumb_title='".$obj->getThumbTitle()."', thumb_sub_title='".$obj->getThumbSubTitle()."', open_date_y='".$obj->getOpenDateY()."'";
        $sql .= ", open_date_m='".$obj->getOpenDateM()."', open_date_d='".$obj->getOpenDateD()."'";
        $sql .= ", wtypes='".$obj->getWtypes()."', name='".$obj->getName()."', client_name='".$obj->getClientName()."'";
        $sql .= ", start_date_y='".$obj->getStartDateY()."', start_date_m='".$obj->getStartDateM()."', start_date_d='".$obj->getStartDateD()."'";
        $sql .= ", end_date_y='".$obj->getEndDateY()."', end_date_m='".$obj->getEndDateM()."', end_date_d='".$obj->getEndDateD()."'";
        $sql .= ", url='".$obj->getUrl()."', descriptions='".$obj->getDescriptions()."'";
        $sql .= " WHERE id='".$obj->getId()."'";

        echo $sql;

        $resultOfQuery = mysql_query($sql) or die("WorkDaoImpl update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete($conn, Work $obj)
    {
        $resultOfQuery = 0;
        $sql = "DELETE FROM work WHERE id='".$obj->getId()."'";
        $resultOfQuery = mysql_query($sql) or die("WorkDaoImpl delete error : ".mysql_error());

        return $resultOfQuery;
    }

    public function lists($conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax)
    {
        $sql = "SELECT id, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r, date_format(moddate, '%Y.%m.%d') moddate, keeper_id, mod_id, is_shop, thumb_types, thumb_title, thumb_sub_title, open_date_y,";
        $sql .= "open_date_m, open_date_d, wtypes, name, client_name,";
        $sql .= "start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d,";
        $sql .= "url, descriptions FROM work ";
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


        $result = mysql_query($sql) or die("WorkDaoImpl lists error : ".mysql_error());

        return $result;
    }

    public function listsCount($conn, $wParam)
    {
        $sql = "SELECT COUNT(0) cnt FROM work";
        if($wParam != "") {
            $sql .= " WHERE 1=1 ".$wParam;
        }

        $result = mysql_query($sql) or die("WorkDaoImpl listsCount error : ".mysql_error());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }

    public function detail($conn, Work $obj)
    {
        $work_id = $obj->getId();

        $sql = "SELECT id, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r, date_format(moddate, '%Y.%m.%d') moddate, keeper_id, mod_id, is_shop, thumb_types, thumb_title, thumb_sub_title, open_date_y,";
        $sql .= "open_date_m, open_date_d, wtypes, name, client_name,";
        $sql .= "start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d,";
        $sql .= "url, descriptions FROM work ";

        $sql .= " WHERE id='".$work_id."'";

        $result = mysql_query($sql) or die("WorkDaoImpl detail error : ".mysql_error());

        return $result;
    }

    public function lists4Work($conn, $year, $category)
    {
        $sql = "SELECT id, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r, date_format(moddate, '%Y.%m.%d') moddate, keeper_id, mod_id, is_shop, thumb_types, thumb_title, thumb_sub_title, open_date_y,";
        $sql .= "open_date_m, open_date_d, wtypes, name, client_name,";
        $sql .= "start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d,";
        $sql .= "url, descriptions FROM work ";


        // 조건절 구성
        $sql = $sql." WHERE is_shop='Y' ";

        // 카테고리 검색 추가
        $strCategory = '';
        if($category != '') {
            $strCategory = "AND ((".$category." & wtypes)) > 0";
        }

        $sql = $sql.$strCategory;

        // 년도 검색 추가
        $arrYear = explode('^', $year);
        $sizeOfArrYear = count($arrYear)-1;
        $strYear = ''; $strYear2 = '';
        $bPos = 0;
        if(strpos($year, '2010') > 0) {
            $bPos = 1;
        }

        if($year != '') {
            for($i = 0; $i < $sizeOfArrYear; $i++) {
                if($arrYear[$i] != '2010') {
                    $strYear = $strYear." '".$arrYear[$i]."' ";
                    if($i < $sizeOfArrYear-(1+$bPos)) {
                        $strYear = $strYear.",";
                    }
                } else if($arrYear[$i] == '2010') {
                    $strYear2 = $strYear2." open_date_y <= '2010'";
                }
            }

            $operation = "";
            if($strYear != '') {
                $sql = $sql." AND open_date_y IN (".$strYear.")";
                if($strYear2 != '')
                    $operation = " OR ".$strYear2;
            } else if($strYear2) {
                $operation = " AND ".$strYear2;

            }
        }

        // 정렬 추가
        $order = " ORDER BY open_date_y DESC, open_date_m DESC ";


        //echo $sql.$operation.$order;

        $result = mysql_query($sql.$operation.$order) or die("WorkDaoImpl detail error : ".mysql_error());
        return $result;
    }

    public function lists4WorkTest($conn, $year, $category)
    {
        $sql = "SELECT id, date_format(regdate, '%Y.%m.%d') regdate, regdate as regdate_r, date_format(moddate, '%Y.%m.%d') moddate, keeper_id, mod_id, is_shop, thumb_types, thumb_title, thumb_sub_title, open_date_y,";
        $sql .= "open_date_m, open_date_d, wtypes, name, client_name,";
        $sql .= "start_date_y, start_date_m, start_date_d, end_date_y, end_date_m, end_date_d,";
        $sql .= "url, descriptions FROM work ";


        // 조건절 구성
        $sql = $sql." WHERE is_shop='Y' ";

        // 카테고리 검색 추가
        $strCategory = '';
        if($category != '') {
            $strCategory = "AND ((".$category." & wtypes)) > 0";
        }

        $sql = $sql.$strCategory;

        // 년도 검색 추가
        $arrYear = explode('^', $year);
        $sizeOfArrYear = count($arrYear)-1;
        $strYear = ''; $strYear2 = '';
        $bPos = 0;
        if(strpos($year, '2010') > 0) {
            $bPos = 1;
        }

        if($year != '') {
            for($i = 0; $i < $sizeOfArrYear; $i++) {
                if($arrYear[$i] != '2010') {
                    $strYear = $strYear." '".$arrYear[$i]."' ";
                    if($i < $sizeOfArrYear-(1+$bPos)) {
                        $strYear = $strYear.",";
                    }
                } else if($arrYear[$i] == '2010') {
                    $strYear2 = $strYear2." open_date_y <= '2010'";
                }
            }

            $operation = "";
            if($strYear != '') {
                $sql = $sql." AND open_date_y IN (".$strYear.")";
                if($strYear2 != '')
                    $operation = " OR ".$strYear2;
            } else if($strYear2) {
                $operation = " AND ".$strYear2;

            }
        }

        // 정렬 추가
        $order = " ORDER BY open_date_y DESC, open_date_m DESC ";


        echo $sql.$operation.$order;

        $result = mysql_query($sql.$operation.$order) or die("WorkDaoImpl detail error : ".mysql_error());
        return $result;

    }
}

