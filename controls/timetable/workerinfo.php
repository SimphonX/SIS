<?php
$worker = $wpHolderClass->getWorkerPHData($data);
foreach($wpholder as $keywph => $valwph)
{
	echo "<td class='editable-col workerinfo' data-ph='{$valwph["code"]}' data-field-type='{$valwph["type"]}' onclick='doubledClick(this);' onfocusout='mouseOut(this);' contenteditable='false' data-type='worker' data-id='{$worker[$keywph]['id']}'  col-index='{$keywph}'>".
		 "{$worker[$keywph]['placeholder_data']}".
		 "</td>";
}
?>