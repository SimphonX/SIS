<?php

class WorkerPlaceholder {

    public function __construct() {

    }
	
	public function getWorkerPHolders($code){
		$query = "SELECT * FROM `gra_placeholders_worker`".
				 "WHERE `gra_placeholders_worker`.`id_graphic`='{$code}' ".
				 "ORDER BY `gra_placeholders_worker`.`ph_order` ASC";
		
		$data = mysql::select($query);

        return $data;
	}
	public function getWorkerPHData($data){
		$query = "SELECT `gra_placeholders_worker`.`ph_order`,`gra_worker_link_phworker`.`placeholder_data`, `gra_worker_link_phworker`.`id`".
				 "FROM `gra_placeholders_worker` ".
					"LEFT JOIN `gra_worker_link_phworker` ".
						"ON `gra_worker_link_phworker`.`code_phworker` = `gra_placeholders_worker`.`code` ".
					"LEFT JOIN `gra_work_time` ".
						"ON `gra_work_time`.`id` =`gra_worker_link_phworker`.`id_wtime` ".
				 "WHERE `gra_placeholders_worker`.`id_graphic`='{$data["codeTT"]}' ".
					"AND `gra_work_time`.`ctime`='{$data["time"]}' ".
					"AND `gra_work_time`.`id`='{$data["tableId"]}' ".
				 "ORDER BY `gra_placeholders_worker`.`ph_order` ASC";
		$data = mysql::select($query);

        return $data;
	}
	public function getWorkersForDay($data){
		$query = "SELECT `gra_work_time`.`id` ".
				 "FROM `gra_work_time` ".
				 "WHERE `gra_work_time`.`code_job`='{$data["codeJob"]}' ".
					"AND  `gra_work_time`.`id_graphic`='{$data["codeTT"]}' ".
					"AND `gra_work_time`.`ctime` = '{$data["time"]}' ".
				 "ORDER BY `gra_work_time`.`start_time`, `gra_work_time`.`end_time` ASC";
		$data = mysql::select($query);

        return $data;
	}
	public function createWorkTime($data){
		$query = "INSERT INTO ".
				 "`gra_work_time`(`ctime`, `id_graphic`, `code_job`) ".
				 "VALUES ('{$data["time"]}','{$data["codeTT"]}', '{$data["codeJob"]}')";
		mysql::query($query);
	}
	public function getNewestId($data){
		$query = "SELECT MAX(`gra_work_time`.`id`) as id ".
				 "FROM `gra_work_time` ".
				 "WHERE `gra_work_time`.`id_graphic`='{$data["codeTT"]}' ".
					"AND `gra_work_time`.`code_job`='{$data["codeJob"]}'";
		$data = mysql::select($query);
        return $data[0]["id"];
	}
	public function CreatPlaceHolder($data){
		$query = "INSERT ".
				 "INTO `gra_worker_link_phworker`(`placeholder_data`, `code_phworker`, `id_wtime`) ".
				 "VALUES ('','{$data["PHcode"]}','{$data["tableId"]}')";
		mysql::query($query);
	}
	public function deleteWorkTime($data){
		$query = "Delete wt, ph, wtask, tph ".
				 "FROM `gra_work_time` wt ".
					"LEFT JOIN `gra_worker_link_phworker` ph ".
						"ON wt.`id`=ph.`id_wtime` ".
					"LEFT JOIN `gra_worker_task` wtask ".
						"ON wtask.`id_wtime` =wt.`id` ".
					"LEFT JOIN `gra_wtask_link_phtable` tph ".
						"ON tph.`id_worker_task`=wtask.`id` ".
				 "WHERE wt.`id`='{$data}'";
		mysql::query($query);
	}
	public function editTextHolderText($data)
	{
		$query = "UPDATE `gra_worker_link_phworker` ".
				 "SET `placeholder_data`='{$data['data']}' ".
				 "WHERE `gra_worker_link_phworker`.`id`='{$data['id']}'";
		mysql::query($query);
	}
	public function editWorkTime($from, $to, $id)
	{
		$time = $to-$from;
		$query = "UPDATE `gra_work_time` ".
				 "SET `start_time`='{$from}',`end_time`='{$to}',`work_time`='{$time}' ".
				 "WHERE `id` = '{$id}'";
		mysql::query($query);
	}
	public function updateWorker($data)
	{
		$query = "UPDATE `gra_work_time` ".
				 "SET `id_user`='{$data["userId"]}' ".
				 "WHERE `gra_work_time`.`id`='{$data["workerId"]}'";
		echo $query;
		mysql::query($query);
	}
}
