<?php
header('Content-Type: text/xml');

require_once('../classes/ConnectionFactory.php');
require_once('../classes/dao/WorkDaoImpl.php');
require_once('../classes/service/WorkServiceImpl.php');
require_once('../classes/domain/Work.php');

$conn = ConnectionFactory::create();
$workDaoImpl = new WorkDaoImpl();
$workServiceImpl = new WorkServiceImpl();
$workServiceImpl->setWorkDao($workDaoImpl);

// 파라미터 받기
$param_year = $_REQUEST['param_year'];
$param_cate = $_REQUEST['param_cate'];

$result = $workServiceImpl->lists4Work($conn, $param_year, $param_cate);
$sizeOfResult = count($result);

if($sizeOfResult > 0) {
    $str = '<?xml version="1.0" encoding="utf-8"?>';
    $str .= '<ipgroup>';

    for($x=0; $x < $sizeOfResult; $x++) {
        $workObj = $result[$x];

        $str .= '<work>';
        $str .= '<thumbnail type="'.$workObj->getThumbTypes().'">';
        $str .= '<title><![CDATA['.$workObj->getThumbTitle().']]></title>';
        $str .= '<subtitle><![CDATA['.$workObj->getThumbSubTitle().']]></subtitle>';
        $str .= '<open><![CDATA['.$workObj->getOpenDateStr().']]></open>';

        $arrFiles = $workObj->getArrAttaches();
        for($a=0; $a < count($arrFiles); $a++) {
            $aObj =  $arrFiles[$a];
            if($aObj->getStypes() == 'T1') {
                $str .= '<img_1><![CDATA[/uploaded/work/'.$aObj->getTransferFilename().']]></img_1>';
            }
            if($aObj->getStypes() == 'T2') {
                $str .= '<img_2><![CDATA[/uploaded/work/'.$aObj->getTransferFilename().']]></img_2>';
            }
        }

        $str .= '</thumbnail>';
        $str .= '<project>';
        $str .= '<name><![CDATA['.$workObj->getName().']]></name>';
        $str .= '<client><![CDATA['.$workObj->getClientName().']]></client>';


        // 시작일, 종료일
        $hipen = '';
        if($workObj->getStartDateStr() != '' && $workObj->getEndDateStr() != '') {
            $hipen = ' ~ ';
        } else if($workObj->getStartDateStr() == '' && $workObj->getEndDateStr() != '') {
            $hipen = ' ~ ';
        } else {
            $hipen = '';
        }

        $str .= '<period><![CDATA['.$workObj->getStartDateStr().$hipen.$workObj->getEndDateStr().']]></period>';
        $str .= '<link><![CDATA['.$workObj->getUrl().']]></link>';
        $str .= '<content><![CDATA['.nl2br($workObj->getDescriptions()).']]></content>';

        $arrFilesB = $workObj->getArrAttaches();
        for($b=0; $b < count($arrFilesB); $b++) {
            $bObj =  $arrFilesB[$b];
            if($bObj->getStypes() != 'T1' && $bObj->getStypes() != 'T2') {
                $str .= '<file><![CDATA[/uploaded/work/'.$bObj->getTransferFileName().']]></file>';
            }
        }

        $str .= '</project>';
        $str .= '</work>';

    }
    $str .= '</ipgroup>';
} else {
    $str = '<?xml version="1.0" encoding="utf-8"?>';
    $str .= '<ipgroup></ipgroup>';
}

echo $str;
?>