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