<?php 
	include "message.php";
	if(isset($_SESSION['auth'])){
		include "elems/form_add_comment_login.php";
	}else{
		include "elems/form_add_comment_logout.php";
	}
