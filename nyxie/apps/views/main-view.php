<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 <script src="/nyxie/apps/views/js/main-view-script.js"></script> 
	 <script src="/nyxie/apps/views/left-menu/route-menu.js"></script> 
	 <link rel="stylesheet" href="/nyxie/apps/views/left-menu/left-menu.css">
    <link rel="stylesheet" href="/nyxie/apps/views/styles/main-view-style.css">
</head>

<body>

    <div id="left-menu">
		<?php include($menu_bar); ?>
    </div>

	HI
	<div id="content-container">
		<?php
		
		if(isset($title)){
			echo '$title';
		}else{
			echo 'nothing';
		}
		
		?>
		
		
		<form action="/adminpanel/index_get" method="GET">
			<input type="text" name="title"/>
			<input type="submit" value="OK"/>
		</form>
	</div>
	
</body>
</html>