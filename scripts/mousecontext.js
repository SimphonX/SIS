"use strict";

var contextMenuClassName = "context-menu";
var contextMenuTaskClassName = "for-task";
var contextMenuItemClassName = "context-menu__item";
var contextDropboxLinkClassName = "dropdown-list__link";
var contextMenuLinkClassName = "context-menu__link";
var contextMenuActive = "context-menu--active";
var contextMenuTaskActive = "for-task--active";
var contextMenuWorkerActive = "for-worker--active";
var workClassName = "tableraw";
var workerClassName = "workerInfo";
var taskClassName = "tesklist";
var taskItemInContext;
var workerElement;
var taskElement

var clickCoords;
var clickCoordsX;
var clickCoordsY;

var menu = document.querySelector(".context-menu");
var menuItems = menu.querySelectorAll(".context-menu__item");
var worker = menu.querySelector(".for-worker");
var tasks = menu.querySelector(".for-task");
var menuState = 0;
var listState = 0;
var clickCount = 0;
var menuWidth;
var menuHeight;
var menuPosition;
var menuPositionX;
var menuPositionY;

var windowWidth;
var windowHeight;

function init()
{
	contextListener();
	clickListener();
	keyupListener();
	resizeListener();
}

function resizeListener() {
	window.onresize = function(e) {
		toggleMenu(0);
	};
}

function positionMenu(e, ele){
	clickCoords  = getPosition(e);
	clickCoordsX  = clickCoords.x;
	clickCoordsY  = clickCoords.y;
	
	menuWidth = ele.offsetWidth +4;
	menuHeight = ele.offsetHeight +4;
	
	windowWidth = window.innerWidth;
	windowHeight = window.innerHeight;
	
	if((windowWidth - clickCoordsX) < menuWidth){
		ele.style.left = windowWidth - menuWidth+"px";
	}else{
		ele.style.left = clickCoordsX+"px";
	}
	
	if((windowHeight - clickCoordsY) < menuHeight){
		ele.style.top = windowHeight - menuHeight+"px";
	}else{
		ele.style.top = clickCoordsY+"px";
	}
}

function contextListener() {
	document.addEventListener("contextmenu", function(e) {
		taskItemInContext = clickInsideElement(e, workClassName);
		workerElement = clickInsideElement(e, workerClassName);
		taskElement = clickInsideElement(e, taskClassName);
		if(taskItemInContext){
			e.preventDefault();
			toggleMenu(1);
			positionMenu(e, menu);
		}else{
			taskItemInContext = null;
			toggleMenu(0);
		}
	});
}

function clickListener() {
	document.addEventListener("click", function(e){
		var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );
		var clickeElIsData = clickInsideElement( e, contextDropboxLinkClassName );
		if( clickeElIsLink || clickeElIsData){
			e.preventDefault();
			clickeElIsLink?menuItemListener( clickeElIsLink ):listItemListener(clickeElIsData);
		}else{
			var button = e.which || e.button;
			if ( button === 1 ) {
				toggleMenu(0);
				if(listState === 1)
					clickCount++;
				if(clickCount===2)
				{
					clickCount=0;
					toggleDropdown(0);
				}
			}
		}
	});
}

function keyupListener() {
	window.onkeyup = function(e){
		if(e.keyCode === 27){
			toggleMenu(0);
			toggleDropdown(0);
		}
	}
}

function toggleMenu(ele) {
	menuState = ele;
	worker.classList.remove(contextMenuWorkerActive );
	tasks.classList.remove(contextMenuTaskActive );
	if ( menuState === 1 ) 
	{
		if(workerElement)
			worker.classList.add(contextMenuWorkerActive );
		if(taskElement)
			tasks.classList.add(contextMenuTaskActive );
		menu.classList.add(contextMenuActive );
	}
	
	if ( menuState === 0 ) 
	{
		menu.classList.remove(contextMenuActive );
	}
}

init();

function clickInsideElement( e, className ) {
	var el = e.srcElement || e.target;

	if ( el.classList.contains(className) ) {
		return el;
	} else {
		while ( el = el.parentNode ) {
			if ( el.classList && el.classList.contains(className) ) {
				return el;
			}
		}
	}

	return false;
}

function getPosition(e){
	var posx = 0;
	var posy = 0;
	
	if(!e) var e = window.event;
	
	if(e.posX || e.posY){
		posx = e.posX;
		posy = e.posY;
	}else if(e.clientX || e.clientY){
		posx = e.clientX + document.body.scrollLeft + 
                           document.documentElement.scrollLeft;
		posy = e.clientY + document.body.scrollTop + 
						   document.documentElement.scrollTop;
	}
	
	return {
		x:posx,
		y:posy
	}
}
function listItemListener( link ) {
	var table = document.getElementById("footer");
	var type = link.parentElement.parentElement.getAttribute("class");
	var parentEl = elemen.parentElement.parentElement.parentElement.parentElement;
	$.ajax({
		type: 'GET',
		url: "textedit.php",
		data:{
			"type":type,
			"userId":link.dataset.id,
			"workerId":parentEl.dataset.id,
			"fieldFormat":elemen.dataset.fieldYype,
			"data":link.innerHTML,
			"id":elemen.dataset.id,
			"fieldType":elemen.dataset.ph
		},
		success: function (data) {
			// this is executed when ajax call finished well
			table.innerHTML += data;
			elemen.innerHTML = link.innerHTML;
			initilize();
		},
		error: function (xhr, status, error) {
			// executed if something went wrong during call
			if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
		}
	});
	toggleDropdown(0);
}
function menuItemListener( link ) {
	if(link.dataset.action ==="new_worker")
		addNewWorker(taskItemInContext.getAttribute("id"))
	
	if(link.dataset.action ==="delete_worker")
		deleteWorkTime(taskItemInContext.getAttribute("id"));
	
	if(link.dataset.action ==="new_task")
		addNewTask();
	
	if(link.dataset.action ==="delete_task")
		deleteTask();
	
	toggleMenu(0);
}

function addNewWorker(id)
{
	var table = document.getElementById(id);
	$.ajax({
		type: 'GET',
		url: "workercreate.php",
		data:{
			"codeTT":taskItemInContext.dataset.type,
			"codeJob":taskItemInContext.dataset.job,
			"time":taskItemInContext.dataset.date
		},
		success: function (data) {
			// this is executed when ajax call finished well
			table.innerHTML += data;
			initilize();
		},
		error: function (xhr, status, error) {
			// executed if something went wrong during call
			if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
		}
	});
}
function addNewTask()
{
	$.ajax({
		type: 'GET',
		url: "createtask.php",
		data:{
			"tableId":workerElement.dataset.id,
			"codeTT":taskItemInContext.dataset.type,
			"codeJob":taskItemInContext.dataset.job,
			"time":taskItemInContext.dataset.date
		},
		success: function (data) {
			// this is executed when ajax call finished well
			workerElement.childNodes[3].childNodes[1].innerHTML += data;
		},
		error: function (xhr, status, error) {
			// executed if something went wrong during call
			if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
		}
	});
}
function deleteWorkTime(id){
	$.ajax({
		type: 'GET',
		url: "workerdelete.php",
		data:{
			"tableId":workerElement.dataset.id
		},
		error: function (xhr, status, error) {
			// executed if something went wrong during call
			if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
		}
	});
	workerElement.remove();
}
function deleteTask(){
	$.ajax({
		type: 'GET',
		url: "deletetask.php",
		data:{
			"taskId":taskElement.dataset.id
		},
		error: function (xhr, status, error) {
			// executed if something went wrong during call
			if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
		}
	});
	
	taskElement.remove();
}
