<?php
/**
 * User: Work (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:13
 */

/**
 * Work 메뉴 VO
 */
class Work
{
    private $id = '';
    private $regdate = '';
    private $moddate = '';
    private $keeper_id = '';
    private $is_shop = '';

    // 썸네일 부분
    private $thumb_types = '';  // 1단, 2단
    private $thumb_title = '';
    private $thumb_sub_title = '';
    private $open_date_y = '';
    private $open_date_m = '';
    private $open_date_d = '';
    private $thumb_attach_1 = '';
    private $thumb_attach_2 = '';

    // 상세등록
    private $types = '';        // Project, Promotion, UX/UI, Mobile, Offer, Consulting, AD
    private $name = '';
    private $client_name = '';
    private $start_date_y = '';
    private $start_date_m = '';
    private $start_date_d = '';
    private $end_date_y = '';
    private $end_date_m = '';
    private $end_date_d = '';
    private $url = '';
    private $descriptions = '';

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
     * @param string $client_name
     */
    public function setClientName($client_name)
    {
        $this->client_name = $client_name;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->client_name;
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
     * @param string $is_shop
     */
    public function setIsShop($is_shop)
    {
        $this->is_shop = $is_shop;
    }

    /**
     * @return string
     */
    public function getIsShop()
    {
        return $this->is_shop;
    }

    /**
     * @param string $keeper_id
     */
    public function setKeeperId($keeper_id)
    {
        $this->keeper_id = $keeper_id;
    }

    /**
     * @return string
     */
    public function getKeeperId()
    {
        return $this->keeper_id;
    }

    /**
     * @param string $moddate
     */
    public function setModdate($moddate)
    {
        $this->moddate = $moddate;
    }

    /**
     * @return string
     */
    public function getModdate()
    {
        return $this->moddate;
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
     * @param string $open_date_d
     */
    public function setOpenDateD($open_date_d)
    {
        $this->open_date_d = $open_date_d;
    }

    /**
     * @return string
     */
    public function getOpenDateD()
    {
        return $this->open_date_d;
    }

    /**
     * @param string $open_date_m
     */
    public function setOpenDateM($open_date_m)
    {
        $this->open_date_m = $open_date_m;
    }

    /**
     * @return string
     */
    public function getOpenDateM()
    {
        return $this->open_date_m;
    }

    /**
     * @param string $open_date_y
     */
    public function setOpenDateY($open_date_y)
    {
        $this->open_date_y = $open_date_y;
    }

    /**
     * @return string
     */
    public function getOpenDateY()
    {
        return $this->open_date_y;
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
     * @param string $thumb_attach_1
     */
    public function setThumbAttach1($thumb_attach_1)
    {
        $this->thumb_attach_1 = $thumb_attach_1;
    }

    /**
     * @return string
     */
    public function getThumbAttach1()
    {
        return $this->thumb_attach_1;
    }

    /**
     * @param string $thumb_attach_2
     */
    public function setThumbAttach2($thumb_attach_2)
    {
        $this->thumb_attach_2 = $thumb_attach_2;
    }

    /**
     * @return string
     */
    public function getThumbAttach2()
    {
        return $this->thumb_attach_2;
    }

    /**
     * @param string $thumb_sub_title
     */
    public function setThumbSubTitle($thumb_sub_title)
    {
        $this->thumb_sub_title = $thumb_sub_title;
    }

    /**
     * @return string
     */
    public function getThumbSubTitle()
    {
        return $this->thumb_sub_title;
    }

    /**
     * @param string $thumb_title
     */
    public function setThumbTitle($thumb_title)
    {
        $this->thumb_title = $thumb_title;
    }

    /**
     * @return string
     */
    public function getThumbTitle()
    {
        return $this->thumb_title;
    }

    /**
     * @param string $thumb_types
     */
    public function setThumbTypes($thumb_types)
    {
        $this->thumb_types = $thumb_types;
    }

    /**
     * @return string
     */
    public function getThumbTypes()
    {
        return $this->thumb_types;
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
}