<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 10. 27
 * Time: 오전 10:43
 * To change this template use File | Settings | File Templates.
 */

@define('class_path', '/home/host01/ipgroup');
require_once(class_path."/classes/service/IWorkService.php");
require_once(class_path."/classes/dao/WorkDaoImpl.php");
class WorkServiceImpl implements IWorkService {

    private $workDao;

    /**
     * @param mixed $workDao
     */
    public function setWorkDao($workDao)
    {
        $this->workDao = $workDao;
    }

    /**
     * @return mixed
     */
    public function getWorkDao()
    {
        return $this->workDao;
    }

    public function add($conn, Work $obj)
    {
        $retValue = $this->workDao->add($conn, $obj);
        return $retValue;
    }

    public function update($conn, Work $obj)
    {
        $retValue = $this->workDao->update($conn, $obj);
        return $retValue;
    }

    public function delete($conn, Work $obj)
    {
        return $this->workDao->delete($conn, $obj);
    }

    public function lists($conn, $wParam, $orderBy, $curPage, $pageMax)
    {
        return $this->workDao->lists($conn, $wParam, $orderBy, $curPage, $pageMax);
    }

    public function listsCount($conn, $wParam)
    {
        return $this->workDao->listsCount($conn, $wParam);
    }

    public function detail($conn, Work $obj)
    {
        $result = $this->workDao->detail($conn, $obj);
        return $result;
    }
}