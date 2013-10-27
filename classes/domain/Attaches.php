<?php
/**
 * User: WorkAttaches (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:21
 */

/**
 * Work에 포함된 첨부파일
 */
class Attaches
{
    private $ref_id = '';
    private $stypes = '';
    private $mtypes = '';
    private $original_filename = '';
    private $transfer_filename = '';
    private $regdate = '';

    /**
     * @param string $stypes
     */
    public function setStypes($stypes)
    {
        $this->stypes = $stypes;
    }

    /**
     * @return string
     */
    public function getStypes()
    {
        return $this->stypes;
    }

    /**
     * @param string $mtypes
     */
    public function setMtypes($mtypes)
    {
        $this->mtypes = $mtypes;
    }

    /**
     * @return string
     */
    public function getMtypes()
    {
        return $this->mtypes;
    }

    /**
     * @param string $original_filename
     */
    public function setOriginalFilename($original_filename)
    {
        $this->original_filename = $original_filename;
    }

    /**
     * @return string
     */
    public function getOriginalFilename()
    {
        return $this->original_filename;
    }

    /**
     * @param string $ref_id
     */
    public function setRefId($ref_id)
    {
        $this->ref_id = $ref_id;
    }

    /**
     * @return string
     */
    public function getRefId()
    {
        return $this->ref_id;
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
     * @param string $transfer_filename
     */
    public function setTransferFilename($transfer_filename)
    {
        $this->transfer_filename = $transfer_filename;
    }

    /**
     * @return string
     */
    public function getTransferFilename()
    {
        return $this->transfer_filename;
    }

}