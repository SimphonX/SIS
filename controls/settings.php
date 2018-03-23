<?php
include_once 'libraries/TablePlaceholder.class.php';
include_once 'libraries/WorkerPlaceholder.class.php';
include_once 'libraries/Works.class.php';
include_once 'libraries/Tasks.class.php';
include_once "libraries/WorkTime.class.php";
$wpHolderClass = new WorkerPlaceholder();
$tpHoldersClass = new TablePlaceholders();
$jobsClass = new Works();
$workersClass = new WorkTime();
if(isset($_GET["id"]))
{
	$data["codeTT"] = $_GET["id"];
}

?>
<div id="timetableTypes" class="settingsWindow">
	<div class="row">
		<div class="column">
			<span class="close material-icons" id="closetimetableTypes" >close</span>
		</div>
	</div>
	<div class="settingsContent">
		<table>
			<tr>
				<th>
					Pavdinimas
				</th>
				<th>
					Kodas(Unikalus)
				</th>
				<th>
					Veiksmas
				</th>
			</tr>
			<?php
			foreach($types as $keyTypes => $typesValues)
			{
				echo "<tr ".($typesValues["active"]?"":"style='background-color: #ccc;'")." >";
				echo "<td contenteditable='false' data-required='0'> ".$typesValues["meaning"]."</td>";
				echo "<td > ".$typesValues["code"]."</td>";
				echo "<td>".
					 "<button class='material-icons md-18' onclick='buttonClick(this);'  ".($typesValues["active"]?"style='display: none;'":"")." id='deleteGR'>close</button>".
					 "<button class='material-icons md-18' onclick='buttonClick(this);' id='activeGR'>".($typesValues["active"]?"close":"restore")."</button>".
					 "<button class='material-icons md-18' onclick='buttonClick(this);' ".($typesValues["active"]?"":"style='display: none;'")." id='editGR'>mode_edit</button>".
					 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='saveGR'>check_circle</button>".
					 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='cancelGR'>backspace</button>".
					 "</td>";
				echo "</tr>\n";
			}
			echo "<tr>";
			echo "<td contenteditable='false' data-required='0'> </td>";
			echo "<td contenteditable='false' data-required='1'> </td>";
			echo "<td>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='deleteGR'>close</button>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='activeGR'>remove</button>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='editGR'>mode_edit</button>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='saveGR'>check_circle</button>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='cancelGR'>backspace</button>\n".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' id='addGR'>add_circle_outline</button>".
				 "</td>";
			echo "</tr>";
			?>
			
		</table>
	</div>
</div>
<?php 
if(isset($_GET["id"]) ){
?>
<div id="timetableSettings" class="settingsWindow">
	<div class="row">
		<div class="tabs">
			<button class="tablinks" onclick="getSettings('wPHSettings')">Darbuotojo laukai</button>
			<button class="tablinks" onclick="getSettings('tPHSettings')">Užduoties laukai</button>
			<button class="tablinks" onclick="getSettings('jobsSettings')">Užduoties laukai</button>
			<button class="tablinks" onclick="getSettings('workTimeSettings')">Numatyti darbai</button>
		</div>

		<div class="column">
			<span class="close material-icons" id="closetimetableSettings" >close</span>
		</div>
	</div>
	<div class="settingsContent">
		<div  id="wPHSettings" style='display: none;'>
			<?php
			$settingsData = $wpHolderClass->getWorkerPHolders($data["codeTT"]);
			include "controls/settings/settingstable.php";
			?>
		</div>
		<div id="tPHSettings" style='display: none;'>
			<?php
			$settingsData = $tpHoldersClass->getTablePHolders($data["codeTT"]);
			include "controls/settings/settingstable.php";
			?>
		</div>
		<div id="jobsSettings" style='display: none;'>
			<?php
			$settingsData = $jobsClass->getWorks($data["codeTT"]);
			include "controls/settings/settingstable.php";
			?>
		</div>
		<div id="workTimeSettings" style='display: none;'>
			<?php
			$settingsData = $workersClass->getWorkTimes($data);
			include "controls/settings/settingstable.php";
			?>
		</div>
	</div>
	
</div>
<?php include "controls/settings/information.php";?>
<?php } ?>