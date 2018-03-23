function changeData(ele)
{
	var men = document.getElementById("men");
	var met = document.getElementById("met");
	console.log(ele.parentElement.childNodes);
	window.location.href = "index.php?module=worktime&id="+ele.parentElement.dataset.code+"&men="+men.value+"&met="+met.value;
}