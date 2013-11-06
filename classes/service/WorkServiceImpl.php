<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 10. 27
 * Time: 오전 10:43
 * To change this template use File | Settings | File Templates.
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IWorkService.php");
require_once(class_path."/classes/dao/WorkDaoImpl.php");
require_once(class_path."/classes/domain/Work.php");
require_once(class_path."/classes/service/AttachesServiceImpl.php");
require_once(class_path."/classes/dao/AttachesDaoImpl.php");

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

    public function lists4Work($conn, $year, $category)
    {
        $result = $this->workDao->lists4Work($conn, $year, $category);
        $arrWorks = null;

        // 첨부파일 관련선언
        $attachesDao = new AttachesDaoImpl();
        $attachesService = new AttachesServiceImpl();
        $attachesService->setAttachesDao($attachesDao);

        $i = 0;
        while($row = mysql_fetch_array($result)) {
            $workObj = new Work();
            $workObj->setId($row['id']);

            // 날짜 조합
            $open_date = $this->getDate4Work($row['open_date_y'], $row['open_date_m'], $row['open_date_d']);
            $start_date = $this->getDate4Work($row['start_date_y'], $row['start_date_m'], $row['start_date_d']);
            $end_date = $this->getDate4Work($row['end_date_y'], $row['end_date_m'], $row['end_date_d']);

            $workObj->setThumbTypes($row['thumb_types']);
            $workObj->setThumbTitle($row['thumb_title']);
            $workObj->setThumbSubTitle($row['thumb_sub_title']);
            $workObj->setOpenDateStr($open_date);
            $workObj->setStartDateStr($start_date);
            $workObj->setEndDateStr($end_date);
            $workObj->setClientName($row['client_name']);
            $workObj->setName($row['name']);
            $workObj->setUrl($row['url']);
            $workObj->setDescriptions($row['descriptions']);

            // 첨부파일 처리
            $arrAttaches = $attachesService->lists4Work($conn, $row['id']);
            $workObj->setArrAttaches($arrAttaches);

            $arrWorks[$i++] = $workObj;
        }

        return $arrWorks;
    }

    public function lists4WorkTest($conn, $year, $category)
    {
        $result = $this->workDao->lists4WorkTest($conn, $year, $category);
        $arrWorks = null;

        // 첨부파일 관련선언
        $attachesDao = new AttachesDaoImpl();
        $attachesService = new AttachesServiceImpl();
        $attachesService->setAttachesDao($attachesDao);

        $i = 0;
        while($row = mysql_fetch_array($result)) {
            $workObj = new Work();
            $workObj->setId($row['id']);

            // 날짜 조합
            $open_date = $this->getDate4Work($row['open_date_y'], $row['open_date_m'], $row['open_date_d']);
            $start_date = $this->getDate4Work($row['start_date_y'], $row['start_date_m'], $row['start_date_d']);
            $end_date = $this->getDate4Work($row['end_date_y'], $row['end_date_m'], $row['end_date_d']);

            $workObj->setThumbTypes($row['thumb_types']);
            $workObj->setThumbTitle($row['thumb_title']);
            $workObj->setThumbSubTitle($row['thumb_sub_title']);
            $workObj->setOpenDateStr($open_date);
            $workObj->setStartDateStr($start_date);
            $workObj->setEndDateStr($end_date);
            $workObj->setClientName($row['client_name']);
            $workObj->setName($row['name']);
            $workObj->setUrl($row['url']);
            $workObj->setDescriptions($row['descriptions']);

            // 첨부파일 처리
            $arrAttaches = $attachesService->lists4Work($conn, $row['id']);
            $workObj->setArrAttaches($arrAttaches);

            $arrWorks[$i++] = $workObj;
        }

        return $arrWorks;
    }

    private function getDate4Work($y, $m, $d) {
        $strDate = '';
        $strDate = $y;
        if($y != '') {
            if($m != '') {
                $strDate = $strDate.'.'.$m;
            }
        }
        if($m != '') {
            if($d != '') {
                $strDate = $strDate.'.'.$d;
            }
        }

        return $strDate;
    }
}