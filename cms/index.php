<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");

include("includes/header.index.inc.php");


?>

<form method="post">
    <h3>Zaloguj się!</h3>
    <?php
    if (isset($_POST["email"])) {
        if ($stmt = $connect->prepare('SELECT * FROM users WHERE email = ?')) {
            $stmt->bind_param('s', $_POST['email']);
            $stmt->execute();
            $res = $stmt->get_result();
            $user = $res->fetch_assoc();
            
            if (!$user) {
                echo "<h4 class = 'h4_index'>Błędny login lub hasło.</h4>";
            } else if (password_verify($_POST['password'], $user['password'])) {
                $user_str = htmlspecialchars($user['username']);
                echo "<h4 class = 'h4_index'>Zalogowano jako:" . $user_str . "</h4>";
                if($user){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];

                    header('Location: dashboard.admin.php');
                    die();
                }
                $stmt->close();
            } else {
                echo "<h4 class='h4_index'>Błędny login lub hasło.s</h4>";
            }

            $stmt->close();
        }
    }
    ?>

    <label for="email">Login</label>
    <input type="email" placeholder="Email" id="email" name="email" required>

    <label for="password">Hasło</label>
    <input type="password" placeholder="Hasło" id="password" name="password" required>

    <button>Zaloguj się</button>
    <h5><a href="registration.php">Zarejestruj się</a></h5>
</form>



<?php

include("includes/footer.inc.php");

?>