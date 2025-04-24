<!DOCTYPE html>
<html>
<head>
    <title>XML andmete lugemine PHP abil</title>
</head>
<body>
<h2>RSS uudised err.ee</h2>
<ul>
    <?php
    $linkide_arv=10;
    $uudised=simplexml_load_file("http://www.err.ee/rss");
    $loendur = 0;
    foreach ($uudised->channel->item as $item)
    {
        if($loendur<=$linkide_arv){
            echo "<li><a href='$item->link'>".$item->title."</a>";
            echo $item->description;
            echo "<br>Kuupvaev: ".$item->category;
            echo "<br>Kategooria: ".$item->pubDate;
            echo "</li>";
            $loendur++;
        }
    }
    ?>
</ul>
</body>
</html>
<?php