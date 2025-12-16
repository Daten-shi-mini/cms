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

echo "<h2 class='post-name'>".htmlspecialchars($post['title'])."</h2>";

# === Показываем фото ===
echo"<div class='content-block'>";
if ($post['image']) {
    echo "<img class='post_img' src='uploads_posts/{$post['image']}' width='400' height='400' style='border:1px solid #aaa'><br><br>";
}

echo "<p>".nl2br(htmlspecialchars($post['content']))."</p>";
echo"</div>";

# Добавление комментария
function comment(){
    include("includes/database.inc.php");
    if ($_POST && isset($_SESSION['id'])) {
    $stmt = $connect->prepare("INSERT INTO comments (post_id, user_id, comment_content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $_GET['id'], $_SESSION['id'], $_POST['content']);
    $stmt->execute();

    echo "<h4 class='h4_true'>Комментарий отправлен на модерацию!</h4>";
}
}

# Показываем approved комментарии
?>

<?php
$stmt = $connect->prepare("SELECT * FROM comments join users on users.id = comments.user_id WHERE post_id=? AND status='zaakceptowany';");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$comments = $stmt->get_result();

while ($row = $comments->fetch_assoc()) {
    echo"<h1>" . $row['username'] . "</h1>";
    echo "<p>".$row['comment_content']."</p><hr>";
}
?>
<!-- тут закончил -->


<?php if (isset($_SESSION['username'])){ ?>
<form class="comment-form" method="post">
    <?php comment() ?>
    <textarea class="comment-add" placeholder="Dodaj komentarz..." name="content"></textarea><br>
    <button>Dodaj komentarz</button>
</form>
<?php } ?>


<?php
include("includes/footer.inc.php");
?>