<?php

function secure()
{
    if (!isset($_SESSION["id"])) {
        header("index.php");

    } else {
        include("includes/header.admin.inc.php");
    }
}