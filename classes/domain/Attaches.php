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
    private $id = '';
    private $target_id = '';
    private $original_file_name = '';
    private $break_file_name = '';
    private $regdate = '';

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
     * @param string $target_id
     */
    public function setTargetId($target_id)
    {
        $this->target_id = $target_id;
    }

    /**
     * @return string
     */
    public function getTargetId()
    {
        return $this->target_id;
    }

}