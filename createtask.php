<?php
include 'config.php';
include 'utils/mysql.class.php';
include_once 'libraries/TablePlaceholder.class.php';
include_once 'libraries/Tasks.class.php';
$data = $_GET;
$tasksClass = new Tasks();
$tpHoldersClass = new TablePlaceholders();
$tpHoldersClass->creatTask($data);
$tpholder = $tpHoldersClass->getTablePHolders($data["codeTT"]);
$data["taskId"] = $tpHoldersClass->getNewestTeskId($data["tableId"]);
foreach($tpholder as $key => $val)
{
	$data["TPHcode"] = $val["code"];
	$tpHoldersClass->CreatPlaceHolder($data);
}
include "controls/timetable/taskinfo.php";