<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>


<?php


// echo "<h1>Moderacja</h1>";

// # Посты в ожидании
// echo "<h2>Oczekujące posty</h2>";

// $result = $connect->query("SELECT * FROM posts WHERE status='oczekujący'");
// while ($p = $result->fetch_assoc()) {
//     echo "<b>{$p['title']}</b><br>";
//     echo nl2br(htmlspecialchars($p['content']))."<br>";
//     echo "<a href='post_moderate.php?type=post&id={$p['id']}&action=approve'>Akceptuj</a> | ";
//     echo "<a href='post_moderate.php?type=post&id={$p['id']}&action=reject'>Odrzuć</a><hr>";
// }

// # Комментарии в ожидании
// echo "<h2>Oczekujące komentarze</h2>";

// $result = $connect->query("SELECT * FROM comments WHERE status='oczekujący'");
// while ($c = $result->fetch_assoc()) {
//     echo nl2br(htmlspecialchars($c['content']))."<br>";
//     echo "<a href='post_moderate.php?type=comment&id={$c['id']}&action=approve'>Akceptuj</a> | ";
//     echo "<a href='post_moderate.php?type=comment&id={$c['id']}&action=reject'>Odrzuć</a><hr>";
// }

?>


<?php

if ($stmt = $connect->prepare('SELECT * FROM posts')) {
    $stmt->execute();
    $res = $stmt->get_result();

    if (true) {


    }
    ?>

    <div id="manegment_title">
        <h1>Zarządzanie postami</h1>
    </div>
    <div id="manegment_table">
        <table>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>Tytuł</th>
                <th>Treść</th>
                <th>Status</th>
                <th>Data wstawienia</th>
                <th>Akceptowanie</th>
                <th>Odrzuć</th>
                <th>Usuwanie</th>
            </tr>
            <?php
            while ($record = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $record['id'] ?></td>
                    <td><?php echo $record['user_id'] ?></td>
                    <td class = "limit"><?php if($record['status'] == 'niezaakceptowany'){
                        echo $record['title'] . "</a></td>";
                    }elseif($record['status'] == 'zaakceptowany'){
                        echo "<a href='post.php?id=<?=". $record['id']. " ?>'>"; echo $record['title']. "</a></td>";
                    }?>
                    <td class = "limit"><?php echo $record['content'] ?></td>
                    <td><?php echo $record['status'] ?></td>
                    <td><?php echo $record['date'] ?></td>
                    <td class="limit">
                        <?php  
                        if($record['status'] == 'zaakceptowany'){
                            echo"-";
                        }else{
                            echo"<a href='post_moderate.php?type=post&id={$record['id']}&action=approve'>Zaakceptuj</a> ";
                        }
                        ?>
                    </td>
                    
                    <td>
                        <?php  
                        if($record['status'] == 'zaakceptowany' || $record['status'] == 'oczekujący'){
                            echo"<a href='post_moderate.php?type=post&id={$record['id']}&action=reject'>Odrzuć</a>";
                        }elseif($record['status'] == 'niezaakceptowany'){
                            echo"-";
                        }
                        ?>
                       <?php  ?>
                        
                    </td>
                    <td><a href="delete.php?type=post&id=<?php echo intval($record['id']); ?>&action=delete">Usuń</a></td>
                    
                </tr>

                <?php
            }
            ?>
        </table>

    </div>
    <div class="add_user">
        <a class="button" href="comment_manegment.php">Przejdż do komentarzy</a>
    </div>
    <?php
    $stmt->close();
}
?>


<?php

include("includes/footer.inc.php");

?>

