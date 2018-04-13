var i =1;
var folder;
function getResponse(action) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action);
	response = JSON.parse(xhttp.responseText);
	generateTable(response);
}
function inbox(){
	folder="inbox";
	document.getElementById('heading').innerHTML = "Inbox";
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	document.getElementById('inbox').style.background = '#d5d7de';
	document.getElementById('contact').style.background = 'none';
	$('#rel').show()
	var action = "load";
	getResponse(action);	
}
function sentMails(){
	folder="sent";
	document.getElementById('heading').innerHTML = "Sent";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = '#d5d7de';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	document.getElementById('contact').style.background = 'none';
	$('#rel').hide()
	var action = "sentMails";
	getResponse(action);
}
function drafts(){
	folder="drafts";
	document.getElementById('heading').innerHTML = "Drafts";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('draft').style.background = '#d5d7de';
	document.getElementById('contact').style.background = 'none';
	$('#rel').hide()
	var action = "drafts";
	getResponse(action);
}
function trash(){
	folder="trash";
	document.getElementById('heading').innerHTML = "Trash";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('contact').style.background = 'none';
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
	var bcc = document.getElementById("bcc").value;
	var subject = document.getElementById("subject").value;
	var body = document.getElementById("body").value;
	var fileUpload = document.getElementById("fileToUpload");
	if(document.getElementById("fileToUpload").files.length == 0 )
		var attach = 0;
	else{
		attachFiles();		
		var attach = 1;
	}
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
	return true;
}
function attachFiles(){
	var action = "upload"; 
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "uploads.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action);
	console.log(xhttp.responseText);
	response = JSON.parse(xhttp.responseText);
	
}
function logout(){
	var action = "logout";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action);
	
}
var msg_id;
function getMessage(t){
	var action= "getMessage";
	var l = t.rowIndex + 1;
	msg_id = document.getElementById('hide' + l).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&id=" + msg_id);
	response = JSON.parse(xhttp.responseText);
	document.getElementById('subLabel').innerHTML = response[3];
	document.getElementById('from').innerHTML = response[2];
	document.forms['area']['msg'].value = response[4];
	if(response[5] == 0)
		$('#down').hide();
	else {
		$('#down').show();	
	}
		
}
function unset(){
	document.getElementById("inputEmail1").value = "";
	document.getElementById("subject").value = "";
	document.getElementById("bcc").value = "";
	document.forms['compose']['msg'].value = "";
}
function reply(){
	document.getElementById("inputEmail1").value = "";
	document.getElementById("subject").value = "";
	document.forms['compose']['msg'].value = "";
	document.getElementById("bcc").value = "";
	var to = document.getElementById('from').innerHTML;	
	var subject = document.getElementById('subLabel').innerHTML;
	$('#myModal').modal('show');
	document.getElementById("inputEmail1").value = to;
	document.getElementById("subject").value = "Re:" + " " + subject;
	
}
function forward(){
	document.getElementById("inputEmail1").value = "";
	document.getElementById("subject").value = "";
	document.forms['compose']['msg'].value = "";
	document.getElementById("bcc").value = "";
	var message = document.forms['area']['msg'].value;	
	var subject = document.getElementById('subLabel').innerHTML;
	$('#myModal').modal('show');
	document.forms['compose']['msg'].value = message;
	document.getElementById("subject").value = subject;
}
function deleteMail(){
	var action = "deleteMail";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&id=" + msg_id);
	if(folder=="inbox")
		inbox();
}
function addContact(){
	var action = "addContact";
	var contact_id = document.getElementById('g_contact').value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&contact_id=" + contact_id);
	document.getElementById('g_contact').value = "";
	alert("New contact saved");
}
function checkContact(){
	var action = "checkContact";
	var contact_id = document.getElementById('g_contact').value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&contact_id=" + contact_id);
	response = JSON.parse(xhttp.responseText);
	if(response.length != 0){
		alert("Contact already exists");
		document.getElementById('g_contact').value = "";
		return;	
	}
	else
		addContact();
}function displayContacts(){
	var action = "displayContacts"
	document.getElementById('heading').innerHTML = "Contacts";
	document.getElementById('inbox').style.background = 'none';
	document.getElementById('sentMail').style.background = 'none';
	document.getElementById('draft').style.background = 'none';
	document.getElementById('archive').style.background = 'none';
	document.getElementById('trash').style.background = 'none';
	document.getElementById('contact').style.background = '#d5d7de';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action);
	response = JSON.parse(xhttp.responseText);
	generateContacts(response);
}
var contactdisplay_id;
function setId(t){
	var action= "setId";
	document.getElementById("inputEmail1").value = "";
	document.getElementById("subject").value = "";
	document.forms['compose']['msg'].value = "";
	document.getElementById("bcc").value = "";
	var l = t.rowIndex + 1;
	contactdisplay_id = document.getElementById('hide' + l).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&id=" + contactdisplay_id);
	response = JSON.parse(xhttp.responseText);
	document.getElementById('inputEmail1').value = response[2];
}
function searchMail(){
	var action = "search_name";
	var val = document.getElementById('search-mail').value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&val=" + val + "&folder=" + folder);
	response = JSON.parse(xhttp.responseText);
	if(response.length == 0) {
		action = "search_subject";
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "db.php", false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("action=" + action + "&val=" + val + "&folder=" + folder);
		response = JSON.parse(xhttp.responseText);
		if(response.length == 0)
			alert("Mail not Found!");
		else
			generateTable(response);	
	}
	else
			generateTable(response);	
	
}
function generateContacts(response){
	$('#table').html("");
	$('#table').append('<tbody>');
	$('#table').append('<tr data-toggle="modal"  data-target="#myModal" onclick="setId(this)" id="row1"></tr>');
	i = 1;	
	for(j in response){
		var hid =  response[j].id;
		$('#row'+i).html("<td><input type='hidden' id='hide" + i + "' value = '" + hid + "'></td><td class='view-message  dont-show'>" + "rgrthtyh" + 
	"</td><td class='view-message'>" + response[j].contact_id + "</td>");
	      $('#table').append('<tr data-toggle="modal"  data-target="#myModal" onclick="setId(this)" id="row'+(i+1)+'"></tr>');
	    
	i++;
      }
	
	$('#table').append('</tbody>');
}
/*function getFile() {
	console.log("vaishnavi");
	var action = "getFile";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&id=" + msg_id);

}*/
function generateTable(response){
	var today = new Date();
	var month = today.getMonth() + 1;
	if(month < 10)
		month = "0" + month;
	var currDate = today.getFullYear() + "-" + month + "-" + today.getDate();
	$('#table').html("");
	$('#table').append('<tbody>');
	$('#table').append('<tr data-toggle="modal"  data-target="#myModal1" onclick="getMessage(this)" id="row1"></tr>');
	/*if(response[j].unread == 0) {		
			document.getElementById('row1').style.background = '#d5d7de';
			document.getElementById('row1').style.font-weight = 600;
		}*/
	i = 1;	
	for(j in response){
		var hid =  response[j].id;
		$('#row'+i).html("<td><input type='hidden' id='hide" + i + "' value = '" + hid + "'></td><td class='inbox-small-cells'><input type='checkbox' class='mail-checkbox'></td><td class='inbox-small-cells'><i class='fa fa-star'></i></td>");
	if(folder == 'sent')	
		$('#row'+i).append("<td class='view-message  dont-show'>hello</td><td class='view-message'>" + response[j].subject + "</td>");
	else	
		$('#row'+i).append("<td class='view-message  dont-show'>" + response[j].from_name + "</td><td class='view-message'>" + response[j].subject + "</td>");
		if(response[j].attach == 1){
			$('#row'+i).append("<td class='view-message  inbox-small-cells'><i class='fa fa-paperclip'></i></td>");
			
		}
		else{
			$('#row'+i).append("<td class='view-message  inbox-small-cells'><i></i></td>");
		}
		if(response[j].rec_date == currDate)
			$('#row'+i).append("<td class='view-message  inbox-small-cells'></td><td class='view-message  text-right'>" + response[j].rec_time + "</td>");		
		else 
			$('#row'+i).append("<td class='view-message  inbox-small-cells'></td><td class='view-message  text-right'>" + response[j].rec_date + "</td>");
	      $('#table').append('<tr data-toggle="modal"  data-target="#myModal1" onclick="getMessage(this)" id="row'+(i+1)+'"></tr>');
	    
	i++;
      }
	
	$('#table').append('</tbody>');
}
