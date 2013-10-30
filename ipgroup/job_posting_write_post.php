<?php
/**
 * User: Hyoseok Kim (toriworks@gmail.com)
 * Date: 13. 10. 24.
 * Time: 오후 11:45
 */

require_once('../classes/ConnectionFactory.php');
require_once('../classes/domain/Jobs.php');
require_once('../classes/dao/JobsDaoImpl.php');
require_once('../classes/service/JobsServiceImpl.php');

$conn = ConnectionFactory::create();
$jobsDao = new JobsDaoImpl();
$jobsService = new JobsServiceImpl();
$jobsService->setJobsDao($jobsDao);

// Get parameters
$title = $_REQUEST['title'];

// 시작일 분해
$start_date = $_REQUEST['start_date'];
$start_date_m = ''; $start_date_y = ''; $start_date_d = '';
if($start_date != "") {
    $arrSD = explode('.', $start_date);
    $start_date_y = $arrSD[0];
    $start_date_m = $arrSD[1];
    $start_date_d = $arrSD[2];
}

// 종료일 분해
$end_date = $_REQUEST['end_date'];
$end_date_m = ''; $end_date_y = ''; $end_date_d = '';
if($end_date != "") {
    $arrED = explode('.', $start_date);
    $end_date_y = $arrED[0];
    $end_date_m = $arrED[1];
    $end_date_d = $arrED[2];
}

$is_always = $_REQUEST['is_always'];
$career_types = $_REQUEST['career_types'];
$career_years = $_REQUEST['career_years'];
$how_many = $_REQUEST['how_many'];
$hire_types = $_REQUEST['hire_types'];
$position = $_REQUEST['position'];
$gender = $_REQUEST['gender'];
$old_types = $_REQUEST['old_types'];
$how_old = $_REQUEST['how_old'];
$descriptions = $_REQUEST['descriptions'];
$add_descriptions = $_REQUEST['add_descriptions'];
$keeper_name = $_REQUEST['keeper_name'];
$keeper_contacts = $_REQUEST['keeper_contacts'];
$is_show = $_REQUEST['is_show'];

echo $title."<br>";
echo $start_date."<br>";
echo $end_date."<br>";
echo $is_always."<br>";
echo $career_types."<br>";
echo $career_years."<br>";  //
echo $how_many."<br>";
echo $hire_types."<br>";
echo $position."<br>";
echo $gender."<br>";
echo $old_types."<br>";
echo $how_old."<br>";    //
echo $descriptions."<br>";
echo $add_descriptions."<br>";
echo $keeper_name."<br>";
echo $keeper_contacts."<br>";
echo $is_show."<br>";

?>