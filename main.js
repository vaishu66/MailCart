var i =1;
function getResponse(action) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action);
	response = JSON.parse(xhttp.responseText);
	generateTable(response);
}
function inbox(){
	var action = "load";
	getResponse(action);	
}
function sentMails(){
	var action = "sentMails";
	getResponse(action);
}
function drafts(){
	var action = "drafts";
	getResponse(action);
}
function trash(){
	var action = "trash";
	getResponse(action);
}
function generateTable(response){
	var today = new Date();
	var month = today.getMonth() + 1;
	if(month < 10)
		month = "0" + month;
	var currDate = today.getFullYear() + "-" + month + "-" + today.getDate();
	$('#table').html("");
	$('#table').append('<tbody>');
	$('#table').append('<tr data-toggle="modal"  data-target="#" id="row1"></tr>');
	i = 1;	
	for(j in response){
		var hid =  response[j].id;
		$('#row'+i).html("<td><input type='hidden' id='hide" + i + "' value = '" + hid + "'></td><td class='inbox-small-cells'><input type='checkbox' class='mail-checkbox'></td><td class='inbox-small-cells'><i class='fa fa-star'></i></td><td class='view-message  dont-show'>" + response[j].from_name + 
	"</td><td class='view-message'>" + response[j].subject + "</td>");
		if(response[j].attach == 1){
			$('#row'+i).append("<td class='view-message  inbox-small-cells'><i class='fa fa-paperclip'></i></td>");
			
		}
		if(response[j].rec_date == currDate)
			$('#row'+i).append("<td class='view-message  inbox-small-cells'></td><td class='view-message  text-right'>" + response[j].rec_time + "</td>");		
		else 
			$('#row'+i).append("<td class='view-message  inbox-small-cells'></td><td class='view-message  text-right'>" + response[j].rec_date + "</td>");
	      $('#table').append('<tr data-toggle="modal"  data-target="#myModal1" id="row'+(i+1)+'"></tr>');
	i++;
      }
	
	$('#table').append('</tbody>');
}

