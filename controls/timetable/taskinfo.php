<tr class="tesklist" data-id="<?=$data["taskId"]?>" >
<?php
$task=$tasksClass->getTaskInfo($data);
foreach($tpholder as $keytph => $val1)
{
	echo "<td class='editable-cell task' data-ph='{$val1["code"]}' data-field-type='{$val1["type"]}' data-type='task' data-id='{$task[$keytph]['id']}' onclick='doubledClick(this);' contenteditable='false' col-index='{$keytph}' onfocusout='mouseOut(this);' >";
	echo $task[$keytph]["placeholder_data"];
	echo "</td>";
}
?>
</tr>