<?php

class TablePlaceholders {

    public function __construct() {

    }
	
	public function getTablePHolders($code){
		$query = "SELECT * FROM `gra_placeholders_table`".
				 "WHERE `gra_placeholders_table`.`id_graphic` = '{$code}'".
				 "ORDER BY `gra_placeholders_table`.`order_name`ASC";
		$data = mysql::select($query);

        return $data;
	}
	public function creatTask($data)
	{
		$query = "SELECT MAX(`gra_worker_task`.`works_order`) as num ".
				 "FROM `gra_worker_task` ".
				 "WHERE `gra_worker_task`.`id_work`='{$data["codeJob"]}' ".
					"AND `gra_worker_task`.`id_wtime`='{$data["tableId"]}'";
		$orderNum = mysql::select($query)[0]["num"]!==null?mysql::select($query)[0]["num"]:0;
		$query = "INSERT ".
				 "INTO `gra_worker_task`(`id_work`, `id_wtime`, `works_order`) ".
				 "VALUES ('".mysql::escape($data['codeJob'])."','".mysql::escape($data['tableId'])."','".mysql::escape($orderNum)."{$orderNum}')";
		mysql::query($query);
	}
	public function getNewestTeskId($id)
	{
		$query = "SELECT MAX(`gra_worker_task`.`id`) as id ".
				 "FROM `gra_worker_task` ".
				 "WHERE `gra_worker_task`.`id_wtime`='{$id}'";
		$data = mysql::select($query)[0]["id"];

        return $data;
	}
	public function CreatPlaceHolder($data)
	{
		$query = "INSERT ".
				 "INTO `gra_wtask_link_phtable`( `placeholder_data`, `code_phtable`, `id_worker_task`) ".
				 "VALUES ('','{$data["TPHcode"]}','{$data["taskId"]}')";
		mysql::query($query);
	}
	
	public function deleteTask($data){
		$query = "DELETE wt, pht ".
				 "FROM `gra_worker_task` wt ".
					"LEFT JOIN `gra_wtask_link_phtable` pht ".
						"ON pht.`id_worker_task` = wt.`id` ".
				 "WHERE wt.`id`='{$data}'";
		mysql::query($query);
	}
	public function editTextHolderText($data)
	{
		$query = "UPDATE `gra_wtask_link_phtable` ".
				 "SET `placeholder_data`='".mysql::escape($data['data'])."' ".
				 "WHERE `gra_wtask_link_phtable`.`id`='{$data['id']}'";
		mysql::query($query);
	}
	public function edirWorkTime($data)
	{
		$query = "UPDATE `gra_wtask_link_phtable` ".
				 "SET `placeholder_data`='".mysql::escape($data['data'])."' ".
				 "WHERE `gra_wtask_link_phtable`.`id`='{$data['id']}'";
		mysql::query($query);
	}
		
	
}