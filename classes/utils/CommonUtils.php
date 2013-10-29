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

}