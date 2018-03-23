function initilize()
{
	var $rows=$(".workerstable");
	$rows.each(function (i) {
		var id = $rows[i].getAttribute("id");
		$( "td.worker."+id ).sortable({
			click:"ignoreCase",
			connectWith: ".worker."+id,
			items: "> div:not(:first)",
			zIndex: 999990,
			receive: function(event, ui) {
				$.ajax({
					type: 'GET',
					url: "receive.php",
					data:{
						"time":ui["item"][0].parentElement.dataset.date,
						"tableId":ui["item"][0].dataset.id,
						"type":"worker"
					},
					error: function (xhr, status, error) {
						// executed if something went wrong during call
						if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
					}
				});
			}
		}).disableSelection();
		var $tabs=$('.worktask')
		$( "tbody.connectedSortable."+id ).sortable({
			connectWith: ".connectedSortable."+id,
			items: "> tr:not(:first)",
			
			zIndex: 999990,
			stop: function(event, ui){
				var ele = Array.from(ui["item"][0].parentElement.getElementsByClassName("tesklist ui-sortable-handle"));
				var array = [];
				var i = 0;
				ele.forEach(function (data, i)
					{
						array[i] = data.dataset.id;
					}
				);
				$.ajax({
					type: 'GET',
					url: "receive.php",
					data:{
						"taskIds":array,
						"order":"1",
						"type":"task"
					},
					error: function (xhr, status, error) {
						if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
					}
				});
			},
			receive: function(event, ui) {
				$.ajax({
					type: 'GET',
					url: "receive.php",
					data:{
						"tableId":ui["item"][0].parentElement.parentElement.parentElement.dataset.id,
						"taskId":ui["item"][0].dataset.id,
						"type":"task"
					},
					error: function (xhr, status, error) {
						// executed if something went wrong during call
						if (xhr.status > 0) alert('got error: ' + status); // status 0 - when load is interrupted
					}
				});
			}
		})
		.disableSelection();
	});
	
}
$(document).ready(function() {
    
	initilize();
});

