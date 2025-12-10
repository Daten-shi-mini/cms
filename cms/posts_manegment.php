<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>


<?php


echo "<h1>Модерация</h1>";

# Посты в ожидании
echo "<h2>Посты на модерации</h2>";

$result = $connect->query("SELECT * FROM posts WHERE status='oczekujący'");
while ($p = $result->fetch_assoc()) {
    echo "<b>{$p['title']}</b><br>";
    echo nl2br(htmlspecialchars($p['content']))."<br>";
    echo "<a href='post_moderate.php?type=post&id={$p['id']}&action=approve'>Одобрить</a> | ";
    echo "<a href='post_moderate.php?type=post&id={$p['id']}&action=reject'>Отклонить</a><hr>";
}

# Комментарии в ожидании
echo "<h2>Комментарии на модерации</h2>";

$result = $connect->query("SELECT * FROM comments WHERE status='oczekujący'");
while ($c = $result->fetch_assoc()) {
    echo nl2br(htmlspecialchars($c['content']))."<br>";
    echo "<a href='post_moderate.php?type=comment&id={$c['id']}&action=approve'>Одобрить</a> | ";
    echo "<a href='post_moderate.php?type=comment&id={$c['id']}&action=reject'>Отклонить</a><hr>";
}

?>

<?php

include("includes/footer.inc.php");

?>