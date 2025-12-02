<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");


secure();
?>


<form method="post" enctype="multipart/form-data">
    <h3>Zmień dane użytkownika, <br>
        <?php echo""; ?>
    </h3>
    <?php

if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_FILES['foto'])) {
    $username = $connect->real_escape_string($_POST['login']);
    $email = $connect->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['foto']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
            $foto = $connect->real_escape_string($targetPath);
            try {
                $wykonanie = "UPDATE users set username = ?, ";

                if ($connect->query($wykonanie)) {
                    echo "<h4 class='h4_true'>Zarejestrowano nowego użytkownika: " . $username . "</h4>";
                }
            } catch (mysqli_sql_exception $e) {
                echo "<h4>Taki użytkownik już istniee</h4>";
            }
        }
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h4>Nie wszystkie dane zostały wpisane!</h4>";
    }
}

?>

    <label for="username">Login</label>
    <input class="input_form_login" type="text" placeholder="Login" id="login" name="login" required>

    <label for="email">Email</label>
    <input class="input_form_login" type="email" placeholder="Email" id="email" name="email" required>



    <label for="foto">Dodaj zdjęcie</label>
    <input class="input_form_login" type="file" id="foto" name="foto" required>

    <button>Zmień dane</button>
</form>




<?php

include("includes/footer.inc.php");

?>