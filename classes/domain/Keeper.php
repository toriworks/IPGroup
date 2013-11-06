<?
/**
 * User: Keeper (toriworks@gmail.com)
 * Date: 13. 10. 22
 * Time: 오후 5:04
 */

/**
 * 관리자 테이블 매핑 VO
 */
class Keeper
{
    /** @var string 아이디 */
    private $id = '';
    /** @var string 한글 이름 */
    private $kor_name = '';
    /** @var string 등록일 */
    private $regdate = '';
    /** @var int 로그인 횟수 */
    private $login_cnt = 0;
    /** @var string 마지막 로그인 일시 */
    private $last_login = '';
    /** @var string 권한유형 */
    private $auth_types = '';
    private $menu1 = '';
    private $menu2 = '';
    private $menu3 = '';
    private $menu4 = '';
    private $menu5 = '';
    private $menu6 = '';

    /**
     * @param string $menu1
     */
    public function setMenu1($menu1)
    {
        $this->menu1 = $menu1;
    }

    /**
     * @return string
     */
    public function getMenu1()
    {
        return $this->menu1;
    }

    /**
     * @param string $menu2
     */
    public function setMenu2($menu2)
    {
        $this->menu2 = $menu2;
    }

    /**
     * @return string
     */
    public function getMenu2()
    {
        return $this->menu2;
    }

    /**
     * @param string $menu3
     */
    public function setMenu3($menu3)
    {
        $this->menu3 = $menu3;
    }

    /**
     * @return string
     */
    public function getMenu3()
    {
        return $this->menu3;
    }

    /**
     * @param string $menu4
     */
    public function setMenu4($menu4)
    {
        $this->menu4 = $menu4;
    }

    /**
     * @return string
     */
    public function getMenu4()
    {
        return $this->menu4;
    }

    /**
     * @param string $menu5
     */
    public function setMenu5($menu5)
    {
        $this->menu5 = $menu5;
    }

    /**
     * @return string
     */
    public function getMenu5()
    {
        return $this->menu5;
    }

    /**
     * @param string $menu6
     */
    public function setMenu6($menu6)
    {
        $this->menu6 = $menu6;
    }

    /**
     * @return string
     */
    public function getMenu6()
    {
        return $this->menu6;
    }



    /**
     * @param string $auth_types
     */
    public function setAuthTypes($auth_types)
    {
        $this->auth_types = $auth_types;
    }

    /**
     * @return string
     */
    public function getAuthTypes()
    {
        return $this->auth_types;
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
     * @param string $last_login
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @return string
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * @param int $login_cnt
     */
    public function setLoginCnt($login_cnt)
    {
        $this->login_cnt = $login_cnt;
    }

    /**
     * @return int
     */
    public function getLoginCnt()
    {
        return $this->login_cnt;
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

}
?>