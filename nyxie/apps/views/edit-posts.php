<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 
	 <script src="/nyxie/apps/views/left-menu/route-menu.js"></script> 
	 <link rel="stylesheet" href="/nyxie/apps/views/left-menu/left-menu.css">
	 <link rel="stylesheet" href="/nyxie/apps/views/styles/edit-posts.css">
</head>

<body >

    <div id="left-menu">
		<?php include($menu_bar); ?>
    </div>

	<div id="post-content">
			<?php 
			foreach ($posts as $post){
				echo '
                <div class="post">
                    <div class="post-author">' . $post["UserID"] . '</div>
                        <div class="post-description">
                            <div class="post-date">' . $post["Date"] . '</div>
                        </div>
                    <div class="post-brief">' . $post["Content"] . '</div>
					<form action="delete_post" method="POST">
					<input type="hidden" name="id" value="'. $post["ID"]. '"/>
					<input type="hidden" name="articleID" value="'. $post["ArticleID"]. '"/>
					<input type="submit" value="Usun post"/>
					</form>
                </div>
                ';
			};
			?>
	</div>
	
</body>
</html>