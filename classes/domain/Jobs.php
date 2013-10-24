<?php
/**
 * User: Recruit (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:45
 */

/**
 * Job Posting 메뉴 VO
 */
class Jobs
{
    private $id = '';
    private $title = '';
    private $start_date_y = '';
    private $start_date_m = '';
    private $start_date_d = '';
    private $end_date_y = '';
    private $end_date_m = '';
    private $end_date_d = '';
    private $is_always = '';

    private $career_types = '';     // 신입, 경력, 무관
    private $career_years = '';
    private $how_many = '';
    private $hire_types = '';       // 정규직, 계약직
    private $school_types = '';     // 고졸, 대졸, 무관
    private $hire_part = '';        // 기획팀, 디자인팀, 퍼블리싱팀, 경영지원팀
    private $position = '';

    private $how_old;       // 0이면 무관
    private $descriptions = '';
    private $add_descriptions = '';

    private $keeper_name = '';
    private $keeper_contacts = '';

    private $applicants_cnt = 0;
    private $is_show = '';
    private $regdate;

    /**
     * @param string $add_descriptions
     */
    public function setAddDescriptions($add_descriptions)
    {
        $this->add_descriptions = $add_descriptions;
    }

    /**
     * @return string
     */
    public function getAddDescriptions()
    {
        return $this->add_descriptions;
    }

    /**
     * @param int $applicants_cnt
     */
    public function setApplicantsCnt($applicants_cnt)
    {
        $this->applicants_cnt = $applicants_cnt;
    }

    /**
     * @return int
     */
    public function getApplicantsCnt()
    {
        return $this->applicants_cnt;
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
     * @param string $end_date_d
     */
    public function setEndDateD($end_date_d)
    {
        $this->end_date_d = $end_date_d;
    }

    /**
     * @return string
     */
    public function getEndDateD()
    {
        return $this->end_date_d;
    }

    /**
     * @param string $end_date_m
     */
    public function setEndDateM($end_date_m)
    {
        $this->end_date_m = $end_date_m;
    }

    /**
     * @return string
     */
    public function getEndDateM()
    {
        return $this->end_date_m;
    }

    /**
     * @param string $end_date_y
     */
    public function setEndDateY($end_date_y)
    {
        $this->end_date_y = $end_date_y;
    }

    /**
     * @return string
     */
    public function getEndDateY()
    {
        return $this->end_date_y;
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
     * @param string $hire_types
     */
    public function setHireTypes($hire_types)
    {
        $this->hire_types = $hire_types;
    }

    /**
     * @return string
     */
    public function getHireTypes()
    {
        return $this->hire_types;
    }

    /**
     * @param string $how_many
     */
    public function setHowMany($how_many)
    {
        $this->how_many = $how_many;
    }

    /**
     * @return string
     */
    public function getHowMany()
    {
        return $this->how_many;
    }

    /**
     * @param mixed $how_old
     */
    public function setHowOld($how_old)
    {
        $this->how_old = $how_old;
    }

    /**
     * @return mixed
     */
    public function getHowOld()
    {
        return $this->how_old;
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
     * @param string $is_always
     */
    public function setIsAlways($is_always)
    {
        $this->is_always = $is_always;
    }

    /**
     * @return string
     */
    public function getIsAlways()
    {
        return $this->is_always;
    }

    /**
     * @param string $is_show
     */
    public function setIsShow($is_show)
    {
        $this->is_show = $is_show;
    }

    /**
     * @return string
     */
    public function getIsShow()
    {
        return $this->is_show;
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
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $regdate
     */
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;
    }

    /**
     * @return mixed
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * @param string $school_types
     */
    public function setSchoolTypes($school_types)
    {
        $this->school_types = $school_types;
    }

    /**
     * @return string
     */
    public function getSchoolTypes()
    {
        return $this->school_types;
    }

    /**
     * @param string $start_date_d
     */
    public function setStartDateD($start_date_d)
    {
        $this->start_date_d = $start_date_d;
    }

    /**
     * @return string
     */
    public function getStartDateD()
    {
        return $this->start_date_d;
    }

    /**
     * @param string $start_date_m
     */
    public function setStartDateM($start_date_m)
    {
        $this->start_date_m = $start_date_m;
    }

    /**
     * @return string
     */
    public function getStartDateM()
    {
        return $this->start_date_m;
    }

    /**
     * @param string $start_date_y
     */
    public function setStartDateY($start_date_y)
    {
        $this->start_date_y = $start_date_y;
    }

    /**
     * @return string
     */
    public function getStartDateY()
    {
        return $this->start_date_y;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

}