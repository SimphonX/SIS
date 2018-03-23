<?php 
include_once 'libraries/Timetable.class.php';
$tabletypes = new Timetable();
$types = $tabletypes->getTableTypes();
require_once 'controls/settings.php';
?>

<div class="navbar">
	<?php
	if(empty($types)) 
		echo "<a>Nėra grafikų</a>";
	else{
	?>
	<div class="dropdown">
		
		<button class="dropbtn" onclick="myFunction('Timetable')">Grafikai
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content" id="Timetable">
			<?php 
			foreach($types as $key => $value)
				if($value["active"] )
					echo "<a href='index.php?module=timetable&id={$value['code']}'> Grafikas:{$value['meaning']}</a>";
			?>
		</div>
	</div> 
	<?php }
	if(empty($types)) 
		echo "<a>Nėra grafikų</a>";
	else if(isset($_GET["id"])){
	?>
	<div class="dropdown">
		<a class="dropbtn" href='index.php?module=worktime&id=<?=$_GET["id"]?>'>Darbo valandos</a>
	</div> 
	<?php }?>
	<div class="dropdown">
		
		<button class="dropbtn" onclick="myFunction('Settings')">Administratorius
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content" id="Settings">
			<a onclick="openSettings('timetableTypes')"> Grafikų tipai </a>
			<?php if(isset($_GET["id"])){?>
			<a onclick="openSettings('timetableSettings')"> Grafiko nustatymai </a>
			<?php }?>
		</div>
	</div> 
</div>