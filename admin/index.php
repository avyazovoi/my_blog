<?php
session_start();
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	include "../includes/config.php";
	include "../includes/function.php";
if($_SERVER['REQUEST_URI'] == "/"){
	include "../includes/main.php";
}if(empty($_SESSION['auth'])){
		if(isset($_GET['login'])){
			login($db);
			include "includes/login.php";
		}if(isset($_GET['registration'])){
			registration($db);
			include "includes/registration.php";
		}if(isset($_GET['restore'])){
			restore($db);
			include "includes/restore.php";
		}
}if(isset($_SESSION['auth'])){
	if($_SERVER['REQUEST_URI'] == "/admin/"){
		include "includes/main.php";
	}if(isset($_GET['logout'])){
		logout();
	}if(isset($_GET['delete_article']) OR isset($_GET['delete_comment'])){
		admin_delete($db);
		include "includes/delete.php";
	}if(isset($_GET['edit_article'])){
		admin_edit_title($db);
		admin_edit_img($db);
		admin_edit_text($db);
		include "includes/edit_article.php";
	}if(isset($_GET['edit_account'])){
		edit_login($db);
		edit_email($db);
		edit_avatar($db);
		edit_password($db);
		include "includes/edit_account.php";
	}if(isset($_GET['my_comments'])){
		edit_login($db);
		edit_email($db);
		edit_avatar($db);
		edit_password($db);
		include "includes/my_comments.php";
	}if(isset($_GET['add_article'])){
		add_article($db, $categories);
		include "includes/add_article.php";
	}
}else{
	if(isset($_GET['id_cat'])){
		include "../includes/categories.php";
	}if(isset($_GET['id_art'])){
		include "../includes/articles.php";
	}
}
include "layout.php";