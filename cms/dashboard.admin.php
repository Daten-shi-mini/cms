<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>



<?php
$result = $connect->query("SELECT * FROM posts WHERE status like 'zaakceptowany' ORDER BY id DESC");
while ($p = $result->fetch_assoc()): ?>
<div clas="block">
    <h2><?php echo htmlspecialchars($p['title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($p['content'])); ?></p>
    <a href="post.php?id=<?= $p['id'] ?>">Komentarze</a>
</div>
<?php endwhile; ?>






<?php

include("includes/footer.inc.php");

?>