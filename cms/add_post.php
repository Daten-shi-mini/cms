<?php
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/database.inc.php");

secure();
?>


<form method="post" enctype="multipart/form-data">
    <h3>Dodaj post</h3>
    <?php
    if ($_POST) {
        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            $target = "uploads_posts/" . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        }

        $stmt = $connect->prepare("INSERT INTO posts (user_id, title, content, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_SESSION['id'], $_POST['title'], $_POST['content'], $imageName);
        $stmt->execute();
        echo"<h4 class='h4_true'>Dodano nowy post</h4>";
    }
    ?>
    <label>Nazwa postu:</label><br>
    <input class="input_form_login" type="text" name="title"><br>
    <label>Dodaj zdjęcie</label>
    <input class="input_form_login" type="file" id="foto" name="image" required>
    <label>Treść: </label><br>
    <textarea class="input_form_login" name="content"></textarea><br>
    <button>Dodaj</button>
</form>


<?php
include("includes/footer.inc.php");
?>