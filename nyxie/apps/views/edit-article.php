<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 <script src="/nyxie/apps/views/js/add-article-script.js"></script> 
	 <script src="/nyxie/apps/views/left-menu/route-menu.js"></script> 
	 <link rel="stylesheet" href="/nyxie/apps/views/left-menu/left-menu.css">
     <link rel="stylesheet" href="/nyxie/apps/views/styles/add-article-style.css">
	 
</head>

<body onload="onload()">
    <div id="left-menu">
		<?php include($menu_bar); ?>
    </div>

	
	<div id="add-article-container">
	<form action="edit_article" method="POST">
	
	<?php
		echo '
		<div id="article-title-container">
		<span>Title:</span>
		<input type="text" name="title" id="title-field" value="'.$title.'"/>
		</div>
			<div id="article-image-container">
		</div>
		<div id="article-content-container">
		<textarea id="content" name="content" >'.$content.'
		</textarea>
		</div>
		<div id="article-tag-container">
		<input type="text" id="tag-field" readonly="true" name="tags" value="'.$tags.'"/>
		<input type="hidden" name="id" value="'.$id.'"/>
		<input type="text" id="tag-bef-field" value=""/>
		<input type="button" id="tag-button" onclick="add_tag()" value="Dodaj"/>
		</div>
	';
	?>
	<input type="submit" id="send-button" value="Wyslij"/>
	</form>
	</div>
	
</body>
</html>