
<?php




$id = $_GET['id'];
$type = $_GET['type'];
$action = $_GET['action'];

$status = ($action == "aprove") ? "akceptowane" : "niezaakceptowane";

if ($type == "post") {
    $stmt = $mysqli->prepare("UPDATE posts SET status=? WHERE id=?");
} else {
    $stmt = $mysqli->prepare("UPDATE comments SET status=? WHERE id=?");
}

$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: dashboard.admin.php");
exit;
?>
