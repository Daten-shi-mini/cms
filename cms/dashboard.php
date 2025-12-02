<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");

secure();
?>



<?php
$result = $connect->query("SELECT * FROM posts WHERE status='approved' ORDER BY id DESC");
while ($p = $result->fetch_assoc()): ?>
    <h2><?= htmlspecialchars($p['title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($p['content'])) ?></p>
    <a href="post.php?id=<?= $p['id'] ?>">Komentarze</a>
    <hr>
<?php endwhile; ?>





<?php
include("includes/footer.inc.php");
?>