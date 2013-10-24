<?php
/**
 * User: KeeperServiceImpl (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 2:55
 */

require_once("/class/service/IKeeperService.php");
require_once("/class/dao/KeeperDaoImpl.php");
error_reporting(0);
session_start();
class KeeperServiceImpl implements IKeeperService {

    private $keeperDao;

    /**
     * @param mixed $keeperDao
     */
    public function setKeeperDao(KeeperDaoImpl $keeperDao)
    {
        $this->keeperDao = $keeperDao;
    }

    public function add($conn, Keeper $obj)
    {
        $resultOfService = $this->keeperDao->add($conn, $obj);
    }

    public function update($conn, Keeper $obj)
    {
        // TODO: Implement update() method.
    }

    public function delete($conn, Keeper $obj)
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

    public function tryLogin($conn, Keeper $obj)
    {
        $result = 0;

        $keeperId = $obj->getId();

        // 아이디가 존재하는 지 여부 판단
        $wParam = " id='".$keeperId."' ";
        $countOfId = $this->keeperDao->listsCount($conn, $wParam);
        if($countOfId > 0) {
            // 정상 로그인 처리
            $_SESSION["keeper_id"] = $keeperId;
            $result = 1;
        } else {
            // 아이디 자체가 없음
            session_destroy();
            $result = 2;
        }

        return $result;
    }

    public function tryLogout(Keeper $obj)
    {
        // 세션정보 삭제

    }
}