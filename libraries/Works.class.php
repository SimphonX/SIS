<?php

class Works {

    public function __construct() {

    }
	
	public function getWorks($code){
		$query = "SELECT * FROM `gra_works` ".
				 "WHERE `gra_works`.`id_graphic`='{$code}' ".
				 "ORDER BY `gra_works`.`line_number` ASC";
		$data = mysql::select($query);

        return $data;
	}
}