<?php
include 'config.php';
include 'utils/mysql.class.php';
include_once 'libraries/TablePlaceholder.class.php';
include_once 'libraries/WorkerPlaceholder.class.php';
$data = $_GET;
$wpHolderClass = new WorkerPlaceholder();
$wpHolderClass->createWorkTime($data);
$data["tableId"]=$wpHolderClass->getNewestId($data);
$wpholder = $wpHolderClass->getWorkerPHolders($data["codeTT"]);

foreach($wpholder as $key => $val)
{
	$data["PHcode"] = $val["code"];
	$wpHolderClass->CreatPlaceHolder($data);
}
include "controls/timetable/workinfo.php";
