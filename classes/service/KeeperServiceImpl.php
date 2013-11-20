<?php
/**
 * User: KeeperServiceImpl (toriworks@gmail.com)
 * Date: 13. 10. 23
 * Time: 오후 2:55
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IKeeperService.php");
require_once(class_path."/classes/dao/KeeperDaoImpl.php");
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
        return $resultOfService = $this->keeperDao->add($conn, $obj);
    }

    public function update($conn, Keeper $obj)
    {
        return $this->keeperDao->update($conn, $obj);
    }

    public function delete($conn, Keeper $obj)
    {
        return $this->keeperDao->delete($conn, $obj);
    }

    public function lists($conn, $wParam, $orderBy, $curPage, $pageMax)
    {
        return $this->keeperDao->lists($conn, $wParam, $orderBy, $curPage, $pageMax);
    }

    public function listsCount($conn, $wParam)
    {
        return $this->keeperDao->listsCount($conn, $wParam);
    }

    public function tryLogin( $conn,  Keeper $obj )
    {
        $keeperId = $obj->getId();

        // 아이디가 존재하는 지 여부 판단
        $wParam = " id='".$keeperId."' ";
        $countOfId = $this->keeperDao->listsCount($conn, $wParam);

        if($countOfId > 0) {
            // 정상 로그인 처리
            $this->keeperDao->addLoginCnt($conn, $obj);
            $result = 1;
        } else {
            // 아이디 자체가 없음
            $result = 2;
        }

        return $result;
    }

    public function tryLogout(Keeper $obj)
    {
        // 세션정보 삭제

    }

    public function detail($conn, Keeper $obj)
    {
        $obj = $this->keeperDao->detail($conn, $obj);
        return $obj;
    }
}