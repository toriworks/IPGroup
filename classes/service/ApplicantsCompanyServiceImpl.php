<?php
/**
 * User: Hyoseok Kim(toriworks@gmail.com)
 * Date: 13. 11. 7
 * Time: 오후 9:46
 */

// 소스의 ROOT 패스를 설정
@define('class_path', '/home/hosting_users/ipgroup1/www');

// Service객체와 DAO객체를 선언
require_once(class_path."/classes/service/IApplicantsCompanyService.php");
require_once(class_path."/classes/dao/ApplicantsCompanyDaoImpl.php");

/**
 * 지원자의 사회경력(회사경력)을 관리하는 서비스 객체
 */
class ApplicantsCompanyServiceImpl implements IApplicantsCompanyService {
    /**
     * 실제 서비스를 처리하는 dao를 객체 선언한다.
     * @var
     */
    private $applicantsCompanyDao;

    /**
     * dao 객체를 변수에 넣는다.
     * @param $applicantsCompanyDao DAO객체
     */
    public function setApplicantsCompanyDao($applicantsCompanyDao)
    {
        $this->applicantsCompanyDao = $applicantsCompanyDao;
    }

    /**
     * 신규로 등록하는 지원자의 사회경력(회사경력)을 저장한다.
     * @param $conn 커넥션객체
     * @param ApplicantsCompany $obj 회사정보 객체
     * @return mixed 저장결과값
     */
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