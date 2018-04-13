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
	document.getElementById('heading').innerHTML = "Inbox";
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	document.getElementById('inbox').style.background = '#d5d7de';
	$('#rel').show()
	var action = "load";
	getResponse(action);	
}
function sentMails(){
	document.getElementById('heading').innerHTML = "Sent";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = '#d5d7de';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	$('#rel').hide()
	var action = "sentMails";
	getResponse(action);
}
function drafts(){
	document.getElementById('heading').innerHTML = "Drafts";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('draft').style.background = '#d5d7de';
	$('#rel').hide()
	var action = "drafts";
	getResponse(action);
}
function trash(){
	document.getElementById('heading').innerHTML = "Trash";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('trash').style.background = '#d5d7de';
	var action = "trash";
	$('#rel').hide()
	getResponse(action);
}
function send(){
	var count;
	var action = "send";
	var to = document.getElementById("inputEmail1").value;
	var multiple = to.split(",");
	console.log(multiple[0]);
	var bcc = document.getElementById("bcc").value;
	var subject = document.getElementById("subject").value;
	var body = document.getElementById("body").value;
	//if( document.getElementById("attach").files.length == 0)
		var attach = 0;
	//else
	//	var attach = 1;
	if(to == "")
		var draft = 1;
	else
		var draft = 0;
	for(count = 0; count < multiple.length; count++){
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "db.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("action=" + action + "&to=" + multiple[count] + "&bcc=" + bcc + "&subject=" + subject + "&body=" + body + "&attach=" + attach + "&draft=" + draft);
		
	}
}
function logout(){
	var action = "logout";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action);
	
}
function getMessage(t){
	var action= "getMessage";
	var l = t.rowIndex + 1;
	var id = document.getElementById('hide' + l).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&id=" + id);
	response = JSON.parse(xhttp.responseText);
	document.getElementById('subLabel').innerHTML = response[3];
	document.getElementById('from').innerHTML = response[2];
	document.forms['area']['msg'].value = response[4];
}
function unset(){
	document.getElementById("inputEmail1").value = "";
	document.getElementById("subject").value = "";
	document.getElementById("bcc").value = "";
	document.forms['compose']['msg'].value = "";
}
function generateTable(response){
	var today = new Date();
	var month = today.getMonth() + 1;
	if(month < 10)
		month = "0" + month;
	var currDate = today.getFullYear() + "-" + month + "-" + today.getDate();
	$('#table').html("");
	$('#table').append('<tbody>');
	$('#table').append('<tr data-toggle="modal"  data-target="#myModal1" onclick="getMessage(this)" id="row1"></tr>');
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
	      $('#table').append('<tr data-toggle="modal"  data-target="#myModal1" onclick="getMessage(this)" id="row'+(i+1)+'"></tr>');
	console.log(i);	      
	i++;
      }
	
	$('#table').append('</tbody>');
}
