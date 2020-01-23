<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
    <link rel="stylesheet" href="/~s6/nyxie/apps/views/blog/styles/article.css">
</head>

<body>

<div id="color-blocks">
    <div id="color-block-1" class="color-block"></div>
    <div id="color-block-2" class="color-block"></div>
    <div id="color-block-3" class="color-block"></div>
    <div id="color-block-4" class="color-block"></div>
    <div id="color-block-5" class="color-block"></div>
</div>

<div id="header">
    Blogex - Best Source of Information about Nothing!
</div>

<div id="main-container">

    <div id="content">
	<div id="article-content">
                <?php echo '
                <div class="article">
                    <div class="article-title">' . $article["Title"] . '</div>
                        <div class="article-description">
                            <div class="article-date">' . $article["Date"] . '</div>
                        </div>
                    <div class="article-brief">' . $article["Content"] . '</div>
                 
                </div>
                ';?>
	</div>

	<div id ="write-comment-container">
		<?php if(isset($permission) && $permission == 0){
		echo '	<form action="posts" method="POST">
	<textarea name="content"></textarea>
	<input type="hidden" name="id" value="'. $article["ID"] .'"/>
	<input type="submit" id="post-comment" value="Opublikuj"/>
	</form>';
	} else{
		echo 'Zablokowano mozliwosc dodawania komentarzy';
	}?>

	
	
	</div>
	
	<div id="post-content">
			<?php 
			foreach ($posts as $post){
				echo '
                <div class="post">
                    <div class="post-author">' . $post["user"] . '</div>
                        <div class="post-description">
                            <div class="post-date">' . $post["Date"] . '</div>
                        </div>
                    <div class="post-brief">' . $post["Content"] . '</div>
                 
                </div>
                ';
			};
			?>
	</div>

    </div>
    <div id="menu">
        <ul id="menu-list">
            <li><a href="/~s6/">Menu</a></li>
            <li><a href="/~s6/adminpanel">Admin Panel</a></li>
        </ul>
    </div>
</div>
</body>
</html>