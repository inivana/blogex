<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
    <script src="/~s6/nyxie/apps/views/js/add-article-script.js"></script>
    <script src="/~s6/nyxie/apps/views/left-menu/route-menu.js"></script>
    <link rel="stylesheet" href="/~s6/nyxie/apps/views/left-menu/left-menu.css">
    <link rel="stylesheet" href="/~s6/nyxie/apps/views/styles/add-article-style.css">
	 
</head>

<body onload="onload()">
    <div id="left-menu">
		<?php include($menu_bar); ?>
    </div>

	
	<div id="add-article-container">
	<form action="add_article" method="POST">
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
	<input type="text" id="tag-field" readonly="true" name="tags" value=""/>
	<input type="text" id="tag-bef-field" value=""/>
	<input type="button" id="tag-button" onclick="add_tag()" value="Dodaj"/>
	</div>
	<input type="submit" id="send-button" disabled="true" value="Wyslij"/>
	</form>
	</div>
	
</body>
</html>