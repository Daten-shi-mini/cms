<?php
include("includes/database.inc.php");

$id = $_GET['id'];
$type = $_GET['type'];
$action = $_GET['action'];

if($action == "delete"){
    $stmt = $connect->prepare("UPDATE posts SET status=? WHERE id=?");;
}


if ($type == "post") {
    $stmt = $connect->prepare("DELETE from posts WHERE id=?");
} else {
    $stmt = $connect->prepare("DELETE from comments WHERE id=?");
}

$stmt->bind_param("i", $id);
$stmt->execute();

if ($type == "post") {
    header("Location: posts_manegment.php");
} else {
    header("Location: comment_manegment.php");
}


exit;
?>
