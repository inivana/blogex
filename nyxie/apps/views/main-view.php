<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 <script src="/nyxie/apps/views/js/main-view-script.js"></script> 
    <link rel="stylesheet" href="/nyxie/apps/views/styles/main-view-style.css">
</head>

<body onload="onload()">
    <div id="left-menu">
         
    </div>

	<form action="/nyxie/apps/views/nowy.php" method="POST">
	<div id="add-article-container">
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
	</div>
	</form>
</body>
</html>