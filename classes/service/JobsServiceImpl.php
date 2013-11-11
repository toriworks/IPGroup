<?php
/**
 * User: JobsServiceImpl (toriworks@gmail.com)
 * Date: 13. 10. 30
 * Time: 오후 8:35
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IJobsService.php");
require_once(class_path."/classes/dao/JobsDaoImpl.php");
class JobsServiceImpl implements IJobsService {

    private $jobsDao;

    /**
     * @param mixed $jobsDao
     */
    public function setJobsDao($jobsDao)
    {
        $this->jobsDao = $jobsDao;
    }

    public function add($conn, Jobs $obj)
    {
        return $this->jobsDao->add($conn, $obj);
    }

    public function update($conn, Jobs $obj)
    {
        return $this->jobsDao->update($conn, $obj);
    }

    public function delete($conn, Jobs $obj)
    {
        return $this->jobsDao->delete($conn, $obj);
    }

    public function lists($conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax)
    {
        return $this->jobsDao->lists($conn, $wParam, $orderBy, $orderDir, $curPage, $pageMax);
    }

    public function listsCount($conn, $wParam)
    {
        return $this->jobsDao->listsCount($conn, $wParam);
    }

    public function detail($conn, Jobs $obj)
    {
        return $this->jobsDao->detail($conn, $obj);
    }
}