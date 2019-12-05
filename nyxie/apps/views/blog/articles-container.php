<div id="articles-list">
    <?php
    foreach ($articles as $article) {
        echo '
                <div class="article">
                    <div class="article-title">' . $article["title"] . '</div>
                        <div class="article-description">
                            <div class="article-category">#' . $article["category_id"] . '</div>
                            <div class="article-date">' . $article["date_created"] . '</div>
                        </div>
                    <div class="article-brief">' . $article["content"] . '</div>
                    <a href="/articles/?id=' . $article["id"] . '">Read more!</a>
                </div>
                ';
    }
    ?>
</div>