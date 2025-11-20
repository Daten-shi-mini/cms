<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>




<?php

if (isset($_POST["username"])) {

    if ($stmt = $connect->prepare('UPDATE users set username = ?, email = ?, admin = ? WHERE id like ?')) {
        $stmt->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['admin'], $_GET['id']);
        $stmt->execute();

        $stmt->close();
        if (isset($_POST['password'])) {
            if ($stmt = $connect->prepare('UPDATE users set password = ? WHERE id = ?')) {
                $hash = sha1($_POST['password']);
                $stmt->bind_param('si', $hash, $_GET['id']);
                $stmt->execute();

                $stmt->close();

            }
        }

        header('users.manegment.php');
        die();
    }

}

if (isset($_GET["id"])) {
    if ($stmt = $connect->prepare('SELECT * FROM users WHERE id = ?')) {
        $stmt->bind_param('s', $_GET['id']);
        $stmt->execute();

        $res = $stmt->get_result();
        $user = $res->fetch_assoc();

        if ($user) {


            ?>
            <form method="post">
                <h3>Zmiana danych</h3>

                <label for="login">Login</label>
                <input class="input_form_login" type="text" placeholder="Login" id="login" name="login" required
                    value="<?php echo $user['username'] ?>">

                <label for="email">Email</label>
                <input class="input_form_login" type="email" placeholder="Email" id="email" name="email" required
                    value="<?php echo $user['email'] ?>">

                <label for="password">Hasło</label>
                <input class="input_form_login" type="password" placeholder="Hasło" id="password" name="password" required>

                <label for="admin">Admin?</label>
                <select name="admin" name="admin" class="user_edit_select">
                    <option <?php echo ($user['admin']) ? "" : "selected" ?> value="0" class="user_edit_select_option">Użytkownik
                    </option>
                    <option <?php echo ($user['admin']) ? "selected" : "" ?> value="1" class="user_edit_select_option">Admin
                    </option>
                </select>

                <button class="button_add_user">Zmień użytkownika</button>
            </form>







            <?php

        }
        $stmt->close();
    }
}

include("includes/footer.inc.php");

?>