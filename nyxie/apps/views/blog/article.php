<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
	 <link rel="stylesheet" href="/nyxie/apps/views/blog/styles/article.css">
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
                            <div class="article-category">#' . $article["CategoryID"] . '</div>
                            <div class="article-date">' . $article["Date"] . '</div>
                        </div>
                    <div class="article-brief">' . $article["Content"] . '</div>
                 
                </div>
                ';?>
	</div>
	<div id ="write-comment-container">
	<form action="posts" method="POST">
	<textarea name="content"></textarea>
	<?php
		echo '<input type="hidden" name="id" value="'. $article["ID"] .'"/>';
	?>
	<input type="submit" id="post-comment" value="Opublikuj"/>
	

	
	</form>
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
                 
                </div>
                ';
			};
			?>
	</div>

    </div>
    <div id="menu">
        <ul id="menu-list">
            <?php
            foreach ($menu_links as $menu_link) {
                echo "<li><a href='" . $menu_link["href"] . "'>" . $menu_link["label"] . "</a></li>";
            }
            ?>
        </ul>
    </div>
</div>
</body>
</html>