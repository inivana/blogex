<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 <script src="/nyxie/apps/views/js/add-article-script.js"></script> 
	  <script src="/nyxie/apps/views/js/route-menu.js"></script> 
    <link rel="stylesheet" href="/nyxie/apps/views/styles/add-article-style.css">
</head>

<body onload="onload()">
    <div id="left-menu">
         <ul>
		 <li><input type="button" class="menu-button" id="blogex" onclick="route()" value="Blogex"/></li>
		 <li><input type="button" class="menu-button" id="add" onclick="route()" value="Dodaj Artykul"/></li>
		 <li><input type="button" class="menu-button" id="mode" onclick="route()" value="Moderuj"/></li>
		 <li><input type="button" class="menu-button" id="settings" onclick="route()" value="Ustawienia"/></li>
		 <li><input type="button" class="menu-button" id="logout" onclick="route()" value="Wyloguj sie"/></li>
		 </ul>
    </div>

	
	<div id="add-article-container">
	<form action="/nyxie/apps/views/nowyx.php" method="POST">
	<div id="article-title-container">
	<span>Title:</span>
	<input type="text" name="title" id="title-field" value=""/>
	</div>
		<div id="article-image-container">
	</div>
	<div id="article-content-container">
	<textarea id="content" name="content" value="">
	</textarea>
	</div>
	<div id="article-tag-container">
	<input type="text" id="tag-field" disabled="true" name="tags" value=""/>
	<input type="text" id="tag-bef-field" value=""/>
	<input type="button" id="tag-button" onclick="add_tag()" value="Dodaj"/>
	</div>
	<input type="submit" id="send-button" disabled="true" onclick="add_article()" value="Wyslij"/>
	</form>
	</div>
	
</body>
</html>