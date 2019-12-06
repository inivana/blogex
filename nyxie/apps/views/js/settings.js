
let new_password="",password_repeated="";

function load(){
	
	let element = document.getElementsByName("new-password")[0]	;
	element.addEventListener("keyup",function(){
		if (/^\s+$/.test(new_password)) {return};
		if(event.key == "Backspace"){
			new_password = new_password.substr(0,new_password.length-1);
		}else{
			new_password = new_password+""+event.key;
		}
		if(checkPassword()){
			document.getElementById("change_password").disabled = false;
		}else{document.getElementById("change_password").disabled = true;}
	});
	element = document.getElementsByName("repeat-password")[0]	;
	element.addEventListener("keyup",function(){
		if (/^\s+$/.test(password_repeated)) {return};
		if(event.key == "Backspace"){
			password_repeated = password_repeated.substr(0,password_repeated.length-1);
		}else{
			password_repeated = password_repeated+""+event.key;
		}
		if(checkPassword()){
			document.getElementById("change_password").disabled = false;
		}else{
			document.getElementById("change_password").disabled = true;
		}
		
	});
}

function checkPassword(){
		if((password_repeated == new_password) && (new_password != "")){	
		console.log("X");
			return true;
			
		}else{
			return false;
		}
}

