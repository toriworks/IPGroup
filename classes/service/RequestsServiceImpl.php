<?php
/**
 * User: RequestsServiceImpl (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오후 12:22
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IRequestsService.php");
require_once(class_path."/classes/dao/RequestsDaoImpl.php");
class RequestsServiceImpl implements IRequestsService {

    private $requestsDao;

    /**
     * @param mixed $requestsDao
     */
    public function setRequestsDao($requestsDao)
    {
        $this->requestsDao = $requestsDao;
    }

    public function add($conn, Requests $obj)
    {
        return $this->requestsDao->add($conn, $obj);
    }

    public function update($conn, Requests $obj)
    {
        return $this->requestsDao->update($conn, $obj);
    }

    public function delete($conn, Requests $obj)
    {
        return $this->requestsDao->delete($conn, $obj);
    }

    public function lists($conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax)
    {
        return $this->requestsDao->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax);
    }

    public function listsCount($conn, $wParam)
    {
        return $this->requestsDao->listsCount($conn, $wParam);
    }

    public function detail($conn, Requests $obj)
    {
        $result = $this->requestsDao->detail($conn, $obj);
        return $result;
    }

    public function updateMemos($conn, Requests $obj)
    {
         return $this->requestsDao->updateMemos($conn, $obj);
    }
}