<?php
include 'config.php';
include 'utils/mysql.class.php';
include_once 'libraries/TablePlaceholder.class.php';
$data = $_GET;
$tpHoldersClass = new TablePlaceholders();
$tpHoldersClass->deleteTask($data["taskId"]);