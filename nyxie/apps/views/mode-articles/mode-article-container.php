<div id="articles-list">
    <?php
    foreach ($articles as $article) {
        echo '
                <div class="article">
                    <div class="article-title">' . $article["Title"] . '</div>
                        <div class="article-description">
                            <div class="article-date">' . $article["Date"] . '</div>
                        </div>
                    <div class="article-brief">' . $article["Content"] . '</div>
					<form action="/~s6/adminpanel/mode" method="GET">
					<input type="submit"  value="Edytuj artykul" />
					<input type="hidden" name="id" value="'.$article["ID"].'" />
					</form>
					<form action="/~s6/adminpanel/delete_article" method="POST">
					<input type="submit"  value="Usun artykul" />
					<input type="hidden" name="id" value="'.$article["ID"].'" />
					</form>
					<form action="/~s6/adminpanel/mode_comments" method="GET">
					<input type="submit"  value="Moderuj komentarze" />
					<input type="hidden" name="id" value="'.$article["ID"].'" />
					</form>
                </div>
                ';
    }
    ?>
</div>