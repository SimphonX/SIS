<?php

class WorkTime {

    public function __construct() {

    }
	
	public function getWorkers($data){
		$query = "SELECT `gra_user_link_works`.*, `go_users`.`first_name`, `go_users`.`middle_name`,`go_users`.`last_name` ".
				 "FROM `gra_user_link_works` ".
					"LEFT JOIN `gra_works` ".
						"ON `gra_works`.`code` = `gra_user_link_works`.`id_works` ".
					"LEFT JOIN `go_users` ".
						"ON `go_users`.`id` = `gra_user_link_works`.`id_user` ".
				 "WHERE `gra_works`.`id_graphic`='{$data["codeTT"]}' ".
				 "GROUP BY `go_users`.`id`";
		$data = mysql::select($query);

        return $data;
	}
	public function setWorkTime($data){
		$query = "INSERT INTO `gra_worker_link_timetable`".
					"(`id_user`, `ctime`, `placeholdr_data`, `id_timetable`) ".
				 "VALUES ('{$data["userId"]}','{$data["ctime"]}','{$data["data"]}','{$data["timesId"]}')";

		mysql::query($query);
	}
	public function updateWorkTime($data){
		if($data["data"] === "")
			$query = "DELETE ".
					 "FROM `gra_worker_link_timetable` ".
					 "WHERE `gra_worker_link_timetable`.`id`='{$data["id"]}'";
		else
			$query = "UPDATE `gra_worker_link_timetable` ".
					 "SET `placeholdr_data`='{$data["data"]}' ".
					 "WHERE `gra_worker_link_timetable`.`id`='{$data["id"]}'";
		mysql::query($query);
	}
	public function getWorkTimes($data){
		$query = "SELECT * ".
				 "FROM `gra_timetable` ".
				 "WHERE `gra_timetable`.`id_graphic`='{$data["codeTT"]}'";
		$data = mysql::select($query);

        return $data;
	}
	public function getPlaceHolderTime($data){
		$query = "SELECT `gra_worker_link_timetable`.`id`,`gra_worker_link_timetable`.`placeholdr_data`".
				 "FROM `gra_user_link_works` ".
					"RIGHT JOIN `gra_worker_link_timetable` ".
						"ON `gra_worker_link_timetable`.`id_user` = `gra_user_link_works`.`id_user` ".
					"LEFT JOIN `gra_works` ".
						"ON `gra_works`.`code`=`gra_user_link_works`.`id_works` ".
					"WHERE MONTH(`gra_worker_link_timetable`.`ctime`)='{$data["men"]}' ".
						"AND YEAR(`gra_worker_link_timetable`.`ctime`) = '{$data["met"]}' ".
						"AND Day(`gra_worker_link_timetable`.`ctime`) = '{$data["day"]}' ".
						"AND`gra_works`.`id_graphic`='{$data["codeTT"]}' ".
						"AND `gra_user_link_works`.`id_user`='{$data["userId"]}' ".
						"AND `gra_worker_link_timetable`.`id_timetable` = '{$data["timesId"]}' ".
					" GROUP BY `gra_worker_link_timetable`.`id`";
		$data = mysql::select($query);

        return $data;
	}
	public function getWorkTime($data){
		$query = "SELECT `gra_work_time`.`start_time`,`gra_work_time`.`end_time`, `gra_work_time`.`work_time` ".
				 "FROM `gra_work_time` ".
					"LEFT JOIN `gra_user_link_works` ".
						"ON `gra_user_link_works`.`id`=`gra_work_time`.`id_user` ".
					"LEFT JOIN `gra_works` ".
						"ON `gra_works`.`code` = `gra_user_link_works`.`id_works` ".
				 "WHERE MONTH(`gra_work_time`.`ctime`)='{$data["men"]}' ".
					"AND YEAR(`gra_work_time`.`ctime`) = '{$data["met"]}' ".
					"AND DAY(`gra_work_time`.`ctime`) = '{$data["day"]}' ".
					"AND`gra_works`.`id_graphic`='{$data["codeTT"]}' ".
					"AND `gra_user_link_works`.`id_user`='{$data["userId"]}' ".
				 "GROUP BY `gra_work_time`.`id`";
		$data = mysql::select($query);

        return $data;
	}
}
