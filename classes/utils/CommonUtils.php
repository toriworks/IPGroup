<?php
/**
 * User: CommonUtils (toriworks@gmail.com)
 * Date: 13. 10. 29
 * Time: 오후 7:48
 */

class CommonUtils {

    public static function getProjectTypes($types) {
// 유형선택을 문자열로 변경
        $wtypes = (int) $types;
        $strWT = '';

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
            $strWT = $strWT.'Offer ';
        }
        if(($wtypes & 32) == 32) {
            $strWT = $strWT.'Consulting ';
        }
        if(($wtypes & 64) == 64) {
            $strWT = $strWT.'AD ';
        }

        return $strWT;
    }

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
        } else {
            $strST = '';
        }

        return $strST;
    }

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

}
