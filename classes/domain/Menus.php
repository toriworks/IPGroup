<?
/**
 * User: Menus (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:11
 */

/**
 * 관리자별 메뉴 권한 표시 VO
 */
class Menus
{
    private $keeper_id = '';
    private $id = '';
    private $name = '';
    private $auth_code = 0;

    /**
     * @param int $auth_code
     */
    public function setAuthCode($auth_code)
    {
        $this->auth_code = $auth_code;
    }

    /**
     * @return int
     */
    public function getAuthCode()
    {
        return $this->auth_code;
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
     * @return string 객체 값 문자열
     */
    function __toString()
    {
        return '';
    }

} // end of class
?>