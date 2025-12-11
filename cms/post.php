<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");

secure();
?>

<?php

$post_id = $_GET['id'];

$stmt = $connect->prepare("SELECT * FROM posts WHERE id=? AND status='zaakceptowany'");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) die("Nie znaleziono takiego postu!");

echo "<h2>".htmlspecialchars($post['title'])."</h2>";

# === Показываем фото ===
if ($post['image']) {
    echo "<img src='uploads_posts/{$post['image']}' width='400' style='border:1px solid #aaa'><br><br>";
}

echo "<p>".nl2br(htmlspecialchars($post['content']))."</p><hr>";


# Добавление комментария
if ($_POST && isset($_SESSION['user'])) {
    $stmt = $connect->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $post_id, $_SESSION['user']['id'], $_POST['content']);
    $stmt->execute();

    echo "Комментарий отправлен на модерацию!<br><br>";
}

# Показываем approved комментарии
$stmt = $connect->prepare("SELECT * FROM comments WHERE post_id=? AND status='zaakceptowany'");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$comments = $stmt->get_result();

while ($c = $comments->fetch_assoc()) {
    echo "<p>".htmlspecialchars($c['content'])."</p><hr>";
}
?>

<?php if (isset($_SESSION['user'])): ?>
<form method="post">
    <textarea name="content"></textarea><br>
    <button>Добавить комментарий</button>
</form>
<?php endif; ?>


<?php
include("includes/footer.inc.php");
?>