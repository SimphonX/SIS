<?php
if(isset($period))
{
	$data["tableId"]=$workingWval['id'];
	$taskssize = $tasksClass->getTasks($data);
}
?>
<div class="workerInfo <?php if(!isset($period)) echo "ui-sortable-handle";?>" data-id="<?=$data["tableId"]?>">
	<table class="worktask info <?=$data["codeJob"]?>">
		<tr>
			<?php
			include "controls/timetable/workerinfo.php";
			?>
		</tr>
	</table>
	<table class="worktask todo">
		<tbody class="connectedSortable <?=$data["codeJob"]?>">
		<tr></tr>
			<?php
			if(isset($taskssize))
			foreach($taskssize as $taskSizekey => $taskSizekval)
			{
				$data["taskId"]=$taskSizekval['id'];
				include "controls/timetable/taskInfo.php";
			}
			?>
		</tbody>
	</table>
</div>
