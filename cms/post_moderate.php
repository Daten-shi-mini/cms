
<?php
include("includes/database.inc.php");

// echo var_dump($_GET);
// exit;

$id = $_GET['id'];
$type = $_GET['type'];
$action = $_GET['action'];

if($action == "approve"){
    $status = "zaakceptowany";
}elseif($action == "reject"){
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

if ($type == "post") {
    header("Location: posts_manegment.php");
} else {
    header("Location: comment_manegment.php");
}


exit;
?>
