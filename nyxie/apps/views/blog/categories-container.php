<div id="articles-list">
    <?php
    foreach ($articles as $article) {
        echo '
                <div class="article">
                    <div class="article-title">' . $article["title"] . '</div>
                        <div class="article-description">
                            <div class="article-category">#' . $article["category"] . '</div>
                            <div class="article-date">' . $article["date"] . '</div>
                        </div>
                    <div class="article-brief">' . $article["brief"] . '</div>
                </div>
                ';
    }
    ?>
</div>