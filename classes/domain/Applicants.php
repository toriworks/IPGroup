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
    private $id = '';
    private $status = '';       // 접수, 불합격, 합격
    private $jobs_id = '';

    private $in_date_y = '';
    private $in_date_m = '';
    private $in_date_d = '';
    private $work_part = '';
    private $work_tasks = '';
    private $keeper_name = '';
    private $keeper_contacts = '';

    private $hire_part = '';
    private $has_career = '';
    private $career_year = '';
    private $name = '';
    private $birth_year = '';
    private $contacts_tel = '';
    private $contacts_mobile = '';
    private $email = '';
    private $school_grade = '';
    private $is_graduate = '';
    private $pay_cnt = '';

    private $original_file_name = '';
    private $break_file_name = '';
    private $memos = '';

    private $regdate = '';

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
     * @param string $break_file_name
     */
    public function setBreakFileName($break_file_name)
    {
        $this->break_file_name = $break_file_name;
    }

    /**
     * @return string
     */
    public function getBreakFileName()
    {
        return $this->break_file_name;
    }

    /**
     * @param string $career_year
     */
    public function setCareerYear($career_year)
    {
        $this->career_year = $career_year;
    }

    /**
     * @return string
     */
    public function getCareerYear()
    {
        return $this->career_year;
    }

    /**
     * @param string $contacts_mobile
     */
    public function setContactsMobile($contacts_mobile)
    {
        $this->contacts_mobile = $contacts_mobile;
    }

    /**
     * @return string
     */
    public function getContactsMobile()
    {
        return $this->contacts_mobile;
    }

    /**
     * @param string $contacts_tel
     */
    public function setContactsTel($contacts_tel)
    {
        $this->contacts_tel = $contacts_tel;
    }

    /**
     * @return string
     */
    public function getContactsTel()
    {
        return $this->contacts_tel;
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
     * @param string $has_career
     */
    public function setHasCareer($has_career)
    {
        $this->has_career = $has_career;
    }

    /**
     * @return string
     */
    public function getHasCareer()
    {
        return $this->has_career;
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
     * @param string $in_date_d
     */
    public function setInDateD($in_date_d)
    {
        $this->in_date_d = $in_date_d;
    }

    /**
     * @return string
     */
    public function getInDateD()
    {
        return $this->in_date_d;
    }

    /**
     * @param string $in_date_m
     */
    public function setInDateM($in_date_m)
    {
        $this->in_date_m = $in_date_m;
    }

    /**
     * @return string
     */
    public function getInDateM()
    {
        return $this->in_date_m;
    }

    /**
     * @param string $in_date_y
     */
    public function setInDateY($in_date_y)
    {
        $this->in_date_y = $in_date_y;
    }

    /**
     * @return string
     */
    public function getInDateY()
    {
        return $this->in_date_y;
    }

    /**
     * @param string $is_graduate
     */
    public function setIsGraduate($is_graduate)
    {
        $this->is_graduate = $is_graduate;
    }

    /**
     * @return string
     */
    public function getIsGraduate()
    {
        return $this->is_graduate;
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
     * @param string $keeper_contacts
     */
    public function setKeeperContacts($keeper_contacts)
    {
        $this->keeper_contacts = $keeper_contacts;
    }

    /**
     * @return string
     */
    public function getKeeperContacts()
    {
        return $this->keeper_contacts;
    }

    /**
     * @param string $keeper_name
     */
    public function setKeeperName($keeper_name)
    {
        $this->keeper_name = $keeper_name;
    }

    /**
     * @return string
     */
    public function getKeeperName()
    {
        return $this->keeper_name;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $original_file_name
     */
    public function setOriginalFileName($original_file_name)
    {
        $this->original_file_name = $original_file_name;
    }

    /**
     * @return string
     */
    public function getOriginalFileName()
    {
        return $this->original_file_name;
    }

    /**
     * @param string $pay_cnt
     */
    public function setPayCnt($pay_cnt)
    {
        $this->pay_cnt = $pay_cnt;
    }

    /**
     * @return string
     */
    public function getPayCnt()
    {
        return $this->pay_cnt;
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
     * @param string $school_grade
     */
    public function setSchoolGrade($school_grade)
    {
        $this->school_grade = $school_grade;
    }

    /**
     * @return string
     */
    public function getSchoolGrade()
    {
        return $this->school_grade;
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
     * @param string $work_part
     */
    public function setWorkPart($work_part)
    {
        $this->work_part = $work_part;
    }

    /**
     * @return string
     */
    public function getWorkPart()
    {
        return $this->work_part;
    }

    /**
     * @param string $work_tasks
     */
    public function setWorkTasks($work_tasks)
    {
        $this->work_tasks = $work_tasks;
    }

    /**
     * @return string
     */
    public function getWorkTasks()
    {
        return $this->work_tasks;
    }


}