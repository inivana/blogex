<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Index</title>

</head>

<body>
    <div style="
    width:500px;
    min-height:100px;
    margin: auto;
    text-align:center;
    background-color: cornflowerblue;
    border-radius: 5px;
    color: white;
    padding-top:50px;
    font-size:24px;">
        <?=$title?>
        <ul style="list-style-type: none">
            <?php
                foreach($items as $value)
                {
                    echo "<li>". $value ."</li>";
                }
            ?>
        </ul>
    </div>
</body>
</html>