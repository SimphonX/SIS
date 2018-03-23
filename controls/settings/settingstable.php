<table >
	<tbody class="PlaceHolders">
		<tr>
			<?php
			$fields=[];
			$FieldsData= $settingsData[0];
			if(isset($FieldsData["code"]))
			{
				$fields[sizeof($fields)] = ["code", 0];
				echo "<th> Kodas(Unikalus) </th>";
			}
			if(isset($FieldsData["name"]))
			{
				$fields[sizeof($fields)] = ["name", 1];
				echo "<th> Pavadinimas </th>";
			}
			if(isset($FieldsData["meaning"]))
			{
				$fields[sizeof($fields)] = ["meaning", 1];
				echo "<th> Pavadinimas </th>";
			}
			if(isset($FieldsData["from_time"]))
			{
				$fields[sizeof($fields)] = ["from_time", 1];
				echo "<th> Darbo pradžia </th>";
			}
			if(isset($FieldsData["to_time"]))
			{
				$fields[sizeof($fields)] = ["to_time", 1 ];
				echo "<th> Darbo pabaiga </th>";
			}
			if(isset($FieldsData["type"]))
			{
				$fields[sizeof($fields)] = ["type", 1];
				echo "<th> tipas </th>";
			}
			var_dump($FieldsData);
			if(isset($FieldsData["daytime"]))
			{
				$fields[sizeof($fields)] = ["daytime", 1];
				echo "<th> tipas </th>";
			}
			?>
			<th>
				Veiksmai
			</th>
		</tr>
		<?php
		foreach($settingsData as $keyTypes => $typesValues)
		{
			echo "<tr data-id='".(isset($typesValues["id"])?$typesValues["id"]:$typesValues["code"])."' ondblclick='moreData(this);' ".(isset($typesValues["required"])?($typesValues["required"]?"":"style='background-color: #ccc;'"):"");
			foreach($typesValues as $keyFieldData => $valFieldData)
				echo "data-".$keyFieldData."='".mysql::escape($valFieldData)."' ";
			echo " >";
			foreach($fields as $keyFieldList => $valFieldList)
				echo "<td> ".$typesValues[$valFieldList[0]]."</td>";
			echo "<td>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);'  ".(isset($typesValues["required"])&&$typesValues["required"]?"style='display: none;'":"")." id='deleteGR'>close</button>".
				 "<button class='material-icons md-18' onclick='buttonClick(this);' ".(isset($typesValues["required"])?"":"style='display: none;'")."id='activeGR'>".(isset($typesValues["required"])?"close":"restore")."</button>".
				 "</td>";
			echo "</tr>\n";
		}
		echo "<tr >";
		foreach($fields as $keyFieldData => $valFieldData)
			echo "<td data> </td>";
		
		echo "<td>".
			 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='deleteGR'>close</button>".
			 "<button class='material-icons md-18' onclick='buttonClick(this);' style='display: none;' id='activeGR'>remove</button>".
			 "<button class='material-icons md-18' onclick='buttonClick(this);' id='addGR'>add_circle_outline</button>".
			 "</td>";
		echo "</tr>";
		?>
	<tbody>
</table>