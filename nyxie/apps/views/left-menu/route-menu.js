
function route(){
	let url = "adminpanel/";
	let user_url = window.location.href
	let user_url_splited = window.location.href.split("adminpanel");
	
	element =  event.target.id;
	console.log(user_url_splited);
	switch(element){
		
		case "add":
		if(user_url.includes("add_article") || (user_url_splited[1] != "")){
			window.location.replace("add_article");
		}else{
			window.location.replace(url+"add_article");
		}
		
		break;
		case "blogex": 
		if(user_url_splited[1] != ""){
			window.location.replace("/~s6/");
		}	else{
			window.location.replace("/~s6/");
		}
		
		break;
		case "settings":
		if(user_url.includes("settings") || (user_url_splited[1] != "")){
			window.location.replace("settings");
		}else{
			window.location.replace(url+"settings");
		}
		break;
		case "logout":
		if(user_url.includes("logout") || (user_url_splited[1] != "")){
			window.location.replace("logout");
		}else{
			window.location.replace(url+"logout");
		}
		break;
		case "mode":
		if(user_url_splited[1] != ""){
			window.location.replace("./");
		}else{
			if(user_url_splited[1] == "/"){
				window.location.replace("/");
			}
			
		}
		break;
	}
	
}