
<?php
include("includes/database.inc.php");

// echo var_dump($_GET);
// exit;

$id = $_GET['id'];
$type = $_GET['type'];
$action = $_GET['action'];

if($action == "approve"){
    $status = "zaakceptowany";
}else{
    $status = "niezaakceptowany";
}

// $status = ($action == "approve") ? "akceptowane" : "niezaakceptowane";

if ($type == "post") {
    $stmt = $connect->prepare("UPDATE posts SET status=? WHERE id=?");
} else {
    $stmt = $connect->prepare("UPDATE comments SET status=? WHERE id=?");
}

$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: dashboard.admin.php");
exit;
?>
