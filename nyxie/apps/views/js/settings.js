
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
	

}
function checkPassword(){
		if((password_repeated == new_password) && (new_password != "")){	
			return true;
		}else{
			return false;
		}
}


