function checkUsername(inputX){
	var inputX = document.getElementById("username");
	//console.log(inputX);
	var test = inputX.value;
	if(test.length <= 0){
		//alert("Cannot leave it as blank.");
		document.getElementById("usernameER").innerHTML = "Can't leave it as blank";
		inputX.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none'; 
	}
	if (inputX.value.length <4 || inputX.value.length >= 10) {
		document.getElementById("usernameER").innerHTML = "(4-10 Characters)";
		inputX.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none'; 
	}
	else {
		document.getElementById('subReg').style.display = 'block';
		document.getElementById("usernameER").innerHTML = "";
		inputX.style.backgroundColor="#FFF5A1";
	}
}

function checkFirstname(inputX){
	var inputX = document.getElementById("fname");
	var word =  /^[A-Za-z]+$/;
	var test = inputX.value;
	if(test.length <3 || test.length >= 20) {
		if(inputX.value.match(word)){
			document.getElementById("fnameER").innerHTML = "(4-20 Characters)";
			inputX.style.background="red";
			document.getElementById('subReg').style.display = 'none';
		}
		else{
			document.getElementById("fnameER").innerHTML = "Alphabet only!!";
			inputX.style.background="red";
			document.getElementById('subReg').style.display = 'none';
		}
	}
	else if(test.length >3 || test.length <=20 ){
		if(inputX.value.match(word)){
			document.getElementById("fnameER").innerHTML = "";
			inputX.style.background="#FFF5A1";	
			document.getElementById('subReg').style.display = 'block';
		}
		else{
			document.getElementById("fnameER").innerHTML = "Alphabet only!!";
			inputX.style.background="red";
			document.getElementById('subReg').style.display = 'none';
		}
	}
}

function checkLastname(inputX){
	var inputX = document.getElementById("lname");
	var word =  /^[A-Za-z]+$/;
	var test = inputX.value;
	if(test.length <= 0){
		alert("Cannot leave it as blank.");
		document.getElementById("lnameER").innerHTML = "Can't leave it as blank";
		inputX.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none';
	}
	else if(test.length <3 || test.length >= 20) {
		if(inputX.value.match(word)){
			document.getElementById("lnameER").innerHTML = "(4-20 Characters)";
			inputX.style.background="red";
			document.getElementById('subReg').style.display = 'none';
		}
		else{
			document.getElementById("lnameER").innerHTML = "Alphabet only!!";
			inputX.style.background="red";
			document.getElementById('subReg').style.display = 'none';
		}
	}
	else if(test.length >3 || test.length <=20 ){
		if(inputX.value.match(word)){
			document.getElementById("lnameER").innerHTML = "";
			inputX.style.background="#FFF5A1";	
			document.getElementById('subReg').style.display = 'block';
		}
		else{
			document.getElementById("lnameER").innerHTML = "Alphabet only!!";
			inputX.style.background="red";
			document.getElementById('subReg').style.display = 'none';
		}
	}
}

function checkPassword(inputX){
	if(inputX.value.length<=0){
		alert("Cannot leave it as blank.");
		document.getElementById("passwordER").innerHTML = "Can't leave it as blank";
		inputX.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none';
	}
	else if (inputX.value.length <3 || inputX.value.length >= 10) {
		document.getElementById("passwordER").innerHTML = "(4-10 Characters)";
		inputX.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none';
	}
	else {
		document.getElementById("passwordER").innerHTML = "";
		inputX.style.backgroundColor="#FFF5A1";
		document.getElementById('subReg').style.display = 'block';
	}
}
function checkConpassword(inputX){
	if(inputX.value.length<=0){
		alert("Cannot leave it as blank.");
		document.getElementById("passwordER").innerHTML = "Can't leave it as blank";
		inputX.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none';
	}
	else{
		if ((document.getElementById("password").value)!=(document.getElementById("conpassword").value)) {
			document.getElementById("conpasswordER").innerHTML = "(incorrect!)";
			inputX.style.backgroundColor="red";
			document.getElementById('subReg').style.display = 'none';
		}
		else {
			inputX.style.backgroundColor="#FFF5A1";
			document.getElementById("conpasswordER").innerHTML = "";
			document.getElementById('subReg').style.display = 'block';
		}
	}
}

function checkEmail(inputE){
	var add = inputE.value.indexOf("@");
	var point = inputE.value.lastIndexOf(".");
	if(inputE.value.length<=0){
		alert("Cannot leave it as blank.");
		document.getElementById("emailER").innerHTML = "Can't leave it as blank";
		inputE.style.backgroundColor="red";
		document.getElementById('subReg').style.display = 'none';
	}
	else if(add<1 || point<(add+2)){
		if(inputE.value.length > 0){
			document.getElementById("emailER").innerHTML = "(INVALID EMAIL!)";
			inputE.style.backgroundColor = "red";
			document.getElementById('subReg').style.display = 'none';
		}
	}
	else {
		inputE.style.backgroundColor = "#FFF5A1";
		document.getElementById("emailER").innerHTML = "";
		document.getElementById('subReg').style.display = 'block';
	}
}