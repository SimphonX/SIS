<?php
include 'config.php';
include 'utils/mysql.class.php';
include_once 'libraries/TablePlaceholder.class.php';
include_once 'libraries/WorkerPlaceholder.class.php';
$wpHolderClass = new WorkerPlaceholder();
$wpHolderClass->deleteWorkTime($_GET["tableId"]);