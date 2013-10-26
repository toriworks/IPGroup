<?php
/**
 * User: UserDaoImpl (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 1:39
 */

@define('class_path', '/home/host01/ipgroup');
require_once(class_path."/classes/dao/ICommons.php");
require_once(class_path."/classes/dao/IKeeperDao.php");

class KeeperDaoImpl {

    public function add( $conn, Keeper $obj ) {
        $resultOfQuery = 0;
        $sql = "INSERT INTO keeper (id, regdate, login_cnt, last_login, kor_name, auth_type) VALUES ";
        $sql .= "('".$obj->getId()."', now(), 0, '', '".$obj->getKorName()."', '".$obj->getAuthTypes()."')";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple add error : ".mysql_error());
        return $resultOfQuery;
    }

    public function update( $conn, Keeper $obj ) {
        $resultOfQuery = 0;
        $sql = "UPDATE keeper SET kor_name='".$obj->getKorName()."', auth_type='".$obj->getAuthTypes()."' ";
        $sql .= "WHERE id='".$obj->getId()."' ";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple update error : ".mysql_error());
        return $resultOfQuery;
    }

    public function delete( $conn, Keeper $obj ) {
        $resultOfQuery = 0;
        $sql = "DELETE FROM keeper WHERE id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple delete error : ".mysql_error());
        return $resultOfQuery;
    }

    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax ) {
        $sql = "SELECT id, regdate, login_cnt, last_login, kor_name, auth_type FROM keeper ";
        if(!empty($wParam)) {
             $sql .= " WHERE ".$wParam;
        }
        if(!empty($orderBy)) {
             $sql .= " ORDER BY ".$orderBy;
        }

        $sql = $sql." LIMIT ".($curPage * $pageMax)." , ".$pageMax;
    }

    public function listsCount( $conn, $wParam ) {
        $sql = "SELECT COUNT(0) cnt FROM keeper";
        if($wParam != "") {
            $sql .= " WHERE ".$wParam;
        }

        $result = mysql_query($sql) or die("KeeperDaoImple listsCount error : ".mysql_error());
        $tCnt = 0;
        if($result) {
            $tCntArray = mysql_fetch_array($result);
            $tCnt = $tCntArray["cnt"];
        }
        return $tCnt;
    }

    public function addLoginCnt( $conn, $obj ) {
        // 로그인 수와 최종 로그인 일자를 변경 수행
        $resultOfQuery = 0;
        $sql = "UPDATE keeper SET loin_cnt = login_cnt + 1, last_login = now() WHERE id='".$obj->getId()."'";

        $resultOfQuery = mysql_query($sql, $conn) or die("KeeperDaoImple addLoginCnt error : ".mysql_error());
        return $resultOfQuery;
    }
}