
function myFunction(name) {
	var myDropdown = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < myDropdown.length; i++) {
			if (myDropdown[i].classList.contains('show')) {
				myDropdown[i].classList.remove('show');
			}
		}
    document.getElementById(name).classList.toggle("show");
}

window.onclick = function(e) {
	if (event.target == infoPage) {
		infoPage.style.display = "none";
    }
	if(event.target == settings)
	{
		settings.style.display = "none";
	}
	if(event.target == infoPage)
	{
		var nodes = infoPage.getElementsByClassName("displayData")[0].getElementsByClassName("rows");
		console.log(nodes);
		Array.from(nodes).forEach(function(ele){ele.style.display = "none"});
		infoPage.style.display = "none";
	}
	if (!e.target.matches('.dropbtn')) {
		var myDropdown = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < myDropdown.length; i++) {
			if (myDropdown[i].classList.contains('show')) {
				myDropdown[i].classList.remove('show');
			}
		}
	}
}

var listClassName= "dropdown-list";
var listActive= "dropdown-list--active";
var dropdown;
var elemen;

function doubledClick(ele) {
	
	
	if(ele.getAttribute("contenteditable") == "false")
	{
		var els = document.getElementsByClassName(ele.className);
		Array.prototype.forEach.call(els, function(el){el.setAttribute("contenteditable", false);});
	}
	else
	{
		elemen=ele;
		if(ele.getAttribute("data-field-type") == "SELECT"){
			console.log(ele);
			var type = ele.dataset.type;
			var id = ele.parentElement.parentElement.parentElement.parentElement.parentElement.dataset.job;
			var ph = ele.dataset.ph;
			positionList(ph, id, type);
		}
	}
	ele.focus();
	ele.setAttribute("contenteditable", true);
}
function mouseOut(els){
	var table = document.getElementById("footer");
	var parentEl = els.parentElement.parentElement.parentElement.parentElement;
	var userId = els.parentElement.parentElement.parentElement.parentElement.parentElement.dataset.idUser;
	$.ajax({
		type: 'GET',
		url: "textedit.php",
		data:{
			"fieldType":els.dataset.ph,
			"userId":userId,
			"ctime":parentEl.dataset.ctime,
			"workerId":parentEl.dataset.id,
			"fieldFormat":els.dataset.fieldType,
			"timesId":els.dataset.timesId,
			"type":els.dataset.type,
			"id":els.dataset.id,
			"data":els.innerHTML
		},
		success: function (data) {
			//table.innerHTML +=data;
			if(data == "trim")
				els.style.color = "#0000ff";
			if(data == "false")
				els.style.color = "#ff0000";
			if(data == "")
			{
				if(els.getAttribute("data-type") == "wtime"){
				}
				els.style.color = "#000";
			}
		},
		error: function (xhr, status, error) {
			if (xhr.status > 0) alert('got error: ' + status);
		}
	});
	els.setAttribute("contenteditable", false);
}

function toggleDropdown(ele) {
	listState = ele;
	if ( listState === 1 ) 
		dropdown.classList.add(listActive );
	if ( listState === 0 ) 
		dropdown.classList.remove(listActive );
}

function positionList(ph, id, type){
	dropdown = document.getElementById(type+ph+id);
	console.log(type+ph+id);
	var rect = event.path[0].getBoundingClientRect();
	var min = event.path[6].getBoundingClientRect();
	dropdown.style.left = rect.x+"px";
	dropdown.style.top = rect.y-min.y+21+"px";
	dropdown.style.width = rect.width-10+"px";
	toggleDropdown(1);
}

var settings;
var closeButton;

function openSettings(type, bData){
	
	settings = document.getElementById(type);
	closeButton = document.getElementById("close"+type);
	settings.style.display="block";
	closeButton.onclick = function(){
		settings.style.display = "none";
	}
}


