
var currentUser;

function addUser(){
	var email = document.getElementById("email").value;
	var fname = document.getElementById("fname").value;
	var lname = document.getElementById("lname").value;
	var gender = document.getElementById("gender").value;
	var alt_email = document.getElementById("alt_email").value;
	var passwd = document.getElementById("passwd").value;
	var repasswd = document.getElementById("repasswd").value;
	if(areAllFieldsFilled(email, fname, gender, passwd, repasswd) == -1)
		return;
	if(errorHandler(email, fname, lname, gender, alt_email) == -1) {
		document.getElementById('err').innerHTML = "Enter correct Email Id";
		document.getElementById('signupalert').style.display = "block";
		return;
	}
	var action = 'adduser';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&email=" +
				email + "&fname=" + fname +"&lname=" + lname + "&gender=" + gender + "&alt_email=" + alt_email + "&passwd=" + passwd);
	
	console.log(xhttp.responseText);
	if(xhttp.responseText.indexOf("returned false") !== -1){
		document.getElementById('err').innerHTML = "Email id already exists!";
		document.getElementById('signupalert').style.display = "block";	
	}
	else{
	response = JSON.parse(xhttp.responseText);
		if(response["Success"] == "True") {
			currentUser = email;
			$("#signupbox").hide();
			$("#level2box").show();
		}
	}
}

function addLevel2(){
	var question = document.getElementById("select_question").value;
	var answer = document.getElementById("answer").value;
	$("#level2box").hide();
	$("#level3box").show();
	var action = 'addLevel2';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&currentUser=" + currentUser + "&question=" + question +"&answer=" + answer);
}
function addLevel3(){
	var action = 'addLevel3';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&currentUser=" + currentUser +"&string=" + generatedString);
	generatedString = "";
	
}
function checkLogin(){
	var email = document.getElementById("login-username").value;
	var passwd = document.getElementById("login-password").value;
	var action = 'checkLogin';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&email=" + email + "&passwd=" + passwd);
	response = JSON.parse(xhttp.responseText);
	if(response.length == 0) {
		document.getElementById('lerr').innerHTML = "Invalid username or password";
		document.getElementById('signupalert').style.display = "block";
		return;
	}
	currentUser = email;
	action = 'getQuestion';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&currentUser=" + currentUser);
	response = JSON.parse(xhttp.responseText);
	
	$("#loginbox").hide();
	$("#level2login").show();
	document.getElementById("questionCheck").value = response[0];
}
function checkLevel2(){
	var answer = document.getElementById("answer").value;	
	var action = 'checkLevel2';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&currentUser=" + currentUser + "&answer=" + answer);
	response = JSON.parse(xhttp.responseText);
	if(response.length == 0) {
		document.getElementById('l2err').innerHTML = "Enter correct answer";
		document.getElementById('level2alert').style.display = "block";
		return;
	}
	$("#level2login").hide();
	$("#level3login").show();
}
function checkLevel3(){
	var action = 'checkLevel3';
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "db.php", false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=" + action + "&currentUser=" + currentUser +"&string=" + generatedString);
	console.log(xhttp.responseText);
	response = JSON.parse(xhttp.responseText);
	
	if(response.length == 0) {
		document.getElementById('l3err').innerHTML = "Enter correct color pattern";
		document.getElementById('level3alert').style.display = "block";
		return;
	}
	generatedString = "";
}
var generatedString = "";
function generateString(string){
	generatedString = generatedString + string;
	console.log(generatedString)
}
function areAllFieldsFilled(email, fname, gender, passwd, repasswd) {
	if(email == "") {
		document.getElementById('err').innerHTML = "Enter Email Id";
		document.getElementById('signupalert').style.display = "block";
		return -1;
	}
	if(fname == "") {
		document.getElementById('err').innerHTML = "Enter your first name";
		document.getElementById('signupalert').style.display = "block";
		return -1;
	}
	if(gender == "") {
		document.getElementById('err').innerHTML = "Specify your gender";
		document.getElementById('signupalert').style.display = "block";
		return -1;
	}
	if(passwd == "") {
		document.getElementById('err').innerHTML = "Enter Password";
		document.getElementById('signupalert').style.display = "block";
		return -1;
	}
	if(repasswd == "") {
		document.getElementById('err').innerHTML = "Confirm password field can not be left empty";
		document.getElementById('signupalert').style.display = "block";
		return -1;
	}
}

function errorHandler(email, fname, lname, gender, alt_email) {
    return /^\"?[\w-_\.]*\"?@mailcart.000webhost\.com$/.test(email);        
}
function setUser(){
	document.getElementById('curr_user').innerHTML = user;
}
