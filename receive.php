<?php
include 'config.php';
include 'utils/mysql.class.php';
include_once 'libraries/Timetable.class.php';
var_dump($_GET);
$timetable = new Timetable();
if($_GET["type"] === "worker")
	$timetable->updateTableData($_GET);
if($_GET["type"] === "task")
{
	isset($_GET["tableId"])?$timetable->updateTaskData($_GET): $timetable->updateOrderOfTasks($_GET);
}
