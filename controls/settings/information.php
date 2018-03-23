<div id="informationWindow" class="settingsWindow">
	<div class="row">
		<div class="tabs">
			<button class="tablinks" onclick="getSettings('InfoSettings')">Informacija</button>
			<?php
				echo "<button class='tablinks' onclick='getSettings('WorkersJobsSettings')'>Darbuotojiai</button>";
			?>
		</div>
		<div class="column">
			<span class="close material-icons" id="closeinformationWindow" >close</span>
		</div>
	</div>
	
	<div class="settingsContent">
		<div id="InfoSettings" >
			<form class="displayData">
				<div class="rows" id="codeField">
					<div class="col-25">
						<label class="name" for="PHcode">Kodas(Unikalus)</label>
					</div>
					<div class="col-75">
						<input class="field" type="text" id="PHcode" name="PHcode" placeholder="Lauko kodas" readonly>
					</div>
				</div>
				<div class="rows" id="from_timeField">
					<div class="col-25">
						<label class="name" for="PHfrom_time">Pradžios laikas</label>
					</div>
					<div class="col-75">
						<input class="field" type="text" id="PHfrom_time" name="PHfrom_time" placeholder="Pradžios laikas" readonly>
					</div>
				</div>
				<div class="rows" id="to_timeField">
					<div class="col-25">
						<label class="name" for="PHto_time">Pradžios laikas</label>
					</div>
					<div class="col-75">
						<input class="field" type="text" id="PHto_time" name="PHto_time" placeholder="Pabaigos laikas" readonly>
					</div>
				</div>
				<div class="rows" id="nameField">
					<div class="col-25">
						<label class="name" for="PHname">Pavadinimas</label>
					</div>
					<div class="col-75">
						<input class="field" type="text" id="PHname" name="PHname" placeholder="Lauko Pavadinimas" >
					</div>
				</div>
				<div class="rows" id="meaningField">
					<div class="col-25">
						<label class="name" for="PHmeaning">Informacija apie lauka</label>
					</div>
					<div class="col-75">
						<input class="field" type="text" id="PHmeaning" name="PHmeaning" placeholder="" >
					</div>
				</div>
				<div class="rows" id="requiredField">
					<div class="col-25">
						<label class="name" for="PHrequired">Privalo būti įvestas?</label>
					</div>
					<div class="col-75">
						<input  class="field" id="PHrequired" name="PHrequired" type="checkbox" checked>
						<label for="PHrequired" data-text-true="Taip" data-text-false="Ne"><i></i></label>
					</div>
				</div>
				<div class="rows" id="typeField">
					<div class="col-25">
						<label class="name" for="PHtype">Lauko tipas</label>
					</div>
					<div class="col-75">
						<select class="field" type="text" id="PHtype" name="PHtype" >
							<option value="SELECT">Parinkimo laukas</option>
							<option value="NUMBER">Skaičius</option>
							<option value="TEXT">Textas</option>
						</select>
					</div>
				</div>
				<div class="rows" id="daytimeField">
					<div class="col-25">
						<label class="name" for="PHdaytime">Lauko tipas</label>
					</div>
					<div class="col-75">
						<select class="field" type="text" id="PHdaytime" name="PHdaytime" >
							<option value="dien.">Dieninis</option>
							<option value="nakt.">Naktinis</option>
						</select>
					</div>
				</div>
				<div class="rows" id="sql_codeField">
					<div class="col-25">
						<label class="name" for="PHsql_code">SQL</label>
					</div>
					<div class="col-75">
						<textarea class="field" id="PHsql_code" name="PHsql_code" placeholder="SQL kodas" style="height:100px" ></textarea>
					</div>
				</div>
				<div class="rows" id="filterField">
					<div class="col-25">
						<label class="name" for="PHfilter">Filtras</label>
					</div>
					<div class="col-75">
						<textarea class="field" id="PHfilter" name="PHfilter" placeholder="Užduočių filtravimas" style="height:100px" ></textarea>
					</div>
				</div>
				<div class="rows" id="formulaField">
					<div class="col-25">
						<label class="name" for="PHformula">Formulė</label>
					</div>
					<div class="col-75">
						<textarea class="field" id="PHformula" name="PHformula" placeholder="Formulės" style="height:100px" ></textarea>
					</div>
				</div>
				<div class="rows" id="default_dataField">
					<div class="col-25">
						<label class="name" for="PHdefault_data">Numatyti duomenys</label>
					</div>
					<div class="col-75">
						<input class="field" type="text" id="PHdefault_data" name="PHdefault_data" placeholder="" >
					</div>
				</div>
			</form>
		</div>
		<div id = "WorkersJobsSettings">
		</div>
	</div>
</div>