<?php
if(!isset($_GET["id"])) die();
include_once 'libraries/TablePlaceholder.class.php';
include_once 'libraries/WorkerPlaceholder.class.php';
include_once 'libraries/Works.class.php';
include_once 'libraries/Tasks.class.php';
$data["codeTT"] = $_GET["id"];
$wpHolderClass = new WorkerPlaceholder();
$tpHoldersClass = new TablePlaceholders();
$jobsClass = new Works();
$tasksClass = new Tasks();
/*// sukuriame sutarčių klasės objektą
include 'libraries/contracts.class.php';
$contractsObj = new contracts();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(NUMBER_OF_ROWS_IN_PAGE);

if(!empty($removeId)) {
	// pašaliname užsakytas paslaugas
	$contractsObj->deleteOrderedServices($removeId);

	// šaliname sutartį
	$contractsObj->deleteContract($removeId);

	// nukreipiame į sutarčių puslapį
	header("Location: index.php?module={$module}");
	die();
}*/

$wpholder = $wpHolderClass->getWorkerPHolders($data["codeTT"]);
$tpholder = $tpHoldersClass->getTablePHolders($data["codeTT"]);
$jobs = $jobsClass->getWorks($data["codeTT"]);
?>
<header>
	<link rel="stylesheet" type="text/css" href="style/timetable.css?v=<?=time();?>" media="screen" />
	<script type="text/javascript" src="scripts/timetable.js?v=<?=time();?>"></script>
</header>

<?php include "controls/menu.php";?>


<div class="float-clear"></div>
<?php 

$period = new DatePeriod(
	new DateTime(date('y-m-d')),
	new DateInterval('P1D'),
	new DateTime(Date('y-m-d', strtotime("+10 days")))
);
?>
<tr id="clonable">
<?php
foreach($tpholder as $key1 => $val1)
{
	echo "<td class='editable-cell' onclick='doubledClick(this);' contenteditable='false' col-index='{$key1}'  oldVal =''>";
	echo "</td>";
}
?>
</tr>
<div class="timetable">
	<table> 
	<tbody>
		<tr>
			<th class="thnames">
				Data
			</th>
			<?php
			foreach($period as $key => $val)
			{
				echo "<td><table class='worktask'><tr><td>";
				if(strftime("%A", $val->getTimestamp()) == "Monday") echo "Pirmadienis ";
				if(strftime("%A", $val->getTimestamp()) == "Tuesday") echo "Antradienis ";
				if(strftime("%A", $val->getTimestamp()) == "Wednesday") echo "Trečiadienis ";
				if(strftime("%A", $val->getTimestamp()) == "Thursday") echo "Ketvirtadienis ";
				if(strftime("%A", $val->getTimestamp()) == "Friday") echo "Penktadienis ";
				if(strftime("%A", $val->getTimestamp()) == "Saturday") echo "Šeštadienis ";
				if(strftime("%A", $val->getTimestamp()) == "Sunday") echo "Sekmadienis ";
				echo "{$val->format("d")}d.";
				echo "</td></tr></table>";
				include "controls/timetable/workplaceholders.php";
				echo "</td>";

			}
			?>
		</tr>
		<?php
		foreach($jobs as $keyjob => $valjob){
			$data["codeJob"]=$valjob['code'];
		?>
		<tr class="workerstable" id="<?=$valjob['code']?>" >
			<th class="thnames">
				<?=$valjob["name"];
				include "controls/dropdownlistdata.php";?>
			</th>
			<?php 
			
			foreach($period as $key => $val)
			{
				$data["time"]=$val->format('Y-m-d');
				echo "<td class='{$valjob['code']} worker tableraw' id='{$valjob['code']}{$val->format('Y-m-d')}' data-date='{$val->format('Y-m-d')}' data-job='{$valjob['code']}' data-type='{$_GET["id"]}'>".
					 "<div></div>";
				$workingW = $wpHolderClass->getWorkersForDay($data);
				foreach($workingW as $workingWkey => $workingWval)
					include "controls/timetable/workinfo.php";
				echo "</td>";
			}?>
		</tr>
		<?php
		}
		?>
	</table>
	
</div>
