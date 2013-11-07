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
    private $start_date;
    private $end_date;
    private $position;
    private $descriptions;
    private $regdate;
    private $moddate;
    private $order;

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
     * @param mixed $end_date
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
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
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }


}