<?php
/**
 * User: CommonUtils (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오후 7:48
 */

/**
 * 일반적인 유틸리티 클래스
 * 사용예) CommonUtils::getProjectTyeps(sth.)
 */
class CommonUtils {

    /**
     * 프로젝트 타입에 대한 BitAnd 연산결과로 나온 문자열을 얻는다.
     * @param $types 프로젝트 타입
     * @return string 프로젝트 타입에 대응하는 문자열
     */
    public static function getProjectTypes($types) {
        // 리턴할 문자열
        $strWT = '';

        // 숫자형으로 변환한 프로젝트 타입
        $wtypes = (int) ('0' + $types);
        if(($wtypes & 1) == 1) {
            $strWT .= 'Project ';
        }
        if(($wtypes & 2) == 2) {
            $strWT = $strWT.'Promotion ';
        }
        if(($wtypes & 4) == 4) {
            $strWT = $strWT.'UX/UI ';
        }
        if(($wtypes & 8) == 8) {
            $strWT = $strWT.'Mobile ';
        }
        if(($wtypes & 16) == 16) {
            $strWT = $strWT.'Proposal ';
        }
        if(($wtypes & 32) == 32) {
            $strWT = $strWT.'Consulting ';
        }
        if(($wtypes & 64) == 64) {
            $strWT = $strWT.'AD ';
        }

        return $strWT;
    }

    /**
     * 구인유형 문자열을 얻는다.
     * @param $cd 구인유형
     * @return string 구인유형 코드에 대응하는 문자열
     */
    public static function getHireTypes($cd) {
        $strHT = '';

        if($cd == 'RG') {
            $strHT = '정규직';
        } else if($cd == 'PT') {
            $strHT = '계약직';
        } else if($cd == 'IT') {
            $strHT = '인턴';
        } else if($cd == 'SD') {
            $strHT = '파견';
        } else if($cd == 'AB') {
            $strHT = '아르바이트';
        } else if($cd == 'NG') {
            $strHT = '협의';
        } else {
            $strHT = '';
        }
        return $strHT;
    }

    /**
     * 구인분야 문자열을 얻는다.
     * @param $cd 구인분야
     * @return string 구인분야 코드에 대응하는 문자열
     */
    public static function getHirePart($cd) {
        $strHP = '';

        if($cd == 'PL') {
            $strHP = '기획실';
        } else if($cd == 'DN') {
            $strHP = '디자인실';
        } else if($cd == 'PB') {
            $strHP = '퍼블리싱팀';
        } else if($cd == 'MN') {
            $strHP = '경영지원팀';
        } else {
            $strHP = '';
        }
        return $strHP;
    }

    /**
     * 직급 문자열을 얻는다.
     * @param $cd 직급
     * @return string 직급 코드에 대응하는 문자열
     */
    public static function getPosition($cd) {
        $strHT = '';

        if($cd == 'CO') {
            $strHT = '임원';
        } else if($cd == 'TO') {
            $strHT = '실장';
        } else if($cd == 'TM') {
            $strHT = '팀장';
        } else if($cd == 'PK') {
            $strHT = '과장';
        } else if($cd == 'PD') {
            $strHT = '대리';
        } else if($cd == 'PJ') {
            $strHT = '주임';
        } else if($cd == 'PS') {
            $strHT = '사원';
        } else if($cd == 'NG') {
            $strHT = '협의';
        } else {
            $strHT = '';
        }
        return $strHT;
    }

    /**
     * 경력 문자열을 얻는다.
     * @param $cd 경력
     * @return string 경력 코드에 대응하는 문자열
     */
    public static function getCareerTypes($cd) {
        $strCT = '';

        if($cd == 'Y') {
            $strCT = '경력';
        } else if($cd == 'N') {
            $strCT = '신입';
        } else {
            $strCT = '';
        }
        return $strCT;
    }

    /**
     * 학력 문자열을 얻는다.
     * @param $cd 학력
     * @return string 학력 코드에 대응하는 문자열
     */
    public static function getSchoolTypes($cd) {
        $strST = '';

        if($cd == 'UV') {
            $strST = '대졸 이상';
        } else if($cd == 'CL') {
            $strST = '전문대졸 이상';
        } else if($cd == 'HS') {
            $strST = '고졸 이상';
        } else if($cd == 'NG') {
            $strST = '무관';
        } else if($cd == 'EC') {
            $strST = '기타';
        } else {
            $strST = '';
        }

        return $strST;
    }

    /**
     * 성별 문자열을 얻는다.
     * @param $cd 성별
     * @return string 성별 코드에 대응하는 문자열
     */
    public static function getGender($cd) {
        $strG = '';

        if($cd == 'ML') {
            $strG = '남자';
        } else if($cd == 'FL') {
            $strG = '여자';
        } else if($cd == 'NG') {
            $strG = '무관';
        } else {
            $strG = '';
        }

        return $strG;
    }

    /**
     * 지원상태 문자열을 얻는다.
     * @param $cd 지원상태
     * @return string 지원상태 코드에 대응하는 문자열
     */
    public static function getRecruitStatus($cd) {
        $strRS = '';

        if($cd == 'A') {
            $strRS = '접수';
        } else if($cd == 'B') {
            $strRS = '심사중';
        } else if($cd == 'C') {
            $strRS = '합격';
        } else if($cd == 'D') {
            $strRS = '불합격';
        } else {
            $strRS = '';
        }

        return $strRS;
    }

    /**
     * 경력결과 문자열을 얻는다.
     * @param $cd 경력결과
     * @return string 경력결과 코드에 대응하는 문자열
     */
    public static function getRecruitStatusStyle($cd) {
        $strRS = '';

        if($cd == 'A') {
            $strRS = 'ready';
        } else if($cd == 'B') {
            $strRS = '';
        } else if($cd == 'C') {
            $strRS = 'pass';
        } else if($cd == 'D') {
            $strRS = 'fail';
        } else {
            $strRS = '';
        }

        return $strRS;
    }

    /**
     * 학력수준 문자열을 얻는다.
     * 유사한 메소드로 getSchoolTypes()가 있으나, 이 메소드는 Recruit에서만 사용
     * @param $cd 학력수준
     * @return string 학력수준 코드에 대응하는 문자열
     */
    public static function getSchoolTypes4Recruit($cd) {
        $strST = '';

        if($cd == 'UV') {
            $strST = '대졸';
        } else if($cd == 'CL') {
            $strST = '전문대졸';
        } else if($cd == 'HS') {
            $strST = '고졸';
        } else if($cd == 'NG') {
            $strST = '무관';
        } else if($cd == 'EC') {
            $strST = '기타';
        } else {
            $strST = '';
        }

        return $strST;
    }

}
