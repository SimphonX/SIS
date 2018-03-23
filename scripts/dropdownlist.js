"use strict";
var contextMenuClassName = "drop-down-list";
var contextMenuActive = "drop-down-list--active";

function toggleMenu(ele) {
	menuState = ele;
	if ( menuState === 1 ) 
		menu.classList.add(contextMenuActive );
	if ( menuState === 0 ) 
		menu.classList.remove(contextMenuActive );
}
function contextListener() {
	document.addEventListener("contextmenu", function(e) {
		taskItemInContext = clickInsideElement(e, workClassName);
		workerElement = clickInsideElement(e, workerClassName);
		taskElement = clickInsideElement(e, taskClassName);
		if(taskItemInContext){
			e.preventDefault();
			toggleMenu(1);
			positionMenu(e);
		}else{
			taskItemInContext = null;
			toggleMenu(0);
		}
	});
}
