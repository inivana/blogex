function route(){
	
	element =  event.target.id;
	
	switch(element){
		
		case "add":
		window.location.href = "/nyxie/apps/views/add-article.php";
		break;
		case "blogex":
		window.location.href = "/nyxie/apps/views/main-view.php";
		break;
		case "settings":
		window.location.href = "http://www.google.com";
		break;
		case "logout":
		window.location.href = "http://www.google.com";
		break;
		case "mode":
		window.location.href = "/nyxie/apps/views/mode.php";
		break;
	}
	
}