
function route(){
	let url = "index/index?location=";
	element =  event.target.id;
	switch(element){
		
		case "add":
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", url+"add-article", false ); // false for synchronous request
			xmlHttp.send( null );
		break;
		case "blogex":
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", url+"main-view", false ); // false for synchronous request
			xmlHttp.send( null );
		break;
		case "settings":
		    var xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", url+"settings", false ); // false for synchronous request
			xmlHttp.send( null );

		break;
		case "logout":
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", url+"logout", false ); // false for synchronous request
			xmlHttp.send( null );
		break;
		case "mode":
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", url+"mode", false ); // false for synchronous request
			xmlHttp.send( null );
		break;
	}
	
}