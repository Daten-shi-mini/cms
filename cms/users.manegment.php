<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>



<?php

if ($stmt = $connect->prepare('SELECT * FROM users')) {
    $stmt->execute();
    $res = $stmt->get_result();

    if (true) {


    }
    ?>

    <div id="manegment_title">
        <h1>Zarządzanie użytkownikami</h1>
    </div>
    <div id="manegment_table">
        <table>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Zmień|Usuń</th>
            </tr>
            <?php
            while ($record = mysqli_fetch_assoc($res)) {
                ?>
                <tr>


                    <td><?php echo $record['id'] ?></td>
                    <td><?php echo $record['username'] ?></td>
                    <td><?php echo $record['email'] ?></td>
                    <td><?php echo $record['admin'] ?></td>
                    <td>
                        <a href="users_edit.php?id=<?php echo $record['id'] ?>">Zmień</a> |
                        <a href="users.manegment.php?delete=<?php echo $record['id'] ?>">Usuń</a>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>

    </div>
    <div class="add_user">
        <a class="button" href="user.add.php">Dodaj użytkownika</a>
    </div>
    <?php
    $stmt->close();
}
?>






<?php

include("includes/footer.inc.php");

?>