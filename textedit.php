<?php
include 'config.php';
include 'utils/mysql.class.php';
include_once 'libraries/TablePlaceholder.class.php';
include_once 'libraries/WorkerPlaceholder.class.php';
include_once 'libraries/WorkTime.class.php';
$data = $_GET;
$wpHolderClass = new WorkerPlaceholder();
$tpHoldersClass = new TablePlaceholders();
$workTimeClass = new WorkTime();
if(isset($data["fieldFormat"])&&$data["fieldFormat"] === "NUMBER")
{
	$priv = $data["data"];
	$data["data"] = preg_replace("/[^0-9]+/", "", $data["data"]);
	if($priv !== $data["data"]) echo "trim";
}
if($data["type"] === "worker")
{
	if(strpos($data["fieldType"],"WRKTM") !== false)
	{
		$data["data"] = preg_replace("/[^0-9-]+/", "", $data["data"]);
		$time= explode("-",$data["data"]);
		if(!isset($time[0])||$time[0]=='')
		{
			echo "false";
			die();
		}
		if(!isset($time[1])||$time[1]=='')
		{
			echo "false";
			die();
		}
		$wpHolderClass->editWorkTime($time[0], $time[1], $data["workerId"]);
	}
	strpos($data["fieldType"],"PAV") !== false&&isset($data["userId"])&&$data["userId"] != ""?$wpHolderClass->updateWorker($data):"";
	$wpHolderClass->editTextHolderText($data);
}
if($data["type"] === "task")
{
	$tpHoldersClass->editTextHolderText($data);
}
if($data["type"] === "wtime")
{
	!isset($data["id"])||$data["id"] === ""?$workTimeClass->setWorkTime($data):$workTimeClass->updateWorkTime($data);
}