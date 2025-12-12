<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>


<?php

if ($stmt = $connect->prepare('SELECT * FROM comments join posts on comments.post_id = posts.id join users on users.id = posts.user_id')) {
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
                <th>Data wstawienia</th>
                <th>Akceptowanie</th>
                <th>Odrzucanie</th>
                <th>Usuwanie</th>
            </tr>
            <?php
            while ($record = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $record['id'] ?></td>
                    <td><?php echo $record['user_id'] ?></td>
                    <td><?php echo $record['username'] ?></td>
                    <td class = "limit"><?php if($record['status'] == 'niezaakceptowany'){
                        echo $record['post_id'] . "</a></td>";
                    }elseif($record['status'] == 'zaakceptowany'){
                        echo "<a href='post.php?id=<?=". $record['post_id']. " ?>'>"; echo $record['post_id']. "</a></td>";
                    }?>
                    <td class = "limit"><?php echo $record['comment_content'] ?></td>
                    <td><?php echo $record['status'] ?></td>
                    <td><?php echo $record['date'] ?></td>
                    <td class="limit">
                        <?php  
                        if($record['status'] == 'zaakceptowany'){
                            echo"-";
                        }else{
                            echo"<a href='post_moderate.php?type=comment&id={$record['id']}&action=approve'>Zaakceptuj</a> ";
                        }
                        ?>
                    </td>
                    
                    <td>
                        <?php  
                        if($record['status'] == 'zaakceptowany' || $record['status'] == 'oczekujący'){
                            echo"<a href='post_moderate.php?type=comment&id={$record['id']}&action=reject'>Odrzuć</a>";
                        }elseif($record['status'] == 'niezaakceptowany'){
                            echo"-";
                        }
                        ?>
                       <?php  ?>
                        
                    </td>
                    
                </tr>

                <?php
            }
            ?>
        </table>

    </div>
    <div class="add_user">
        <a class="button" href="posts_manegment.php">Przejdż do postów</a>
    </div>
    <?php
    $stmt->close();
}
?>


<?php

include("includes/footer.inc.php");

?>

