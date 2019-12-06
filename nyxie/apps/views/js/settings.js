
let new_password="",password_repeated="",new_email="";

function load(){
	
	let element = document.getElementsByName("new-password")[0];
	element.addEventListener("keyup",function(){
		if (/^\s+$/.test(new_password)) {return};
		new_password = event.target.value;
		if(checkPassword()){
			document.getElementById("change_password").disabled = false;
		}else{document.getElementById("change_password").disabled = true;}
	});
	element = document.getElementsByName("repeat-password")[0];
	element.addEventListener("keyup",function(){
		if (/^\s+$/.test(password_repeated)) {return};
		password_repeated = event.target.value;
		
		if(checkPassword()){
			document.getElementById("change_password").disabled = false;
		}else{
			document.getElementById("change_password").disabled = true;
		}
		
	});
	
	element = document.getElementsByName("new-email")[0];
		element.addEventListener("keyup",function(){
		if (/^\s+$/.test(new_email)) {return};
		new_email = event.target.value;
		
		if(checkEmail()){
			document.getElementById("change_email").disabled = false;
		}else{
			document.getElementById("change_email").disabled = true;
		}
	});
	
	element = document.getElementsByName("password")[0];
		element.addEventListener("keyup",function(){
		if(checkEmail()){
			document.getElementById("change_email").disabled = false;
		}else{
			document.getElementById("change_email").disabled = true;
		}
	});
}
function checkPassword(){
		if((password_repeated == new_password) && (new_password != "")){	
			return true;
		}else{
			return false;
		}
}
function checkEmail(){
	if (/^[a-z0-9 | \\. | \\-]+@([a-z0-9]+).[a-z]+$/.test(new_email) && 
	(document.getElementsByName("password")[0].value != "") && document.getElementsByName("password")[0].value.length > 3) {
		return true;}
	else {return false;}
}

