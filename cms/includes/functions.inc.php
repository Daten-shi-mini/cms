<?php

function secure()
{
    if (!isset($_SESSION["id"])) {
        header('Location: index.php');
        die();
            
        

    } else {
        include("includes/header.admin.inc.php");
    }
}

