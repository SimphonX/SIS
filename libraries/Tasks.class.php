<?php

class Tasks {

    public function __construct() {

    }
	
	public function getTasks($data){
		$query = "SELECT * ".
				 "FROM `gra_worker_task` ".
				 "WHERE `gra_worker_task`.`id_wtime` = '{$data["tableId"]}' ".
					"AND `gra_worker_task`.`id_work`='{$data["codeJob"]}' ".
				 "ORDER BY `gra_worker_task`.`works_order` ASC";
				 
		$data = mysql::select($query);

        return $data;
	}
	public function getTaskInfo($data){
		$query = "SELECT * ".
				 "FROM `gra_wtask_link_phtable` ".
					"LEFT JOIN `gra_placeholders_table` ".
						"ON `gra_placeholders_table`.`code` = `gra_wtask_link_phtable`.`code_phtable` ".
				 "WHERE `gra_wtask_link_phtable`.`id_worker_task`='{$data["taskId"]}' ".
					"AND `gra_placeholders_table`.`id_graphic`='{$data["codeTT"]}' ".
				 "ORDER BY `gra_placeholders_table`.`order_name` ASC";
		$data = mysql::select($query);

        return $data;
	}
}