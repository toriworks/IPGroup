<?php
/**
 * User: Applicants (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:47
 */

/**
 * Recruit 지원자 VO
 */
class Applicants
{
    private $jobs_id = '';
    private $id = '';
    private $kor_name = '';
    private $mobile_1 = '';
    private $mobile_2 = '';
    private $mobile_3 = '';
    private $email = '';
    private $career_types = '';
    private $career_years = '';
    private $birth_year = '';
    private $tel_1 = '';
    private $tel_2 = '';
    private $tel_3 = '';
    private $school_type = '';
    private $school_name = '';
    private $school_sub = '';
    private $wish_pay = '';
    private $regdate = '';
    private $status = '';
    private $memos = '';
    private $hire_date = '';
    private $hire_part = '';
    private $hire_task = '';
    private $jobs_hire_part = '';

    /**
     * @param string $jobs_hire_part
     */
    public function setJobsHirePart($jobs_hire_part)
    {
        $this->jobs_hire_part = $jobs_hire_part;
    }

    /**
     * @return string
     */
    public function getJobsHirePart()
    {
        return $this->jobs_hire_part;
    }

    /**
     * @param string $birth_year
     */
    public function setBirthYear($birth_year)
    {
        $this->birth_year = $birth_year;
    }

    /**
     * @return string
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }

    /**
     * @param string $career_types
     */
    public function setCareerTypes($career_types)
    {
        $this->career_types = $career_types;
    }

    /**
     * @return string
     */
    public function getCareerTypes()
    {
        return $this->career_types;
    }

    /**
     * @param string $career_years
     */
    public function setCareerYears($career_years)
    {
        $this->career_years = $career_years;
    }

    /**
     * @return string
     */
    public function getCareerYears()
    {
        return $this->career_years;
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
     * @param string $hire_date
     */
    public function setHireDate($hire_date)
    {
        $this->hire_date = $hire_date;
    }

    /**
     * @return string
     */
    public function getHireDate()
    {
        return $this->hire_date;
    }

    /**
     * @param string $hire_part
     */
    public function setHirePart($hire_part)
    {
        $this->hire_part = $hire_part;
    }

    /**
     * @return string
     */
    public function getHirePart()
    {
        return $this->hire_part;
    }

    /**
     * @param string $hire_task
     */
    public function setHireTask($hire_task)
    {
        $this->hire_task = $hire_task;
    }

    /**
     * @return string
     */
    public function getHireTask()
    {
        return $this->hire_task;
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
     * @param string $jobs_id
     */
    public function setJobsId($jobs_id)
    {
        $this->jobs_id = $jobs_id;
    }

    /**
     * @return string
     */
    public function getJobsId()
    {
        return $this->jobs_id;
    }

    /**
     * @param string $kor_name
     */
    public function setKorName($kor_name)
    {
        $this->kor_name = $kor_name;
    }

    /**
     * @return string
     */
    public function getKorName()
    {
        return $this->kor_name;
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

    /**
     * @param string $mobile_1
     */
    public function setMobile1($mobile_1)
    {
        $this->mobile_1 = $mobile_1;
    }

    /**
     * @return string
     */
    public function getMobile1()
    {
        return $this->mobile_1;
    }

    /**
     * @param string $mobile_2
     */
    public function setMobile2($mobile_2)
    {
        $this->mobile_2 = $mobile_2;
    }

    /**
     * @return string
     */
    public function getMobile2()
    {
        return $this->mobile_2;
    }

    /**
     * @param string $mobile_3
     */
    public function setMobile3($mobile_3)
    {
        $this->mobile_3 = $mobile_3;
    }

    /**
     * @return string
     */
    public function getMobile3()
    {
        return $this->mobile_3;
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
     * @param string $school_name
     */
    public function setSchoolName($school_name)
    {
        $this->school_name = $school_name;
    }

    /**
     * @return string
     */
    public function getSchoolName()
    {
        return $this->school_name;
    }

    /**
     * @param string $school_sub
     */
    public function setSchoolSub($school_sub)
    {
        $this->school_sub = $school_sub;
    }

    /**
     * @return string
     */
    public function getSchoolSub()
    {
        return $this->school_sub;
    }

    /**
     * @param string $school_type
     */
    public function setSchoolType($school_type)
    {
        $this->school_type = $school_type;
    }

    /**
     * @return string
     */
    public function getSchoolType()
    {
        return $this->school_type;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $tel_1
     */
    public function setTel1($tel_1)
    {
        $this->tel_1 = $tel_1;
    }

    /**
     * @return string
     */
    public function getTel1()
    {
        return $this->tel_1;
    }

    /**
     * @param string $tel_2
     */
    public function setTel2($tel_2)
    {
        $this->tel_2 = $tel_2;
    }

    /**
     * @return string
     */
    public function getTel2()
    {
        return $this->tel_2;
    }

    /**
     * @param string $tel_3
     */
    public function setTel3($tel_3)
    {
        $this->tel_3 = $tel_3;
    }

    /**
     * @return string
     */
    public function getTel3()
    {
        return $this->tel_3;
    }

    /**
     * @param string $wish_pay
     */
    public function setWishPay($wish_pay)
    {
        $this->wish_pay = $wish_pay;
    }

    /**
     * @return string
     */
    public function getWishPay()
    {
        return $this->wish_pay;
    }


}