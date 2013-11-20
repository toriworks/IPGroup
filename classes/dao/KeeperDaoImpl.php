<?php
/**
 * User: UserDaoImpl (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 1:39
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IKeeperDao.php");

class KeeperDaoImpl implements IKeeperDao {

    public function add( $conn, Keeper $obj ) {
        $resultOfQuery = 0;
        $sql = "INSERT INTO keeper (id, regdate, login_cnt, last_login, kor_name, auth_types, menu1, menu2, menu3, menu4, menu5, menu6) VALUES ";
        $sql .= "('".$obj->getId()."', now(), 0, '', '".$obj->getKorName()."', '".$obj->getAuthTypes()."',".$obj->getMenu1().",".$obj->getMenu2().",".$obj->getMenu3().",".$obj->getMenu4().",".$obj->getMenu5().",".$obj->getMenu6().")";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update( $conn, Keeper $obj ) {
        $resultOfQuery = 0;
        $sql = "UPDATE keeper SET kor_name='".$obj->getKorName()."', auth_types='".$obj->getAuthTypes()."' ";
        $sql .= ", menu1=".$obj->getMenu1().", menu2=".$obj->getMenu2().", menu3=".$obj->getMenu3().", menu4=".$obj->getMenu4().", menu5=".$obj->getMenu5().", menu6=".$obj->getMenu6();
        $sql .= " WHERE id='".$obj->getId()."' ";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete( $conn, Keeper $obj ) {
        $resultOfQuery = 0;
        $sql = "DELETE FROM keeper WHERE id='".$obj->getId()."'";

        echo $sql;

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple delete error : ".mysql_error());
        return $resultOfQuery;
    }

    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax ) {
        $sql = "SELECT id, date_format(regdate, '%Y.%m.%d') regdate, regdate regdate_a, login_cnt, last_login, kor_name, auth_types";
        $sql .= ", menu1, menu2, menu3, menu4, menu5, menu6 ";
        $sql .= " FROM keeper ";
        if(!empty($wParam)) {
             $sql .= " WHERE ".$wParam;
        }
        if(!empty($orderBy)) {
             $sql .= " ORDER BY ".$orderBy;
        }

        $sql = $sql." LIMIT ".(($curPage-1) * $pageMax)." , ".$pageMax;

        $result = mysql_query($sql, $conn) or die("KeeperDaoImpl lists error : ".mysql_error());
        return $result;
    }

    public function listsCount( $conn, $wParam ) {
        $sql = "SELECT COUNT(0) cnt FROM keeper";
        if($wParam != "") {
            $sql .= " WHERE ".$wParam;
        }

        $result = mysql_query($sql, $conn) or die("KeeperDaoImple listsCount error : ".mysql_error().":".mysql_errno());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }

    public function addLoginCnt( $conn, Keeper $obj )
    {
        // 로그인 수와 최종 로그인 일자를 변경 수행
        $resultOfQuery = 0;
        $sql = "UPDATE keeper SET login_cnt = login_cnt + 1, last_login = now() WHERE id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple addLoginCnt error : ".mysql_error());
        return $resultOfQuery;
    }

    public function detail($conn, Keeper $obj)
    {
        $keeper_id = $obj->getId();
        $sql = "SELECT kor_name, regdate, login_cnt, last_login, auth_types ";
        $sql .= ", menu1, menu2, menu3, menu4, menu5, menu6 ";
        $sql .= " FROM keeper ";
        $sql .= " WHERE id='".$keeper_id."'";

        $result = mysql_query($sql, $conn);
        while($row = mysql_fetch_array($result)) {
            $obj->setKorName($row['kor_name']);
            $obj->setLoginCnt($row['login_cnt']);
            $obj->setLastLogin($row['last_login']);
            $obj->setRegdate($row['regdate']);
            $obj->setAuthTypes($row['auth_types']);

            $obj->setMenu1($row['menu1']);
            $obj->setMenu2($row['menu2']);
            $obj->setMenu3($row['menu3']);
            $obj->setMenu4($row['menu4']);
            $obj->setMenu5($row['menu5']);
            $obj->setMenu6($row['menu6']);
        }

        return $obj;
    }
}