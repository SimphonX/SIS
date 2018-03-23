<table class = "worktask">
	<tr>
	<?php
	foreach($tpholder as $key => $val)
	{
		echo "<td>";
		echo $val["name"];
		echo "</td>";
	}
	?>
	</tr>
</table>