<?php
session_start();
include "includes/config.php";
include "includes/function.php";
if ($_SERVER['REQUEST_URI'] == "/") {
    include "includes/main.php";
} else {
    if (isset($_GET['id_cat']) || isset($_GET['page'])) {
        include "includes/categories.php";
    }
    if (isset($_GET['id_art'])) {
        add_comments($db);
        include "includes/article.php";
    }
    if (isset($_GET['about_site'])) {
        include "includes/about_site.php";
    }
}

include "layout.php";
