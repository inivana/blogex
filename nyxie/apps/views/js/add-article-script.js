	
	let title = false;
	let content = false;
	let maximumTags = 4;
	let currentTags = 0;
	
	function onload(){
		document.getElementById("title-field").addEventListener("keyup",function(){
			title = document.getElementById("title-field").value;
			
			if(title == "" || content == ""){
				document.getElementById("send-button").disabled = true;
			}
			else{
				if(document.getElementById("send-button").disabled == true){
					document.getElementById("send-button").disabled = false;
				}
			}	
		});
		
		document.getElementById("content").addEventListener("keyup",function(){
			content = document.getElementById("content").value;
			if(title == "" || content == ""){
				document.getElementById("send-button").disabled = true;
			}
			else{
				if(document.getElementById("send-button").disabled == true){
					document.getElementById("send-button").disabled = false;
				}
			}	
		});
	}
	
	function add_article() {
		alert("");
	}
	

	function add_tag(){
		
		
		let elementTags = document.getElementById("tag-field");
		let elementTag = document.getElementById("tag-bef-field");
		
		let tag = elementTag.value;
		let tags  = elementTags.value;
		
		elementTags.value = tags + " #" + tag;
		elementTag.value = "";
		
		currentTags++;
		
		if(currentTags == maximumTags){
			document.getElementById("tag-button").disabled = true;
		}
	}