var settingsData = null;
var infoPage = null;
function buttonClick(ele){
	var html = document.getElementById("footer");
	var eles = ele.parentElement.parentElement;
	var nodes = ele.parentElement.childNodes;
	if(ele.innerHTML==="remove")
	{
		eles.parentElement.removeChild(eles)
		return;
	}
	switch(ele.getAttribute("id"))
	{
		case "deleteGR":
			if (confirm("Ištrinti, bus pašalinti visi duomenys")) 
			{
				eles.parentElement.removeChild(eles);
			}
			break;
		case "editGR":
			setEdit(eles, "true");
			ele.style.display = "none";
			nodes[1].style.display = "none";
			nodes[4].style.display = "inline";
			nodes[3].style.display = "inline";
			break;
		case "saveGR":
			if(notEmty(eles))
				if (confirm("Išsaugoti pakeitimus")) 
				{
					setEdit(eles, "false");
					nodes[2].style.display = "inline";
					nodes[1].style.display = "inline";
					nodes[4].style.display = "none";
					nodes[1].innerHTML = "close";
					ele.style.display = "none";
				}
			break;
		case "cancelGR":
			nodes[1].style.display = "inline";
			nodes[2].style.display = "inline";
			nodes[4].style.display = "none";
			nodes[3].style.display = "none";
			restoreData(eles);
			break;
		case "activeGR":
			console.log(nodes);
			if(eles.style.backgroundColor !== "rgb(204, 204, 204)")
			{
				eles.style.backgroundColor = "rgb(204, 204, 204)";
				nodes[0].style.display = "inline";
				if(nodes.length > 3)
					nodes[2].style.display = "none";
				ele.innerHTML = "restore";
			}
			else 
			{
				eles.style.backgroundColor = "inherit";
				nodes[0].style.display = "none";
				if(nodes.length > 3)
					nodes[2].style.display = "inline";
				ele.innerHTML = "close";
			}
			break;
		case "addGR":
			eles.parentElement.appendChild(eles.cloneNode(true));
			console.log(nodes);
			setEdit(eles, "true");
			if(nodes.length > 3)
				nodes[3].style.display = "inline-block";
			nodes[1].style.display = "inline";
			ele.parentElement.removeChild(ele);
			break;
		default:
			alert("neteisinga komanda");
	}
}
function setEdit(eles, stat){
	Array.from(eles.getElementsByTagName("TD")).forEach(function(ele){
		console.log(ele);
		if(ele.hasAttribute("contenteditable"))
		{
			ele.setAttribute("oldvalue", ele.innerHTML);
			ele.setAttribute("contenteditable", stat);
		}
	});
}
function restoreData(eles)
{
	Array.from(eles.getElementsByTagName("TD")).forEach(function(ele){
		if(ele.hasAttribute("contenteditable"))
		{
			ele.innerHTML = ele.getAttribute("oldvalue");
			ele.setAttribute("contenteditable", "false");
		}
	});
}
function notEmty(eles){
	return Array.from(eles.getElementsByTagName("TD")).forEach(function(ele){
		ele.style.background = "inherit";
		if(ele.innerHTML.replace(/\s/g,'') === "")
		{
			ele.style.background = "rgb(255, 179, 179)";
			return false;
		}
	});
}

function getSettings(settingsId){
	if(settingsData !== null) settingsData.style.display = "none";
	settingsData = document.getElementById(settingsId);
	console.log(settingsData);
	settingsData.style.display = "initial";
}

function moreData(ele){
	infoPage = document.getElementById("informationWindow");
	Array.from(ele.attributes).forEach(function (data){
		
		var field = document.getElementById(data.name.split("-")[1]+"Field");
		if(field !== null) 
		{
			field.getElementsByClassName("field")[0].value = data.value;
			field.style.display = "initial";
		}
	});
	
	infoPage.style.display = "block";
	document.getElementById("closeinformationWindow").onclick = function(){
		var nodes = infoPage.getElementsByClassName("displayData")[0].getElementsByClassName("rows");
		console.log(nodes);
		Array.from(nodes).forEach(function(ele){ele.style.display = "none"});
		infoPage.style.display = "none";
	}
}

function initilizeSettings()
{
	$( "tbody.PlaceHolders" ).sortable({
		click:"ignoreCase",
		connectWith: ".PlaceHolders",
		items: "> tr:not(:first):not(:last)",
		zIndex: 999990,
		stop: function(event, ui){
			console.log(ui.item[0].parentElement.getElementsByClassName("ui-sortable-handle"));
			/*$.ajax({
				type: 'GET',
				url: "receive.php",
				data:{
					"time":ui["item"][0].parentElement.getAttribute("data-date"),
					"tableId":ui["item"][0].getAttribute("data-id"),
					"type":"worker"
				},
				error: function (xhr, status, error) {
					// executed if something went wrong during call
					if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
				}
			});*/
		}
	}).disableSelection();

	
}

$(document).ready(function() {
    
	initilizeSettings();
});