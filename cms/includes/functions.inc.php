<?php
include("includes/database.inc.php");

function secure()
{
    global $connect;
    if (!isset($_SESSION["id"])) {
        header("index.php");

    } else {
        if($_SESSION['id'] == 1){
            include("includes/header.admin.inc.php");
        }if($_SESSION['id'] != 1){
            include("includes/header.user.inc.php");
        }
    }
}