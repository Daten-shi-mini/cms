<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>


<?php

if ($stmt = $connect->prepare('SELECT comments.*, posts.id AS post_id, users.username FROM comments JOIN posts ON comments.post_id = posts.id JOIN users ON users.id = posts.user_id')) {
    $stmt->execute();
    $res = $stmt->get_result();

    if (true) {


    }
    ?>

    <div id="manegment_title">
        <h1>Zarządzanie komentarzami</h1>
    </div>
    <div id="manegment_table">
        <table>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>Nazwa Użytkownika</th>
                <th>Id postu</th>
                <th>Treść</th>
                <th>Status</th>
                <th>Data</th>
                <th>Akceptuj</th>
                <th>Odrzuć</th>
                <th>Usuń</th>
            </tr>
            <?php while ($record = $res->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['id']); ?></td>
                    <td><?php echo htmlspecialchars($record['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($record['username']); ?></td>
                    <td class="limit">
                        <?php if ($record['status'] === 'niezaakceptowany'){ ?>
                            <?php echo htmlspecialchars($record['post_id']); ?>
                        <?php }elseif ($record['status'] === 'zaakceptowany'){ ?>
                            <a href="post.php?id=<?php echo intval($record['post_id']); ?>"><?php echo htmlspecialchars($record['post_id']); ?></a>
                        <?php }else{ ?>
                            <?php echo htmlspecialchars($record['post_id']); ?>
                        <?php } ?>
                    </td>
                    <td class="limit"><?php echo nl2br(htmlspecialchars($record['comment_content'])); ?></td>
                    <td><?php echo htmlspecialchars($record['status']); ?></td>
                    <td><?php echo htmlspecialchars($record['date']); ?></td>
                    <td class="limit">
                        <?php if ($record['status'] === 'zaakceptowany'): ?>-
                        <?php else: ?>
                            <a href="post_moderate.php?type=comment&id=<?php echo intval($record['id']); ?>&action=approve">Zaakceptuj</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($record['status'] === 'zaakceptowany' || $record['status'] === 'oczekujący'){ ?>
                            <a href="post_moderate.php?type=comment&id=<?php echo intval($record['id']); ?>&action=reject">Odrzuć</a>
                        <?php }else{ ?>-
                        <?php }?>
                    </td>
                    <td><a href="delete.php?type=comment&id=<?php echo intval($record['id']); ?>&action=delete">Usuń</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="add_user">
        <a class="button" href="posts_manegment.php">Przejdż do postów</a>
    </div>
    <?php
    $stmt->close();

?>


<?php
}
include("includes/footer.inc.php");

?>


