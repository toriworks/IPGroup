<?php
/**
 * User: ApplicantsCompany (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 4:43
 */

class ApplicantsCompany {

    private $jobs_id;
    private $applicants_id;
    private $id;
    private $company_name;
    private $start_date_y;
    private $start_date_m;
    private $start_date_d;
    private $end_date_y;
    private $end_date_m;
    private $end_date_d;
    private $position;
    private $descriptions;
    private $regdate;
    private $moddate;
    private $order;

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $applicants_id
     */
    public function setApplicantsId($applicants_id)
    {
        $this->applicants_id = $applicants_id;
    }

    /**
     * @return mixed
     */
    public function getApplicantsId()
    {
        return $this->applicants_id;
    }

    /**
     * @param mixed $company_name
     */
    public function setCompanyName($company_name)
    {
        $this->company_name = $company_name;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * @param mixed $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @return mixed
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param mixed $end_date_d
     */
    public function setEndDateD($end_date_d)
    {
        $this->end_date_d = $end_date_d;
    }

    /**
     * @return mixed
     */
    public function getEndDateD()
    {
        return $this->end_date_d;
    }

    /**
     * @param mixed $end_date_m
     */
    public function setEndDateM($end_date_m)
    {
        $this->end_date_m = $end_date_m;
    }

    /**
     * @return mixed
     */
    public function getEndDateM()
    {
        return $this->end_date_m;
    }

    /**
     * @param mixed $end_date_y
     */
    public function setEndDateY($end_date_y)
    {
        $this->end_date_y = $end_date_y;
    }

    /**
     * @return mixed
     */
    public function getEndDateY()
    {
        return $this->end_date_y;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $jobs_id
     */
    public function setJobsId($jobs_id)
    {
        $this->jobs_id = $jobs_id;
    }

    /**
     * @return mixed
     */
    public function getJobsId()
    {
        return $this->jobs_id;
    }

    /**
     * @param mixed $moddate
     */
    public function setModdate($moddate)
    {
        $this->moddate = $moddate;
    }

    /**
     * @return mixed
     */
    public function getModdate()
    {
        return $this->moddate;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
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
     * @param mixed $start_date_d
     */
    public function setStartDateD($start_date_d)
    {
        $this->start_date_d = $start_date_d;
    }

    /**
     * @return mixed
     */
    public function getStartDateD()
    {
        return $this->start_date_d;
    }

    /**
     * @param mixed $start_date_m
     */
    public function setStartDateM($start_date_m)
    {
        $this->start_date_m = $start_date_m;
    }

    /**
     * @return mixed
     */
    public function getStartDateM()
    {
        return $this->start_date_m;
    }

    /**
     * @param mixed $start_date_y
     */
    public function setStartDateY($start_date_y)
    {
        $this->start_date_y = $start_date_y;
    }

    /**
     * @return mixed
     */
    public function getStartDateY()
    {
        return $this->start_date_y;
    }


}