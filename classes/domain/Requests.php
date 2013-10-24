<?php
/**
 * User: Requests (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:32
 */

/**
 * Request 테이블 VO
 */
class Requests
{
    private $id = '';
    private $company_name = '';
    private $contact_tel = '';
    private $contact_mobile = '';
    private $email = '';
    private $url = '';
    private $types = '';        // Project, Promotion, UX/UI, Mobile, Offer, Cosulting, AD
    private $manager_name = '';
    private $manager_id = '';
    private $descriptions = '';
    private $memos = '';
    private $regdate = '';

    // 첨부파일
    private $arrAttaches = null;

    /**
     * @param null $arrAttaches
     */
    public function setArrAttaches($arrAttaches)
    {
        $this->arrAttaches = $arrAttaches;
    }

    /**
     * @return null
     */
    public function getArrAttaches()
    {
        return $this->arrAttaches;
    }

    /**
     * @param string $company_name
     */
    public function setCompanyName($company_name)
    {
        $this->company_name = $company_name;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * @param string $contact_mobile
     */
    public function setContactMobile($contact_mobile)
    {
        $this->contact_mobile = $contact_mobile;
    }

    /**
     * @return string
     */
    public function getContactMobile()
    {
        return $this->contact_mobile;
    }

    /**
     * @param string $contact_tel
     */
    public function setContactTel($contact_tel)
    {
        $this->contact_tel = $contact_tel;
    }

    /**
     * @return string
     */
    public function getContactTel()
    {
        return $this->contact_tel;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $manager_id
     */
    public function setManagerId($manager_id)
    {
        $this->manager_id = $manager_id;
    }

    /**
     * @return string
     */
    public function getManagerId()
    {
        return $this->manager_id;
    }

    /**
     * @param string $manager_name
     */
    public function setManagerName($manager_name)
    {
        $this->manager_name = $manager_name;
    }

    /**
     * @return string
     */
    public function getManagerName()
    {
        return $this->manager_name;
    }

    /**
     * @param string $regdate
     */
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;
    }

    /**
     * @return string
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * @param string $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }

    /**
     * @return string
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @return string
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param string $memos
     */
    public function setMemos($memos)
    {
        $this->memos = $memos;
    }

    /**
     * @return string
     */
    public function getMemos()
    {
        return $this->memos;
    }

}
?>