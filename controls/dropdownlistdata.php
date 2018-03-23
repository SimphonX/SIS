<div id="<?=$data["codeTT"]?>">
	<div class="worker">
	<?php 
	foreach($wpholder as $keyWPHO => $valWPHO)
	{
		if($valWPHO["type"] == "SELECT")
		{
			?>
			<div  class="dropdown-list" id="worker<?php echo $valWPHO["code"].$data["codeJob"] ?>">
			<?php
			$selectData = isset($valWPHO["SQL_code"])&& $valWPHO["SQL_code"]!==""?$tabletypes->getQuery($valWPHO["SQL_code"],$data):array();
			foreach($selectData as $keyData => $valData)
			{
			?>
			
			<div class="dropdown-list__link" data-id="<?php echo $valData["id"]?>" onclick="">
				<?php
				echo $valData["name"];
				//$valWPHO["code"]==="FL_PAV"?
				?>
			</div>
		
			<?php 
			}
			unset($selectData);
			echo "</div>";
		}
	}
	?>
	</div>
	<div class="task">
	<?php 
	foreach($tpholder as $keyTPHo => $valTPHo)
	{
		if($valTPHo["type"] == "SELECT")
		{
			
			?>
			<div  class="dropdown-list" id="task<?php echo $valTPHo["code"].$data["codeJob"] ?>">
			<?php
			$selectData = isset($valTPHo["SQL_code"])&& $valTPHo["SQL_code"]!==""?$tabletypes->getQuery($valTPHo["SQL_code"],$data):array();
			foreach($selectData as $keyData => $valData)
			{
			?>
			
			<div data-id="<?php echo $valData["id"]?>">
				<?php
				$valData["name"];
				//$valWPHO["code"]==="FL_PAV"?
				?>
			</div>
		
			<?php 
			}
			echo "</div>";
		}
	}
	?>
	</div>
</div>