<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 11. 7
 * Time: 오후 9:46
 * To change this template use File | Settings | File Templates.
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IApplicantsCompanyService.php");
require_once(class_path."/classes/dao/ApplicantsCompanyDaoImpl.php");
class ApplicantsCompanyServiceImpl implements IApplicantsCompanyService {

    private $applicantsCompanyDao;

    /**
     * @param mixed $applicantsCompanyDao
     */
    public function setApplicantsCompanyDao($applicantsCompanyDao)
    {
        $this->applicantsCompanyDao = $applicantsCompanyDao;
    }

    public function add($conn, ApplicantsCompany $obj)
    {
        return $this->applicantsCompanyDao->add($conn, $obj);
    }

    public function update($conn, ApplicantsCompany $obj)
    {
        // TODO: Implement update() method.
    }

    public function delete($conn, ApplicantsCompany $obj)
    {
        return $this->applicantsCompanyDao->delete($conn, $obj);
    }

    public function lists($conn, $wParam, $orderBy, $curPage, $pageMax)
    {
        return $this->applicantsCompanyDao->lists($conn, $wParam, $orderBy, $curPage, $pageMax);
    }

    public function listsCount($conn, $wParam)
    {
        // TODO: Implement listsCount() method.
    }
}