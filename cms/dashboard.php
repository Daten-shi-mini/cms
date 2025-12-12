<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");

secure();
?>


<?php
$result = $connect->query("SELECT * FROM posts WHERE status like 'zaakceptowany' ORDER BY id DESC");
while ($p = $result->fetch_assoc()): ?>
<div class="block">
    <h2 class="post-title"><?php echo htmlspecialchars($p['title']); ?></h2>
    <p class="post-content"><?php echo nl2br(htmlspecialchars($p['content'])); ?></p>
    <a class="open-post" href="post.php?id=<?= $p['id'] ?>">Zobacz więcej</a>
</div>
<?php endwhile; ?>




<?php
include("includes/footer.inc.php");
?>