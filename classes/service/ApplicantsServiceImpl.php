<?php
/**
 * User: ApplicantsServiceImpl (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 6:51
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IApplicantsService.php");
require_once(class_path."/classes/dao/ApplicantsDaoImpl.php");
class ApplicantsServiceImpl implements IApplicantsService {

    private $applicantsDao;

    /**
     * @param mixed $applicantsDao
     */
    public function setApplicantsDao($applicantsDao)
    {
        $this->applicantsDao = $applicantsDao;
    }

    public function add($conn, Applicants $obj)
    {
        // TODO: Implement add() method.
    }

    public function update($conn, Applicants $obj)
    {
        // TODO: Implement update() method.
    }

    public function update_keeper($conn, Applicants $obj)
    {
        // TODO: Implement update_keeper() method.
    }

    public function delete($conn, Applicants $obj)
    {
        // TODO: Implement delete() method.
    }

    public function lists($conn, $wParam, $orderBy, $curPage, $pageMax)
    {
        return $this->applicantsDao->lists($conn, $wParam, $orderBy, $curPage, $pageMax);
    }

    public function listsCount($conn, $wParam)
    {
        return $this->applicantsDao->listsCount($conn, $wParam);
    }

    public function detail($conn, Applicants $obj)
    {
        // TODO: Implement detail() method.
    }
}