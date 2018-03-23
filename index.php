<?php
	// nuskaitome konfigūracijų failą
	include 'config.php';

	// iškvie�?iame prisijungimo prie duomenų bazės klasę
	include 'utils/mysql.class.php';
	
	// nustatome pasirinktą modulį
	$module = '';
	if(isset($_GET['module'])) {
		$module = mysql::escape($_GET['module']);
	}
	
	// jeigu pasirinktas elementas (sutartis, automobilis ir kt.), nustatome elemento id
	$id = '';
	if(isset($_GET['id'])) {
		$id = mysql::escape($_GET['id']);
	}
	
	// nustatome, ar kuriamas naujas elementas
	$action = '';
	if(isset($_GET['action'])) {
		$action = mysql::escape($_GET['action']);
	}
	
	// jeigu šalinamas elementas, nustatome šalinamo elemento id
	$removeId = 0;
	if(!empty($_GET['remove'])) {
		// paruošiame $_GET masyvo id reikšmę SQL užklausai
		$removeId = mysql::escape($_GET['remove']);
	}
		
	// nustatome elementų sąrašo puslapio numerį
	$pageId = 1;
	if(!empty($_GET['page'])) {
		$pageId = mysql::escape($_GET['page']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<title>Daigai-SIS</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" type="text/css" href="scripts/datetimepicker/jquery.datetimepicker.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style/main.css?v=<?=time();?>" media="screen" />
		<script type="text/javascript" src="scripts/jquery-3.3.1.js"></script>
		<script type="text/javascript" src="scripts/datetimepicker/jquery.datetimepicker.full.min.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
		<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
		<script type="text/javascript" src="scripts/gridviewscroll.js"></script>
		<link rel="stylesheet" type="text/css" href="style/menu.css?v=<?=time();?>" media="screen" />
		<script type="text/javascript" src="scripts/menu.js?v=<?=time();?>"></script>
		<link rel="stylesheet" type="text/css" href="style/settings.css?v=<?=time();?>" media="screen" />
		<script type="text/javascript" src="scripts/settings.js?v=<?=time();?>"></script>
	</head>
	<body>
		<div id="body">
			<div id="header">
				<h3 id="slogan"><a href="index.php">Daigai-SIS</a></h3>
			</div>
			<div id="content">
				<div id="topMenu">
					<ul class="float-left">
						<li><a href="index.php?module=menu" title="Grafikas"<?php if($module == 'timetable') { echo 'class="active"'; } ?>>Darbuotojų grafikas</a></li>
					</ul>
					<ul class="float-right">
						<li><a href="index.php?module=report" title="Ataskaitos"<?php if($module == 'report') { echo 'class="active"'; } ?>>Ataskaitos</a></li>
					</ul>
				</div>
				<div id="contentMain">
					<?php
						if(!empty($module)) {
							include "controls/{$module}.php";
						}
					?>
					<div class="float-clear"></div>
				</div>
			</div>
			<div id="footer">

			</div>
		</div>
		<?php include "controls/mousecontext.php";?>
	</body>
</html>
