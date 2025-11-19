<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
</head>

<body>
    <form action="posty.php" method="post" enctype="multipart/form-data">
        <label>Tytuł postu</label><br>
        <input type="text" name="name" required><br>
        <label>Tresć</label><br>
        <input type="text" name="text" required><br>
        <label>Obraz</label><br>
        <input type="file" name="image" id="image" accept="image/*" required><br>
        <button type="submit">Wyślij</button><br>
    </form>
    <?php
    $connect = new mysqli("localhost", "root", "", "cms");
    if ($connect->connect_error) {
        die("Błąd połączenia: " . $connect->connect_error);
    }

    if (isset($_POST['name']) && isset($_POST['text']) && isset($_FILES['image'])) {
        $tytul = $connect->real_escape_string($_POST['name']);
        $tresc = $connect->real_escape_string($_POST['text']);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $img_in_base = $connect->real_escape_string($targetPath);

                $wykonanie = "INSERT INTO posty (`tytuł`, `treść`, `img_path`) VALUES ('$tytul', '$tresc', '$img_in_base')";

                if ($connect->query($wykonanie)) {
                    echo "Dodano wpis.";
                }
            }
        }
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Nie wszystkie dane zostały wpisane!";
        }
    }
    ?>

</body>

</html>