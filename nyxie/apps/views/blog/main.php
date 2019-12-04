<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>
    <link rel="stylesheet" href="/nyxie/apps/views/blog/styles/main.css">
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
        <?php include($content_file); ?>
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