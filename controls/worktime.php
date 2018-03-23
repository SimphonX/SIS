<header>
	<link rel="stylesheet" type="text/css" href="style/worktime.css?v=<?=time();?>" media="screen" />
	<script type="text/javascript" src="scripts/worktime.js?v=<?=time();?>"></script>
</header>

<?php include "controls/menu.php";?>
<?php
if(!isset($_GET["id"])) die();
include_once "libraries/WorkTime.class.php";
$data["codeTT"] = $_GET["id"];
$data["men"] = isset($_GET["men"])?$_GET["men"]:date("m");
$data["met"] = isset($_GET["met"])?$_GET["met"]:date("Y");
$workersClass = new WorkTime();
$alltime;
$workers = $workersClass->getWorkers($data);
$dates = $workersClass->getWorkTimes($data);
?>

<div class="float-clear"></div>


<div class="textas">
	Mėnesis:
</div>
<div class="header" data-code="<?=$data["codeTT"]?>">
	<div class="lable1">
		Datos pasirinkimas:
	</div>
	<div class="lable2">
		Metai:
	</div>
	<input class="menesis" id="met" type="number" name="metai" min="1950" max="2222" value="<?=$data["met"];?>" onclick="">

	<div class="lable2">
		Mėnesis:
	</div>
	<input class="menesis" id="men" type="number" name="menesis" min="1" max="12" value="<?=$data["men"] ;?>">
	<div class="lable3">
		<a href="#" class="context-menu__link">
			<i class="fa fa-edit"></i> Spausdinti   
		</a>
	</div>
	<div onclick="changeData(this)" class="lable2">
		<a class="context-menu__link">
			<i class="fa fa-edit"></i> Pakeisti   
		</a>
	</div>
	
</div>
<?php 
$d=cal_days_in_month(CAL_GREGORIAN,$data["men"],$data["met"]);
$width = 66.2/$d
?>
<br>
<table>
	<tr>
		<th class="worker"> </th>
		<td class="dtime"> </td>
		<?php
		for($i = 1; $i <= $d; $i++)
		{	
			echo "<td class='time' width='{$width}%'>{$i}</td>";
		}
		?>
		<td class="type">
		</td>
		<td class="alltime">
		Viso, val.
		</td>
	</tr>
	<?php
	foreach($workers as $workerkey => $workerval)
	{
		$data["userId"] = $workerval["id_user"];
	?>
	<tr data-id-user="<?=$data["userId"]?>">
		<th  class="worker"> <?php echo $workerval["last_name"]." ";
								   echo $workerval["middle_name"]!=""?$workerval["middle_name"]." ":"";
								   echo $workerval["first_name"]?> </th>
		<td class="dtime">
			<table class="worktask">
				<?php
				foreach($dates as $dateskey => $datesval)
				{
					echo "<tr class='stime'><td class='stime'>";
					echo $datesval["from_time"];
					echo "-";
					echo $datesval["to_time"];
					echo "</td></tr>";
				}
				?>
			</table>
		</td>
		<?php
		for($i = 1; $i <= $d; $i++)
		{	
			$data["day"]=$i;
			$timesWork = $workersClass->getWorkTime($data);
			$clock = array();
			
			if(isset($timesWork[0]))
				for($k = $timesWork[0]["start_time"]+1; $k != $timesWork[0]["end_time"]+1; $k++){
					$k==24?$k=0:"";
					foreach($dates as $datekey => $dateval){
						!isset($clock[$datekey])?$clock[$datekey]=0:"";
						if($dateval["from_time"]<$dateval["to_time"]||$k >= $dateval["from_time"])
							$dateval["from_time"]<$k&&$dateval["to_time"]>=$k?$clock[$datekey]++:"";
						if($dateval["from_time"]>$dateval["to_time"]&&$k <= $dateval["from_time"])
							$dateval["from_time"]>$k&&$dateval["to_time"]>=$k?$clock[$datekey]++:"";
					}
				}
			
			echo "<td class='time' data-ctime='".$data["met"]."-".$data["men"]."-".$i."'>";
			echo "<table class='worktask'>";
			foreach($dates as $datekey => $dateval)
			{
				$data["timesId"]=$dateval["id"];
				$timesSel = $workersClass->getPlaceHolderTime($data);
				echo "<tr class='stime'><td class='stime'";
				echo isset($timesSel[0]["placeholdr_data"])?"data-id='".$timesSel[0]["id"]."'":"";
				echo " data-times-id='{$data["timesId"]}' data-type='wtime' data-field-type='NUMBER'  onclick='doubledClick(this);' contenteditable='false' onfocusout='mouseOut(this);'>";
				echo isset($timesSel[0]["placeholdr_data"])?$timesSel[0]["placeholdr_data"]:"";
				echo isset($clock[$datekey])&&$clock[$datekey]>0?"(".$clock[$datekey].")":"";
				echo "</td></tr>";
				!isset($alltime[$dateval["daytime"]])?$alltime[$dateval["daytime"]]=0:"";
				if(isset($timesSel[0]["placeholdr_data"])&&$timesSel[0]["placeholdr_data"]!=="")
					$alltime[$dateval["daytime"]]+=$timesSel[0]["placeholdr_data"];
				else if(isset($clock[$datekey]))
					$alltime[$dateval["daytime"]]+=$clock[$datekey];
			}
			echo "</table>";
			echo "</td>";
		}
		?>
		<td class="type">
			<table class="worktask">
				<?php
				foreach($dates as $key => $val)
				{
					echo "<tr class='stime'><td class='stime'>";
					if($key-1 < 0 || $val["daytime"] != $dates[$key-1]["daytime"])
						echo $val["daytime"];
					else echo "&nbsp";
					echo "</td></tr>";
				}
				?>
			</table>
		</td>
		
		<td class="alltime">
			<table class="worktask">
				<?php
				foreach($dates as $key => $val)
				{
					echo "<tr class='stime'><td class='stime' id='{$data["userId"]}{$val["daytime"]}all'>";
					if($key-1 < 0 || $val["daytime"] != $dates[$key-1]["daytime"])
						echo $alltime[$val["daytime"]];
					else echo "&nbsp";
					echo "</td></tr>";
				}
				
				?>
			</table>
		</td>
	</tr>
	<?php 
		$alltime=array();
	}?>
</table>