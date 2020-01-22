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
                    <a href="/articles/?id=' . $article["ID"] . '">Read more!</a>
                </div>
                ';
    }
    ?>
</div>