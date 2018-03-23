<?php

class Timetable {

    public function __construct() {

    }

    public function getTableTypes() {
        $query = "SELECT * FROM `gra_graphic`";
        $data = mysql::select($query);

        return $data;
    }
	public function updateTableData($data){
        $query = "UPDATE `gra_work_time` ".
				 "SET `ctime`='{$data["time"]}' ".
				 "WHERE `gra_work_time`.`id`='{$data["tableId"]}'";
        mysql::query($query);
    }
	public function updateTaskData($data){
        $query = "UPDATE `gra_worker_task` ".
				 "SET `id_wtime`='{$data["tableId"]}' ".
				 "WHERE `id`='{$data["taskId"]}'";
        mysql::query($query);
    }
	public function updateOrderOfTasks($data){
		foreach($data["taskIds"] as $key => $val)
		{
			var_dump($key);
			$query = "UPDATE `gra_worker_task` ".
					 "SET `works_order`='{$key}' ".
					 "WHERE `id`='{$val}'";
			mysql::query($query);
		}
	}
	public function getQuery($query,$data)
	{
		$data = mysql::select(strtr($query, $data));
        return $data;
	}
}