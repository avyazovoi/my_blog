<?php
// ------------------------------function get item article---------------------------------->
function get_articles($categorie_id = '', $order, $offset = 0, $limit, $categories, $db){
	if($categorie_id == ''){
		$articles = mysqli_query($db, "SELECT * FROM `articles` ORDER BY $order DESC LIMIT $offset, $limit");
	}else{
		$articles = mysqli_query($db, "SELECT * FROM `articles` WHERE `categorie_id` = $categorie_id ORDER BY $order DESC LIMIT $offset, $limit");
	}
	while( $art = mysqli_fetch_assoc($articles) ){
		$art_cat == false;
				foreach ( $categories as $cat ) {
					if ($art['categorie_id'] == $cat ['id']) {
						$art_cat = $cat;
					}
				}
		$img_src = '../image/articles/' . $art['image'];
		$id_art = $art['id'];
		$title_art = $art['title'];
		$id_cat = $art_cat['id'];
		$title_cat = $art_cat['title'];
		$text_substr = mb_substr($art['text'], 0, 100) . '...';
	include "item_article.php";
	}
}

// ------------------------------function get pagination item article---------------------------------->
function pagination($db, $limit, $categorie_id = ''){
	$user_id = $_SESSION['user']['id'];
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	if($_SERVER['REQUEST_URI'] == '/admin/'){
		if($categorie_id == ''){
			$total_count_query = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `articles` WHERE `user_id` = $user_id");
		}else{
			$total_count_query = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `articles` WHERE `categorie_id` = $categorie_id AND `user_id` = $user_id");
		}
	}else{
		if($categorie_id == ''){
			$total_count_query = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `articles`");
		}else{
			$total_count_query = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM `articles` WHERE `categorie_id` = $categorie_id");
		}
	}
	$total_count = mysqli_fetch_assoc($total_count_query);
	$total_count = $total_count['count'];
	$total_pages = (int) ceil($total_count / $limit);
	if($page <= 1 || $page > $total_pages){
		$page = 1;
	}
	$offset = ($limit * $page) - $limit;
	if(isset($_POST['back'])){
		$_POST['page'] = $_POST['val_back'];
	}if(isset($_POST['forward'])){
		$_POST['page'] = $_POST['val_forward']; 
	}
	return $pagination[] = [
		'offset' => $offset,
		'limit' => $limit,
		'page' => $page,
		'total_pages' => $total_pages,
		'categorie_id' => $categorie_id
	];
}

// ------------------------------function get views article--------------------------------->
function get_views($db, $art){
	mysqli_query($db, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` =" . $_GET['edit']);
	echo 'просмотров :' . $art;
}

// ----------------------------------function add comment----------------------------------->
function add_comments($db){
	if(isset($_SESSION['auth'])){
		$_POST['username'] = $_SESSION['user']['name'];
		$_POST['email'] = $_SESSION['user']['email'];
	}
	if(isset($_POST['comment'])){
		$errors = [];
		if($_POST['username'] == ''){
			$errors[] = 'Please, inpute name!';
		}
		if($_POST['email'] == ''){
			$errors[] = 'Please, inpute Email!';
		}
		if($_POST['text'] == ''){
			$errors[] = 'Please, inpute your comment!';
		}
		if(empty($errors)){
			mysqli_query($db, "INSERT INTO `comments`(`email`, `author`, `text`, `article_id`) VALUES ('".$_POST['email']."', '".$_POST['username']."', '".$_POST['text']."', '".$_GET['id_art']."')");
			$_SESSION['message'] = [
				'text' => 'Your comment is added!',
				'status' => 'success'
			];
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
		header('location:/?id_art='.$_GET['id_art']); die();
	}
}

//---------------------------------function avatar------------------------------------>
function  avatar($db, $email = '') {
		$check_avatar = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '$email'");
		$avatar = mysqli_fetch_assoc($check_avatar);
	if($avatar['avatar'] == true){
			return '../image/avatar/' . $avatar['avatar'];
	}else{
		$default = "https://img.icons8.com/small/96/000000/user.png";
		$email = md5(strtolower(trim($email)));
		$gravurl = "https://www.gravatar.com/avatar/" . $email . "?d=" . urlencode( $default ) . "&s=100";
		return $gravurl;
	}
}

//---------------------------------function registration------------------------------------>
function registration($db){
	if(isset($_POST['registration'])){
		$result = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '".$_POST['email']."'");
		$errors = [];
		if(mysqli_num_rows($result)){
			$errors[] = 'There is already an account with this email! Please input different email.';
		}if($_POST['email'] == ''){
			$errors[] = 'Please, inpute email!';
		}if($_POST['login'] == ''){
			$errors[] = 'Please, inpute login!';
		}if(strlen($_POST['password']) < 8 OR strlen($_POST['password']) > 15){
			$errors[] = 'The password has invalid amount of symbols! Your password must be at least 8 and no more than 15 symbols.';
		}if($_POST['password'] == ''){
			$errors[] = 'Please, inpute your password!';
		}if($_POST['password_compare'] == ''){
			$errors[] = 'Please, input your password for comparison!';
		}if($_POST['password'] !== $_POST['password_compare']){
			$errors[] = 'Your password is different!';
		}if(empty($errors)){
			$salt = rand();
			$password = md5($_POST['password'] . $salt);
			mysqli_query($db, "INSERT INTO `users`(`email`, `login`, `password`, `salt`) VALUES ('".$_POST['email']."', '".$_POST['login']."', '$password', '$salt')");
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['message'] = [
				'text' => 'Congratulations, you`ve created a new account!',
				'status' => 'success'
			];
			header('location:/admin/?login'); die();
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
	}
}

//--------------------------------------function login-------------------------------------->
function login($db){
	if(isset($_SESSION['email']) == true){
		$_POST['email'] = $_SESSION['email'];
		unset($_SESSION['email']);
	}
	if(isset($_POST['sign_in'])){
		$errors = [];
		if($_POST['email'] == ''){
			$errors[] = 'Please, inpute email!';
		}if($_POST['password'] == ''){
			$errors[] = 'Please, inpute your password!';
		}if(empty($errors)){
			$email = $_POST['email'];
			$salt_query = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '$email'");
			$salt = mysqli_fetch_assoc($salt_query);
			$password = md5($_POST['password'] . $salt['salt']);
			$result = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
			if(mysqli_num_rows($result)){
				$_SESSION['auth'] = true;
				$res = mysqli_fetch_assoc($result);
				$_SESSION['user'] = [
					'id' => $res['id'],
					'email' => $res['email'],
					'name' => $res['login'],
					'avatar' => $res['avatar']
				];
				$_SESSION['message'] = [
					'text' => "You've successfully logged in",
					'status' => 'success'
				];
				header('location:/admin/'); die();
			}else{
				$_SESSION['message'] = [
					'text' => 'Account not found',
					'status' => 'errors'
				];
				header('location:/admin/?login'); die();
			}
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
				header('location:/admin/?login'); die();
		}
	}
}

//--------------------------function account login control---------------------------------->
function account($db){
	if(!isset($_SESSION['auth'])){
		echo '<a href="/admin/?login" class="header__menu_link">Войти</a>';
	}else{
		echo '<p class="user__data user__name"><a href="/admin/">'.$_SESSION['user']['name'].'</a>';
		echo '<a href="/admin/?logout"><img src="../image/icons/icons_exit.png" alt=""></a></p>';
	}
}

//-------------------------------function account logout------------------------------------>
function logout(){
	session_start();
	session_destroy ();
	$_SESSION['message'] = [
		'text' => 'Logout!',
		'status' => 'success'
	];
	header('location:/admin/?login'); die();
}


//-------------------------------function restore password account------------------------------------>
function restore($db){
	if(isset($_POST['restore'])){
		$email = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '".$_POST['email']."'");
		$errors = [];
		if($_POST['email'] == ''){
			$errors[] = 'Please, inpute email!';
		}if(mysqli_num_rows($email) == false){
			$errors[] = 'You email not founded';
		}if(empty($errors)){
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$input_length = strlen($permitted_chars);
			$random_string = '';
			for($i = 0; $i < 10; $i++) {
				$random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
				$random_string .= $random_character;
			}
			$pass = $random_string;
			$salt = rand();
			$password = md5($pass . $salt);
			mysqli_query($db, "UPDATE `users` SET `password` = '$password', `salt` = '$salt' WHERE `email` = '".$_POST['email']."'");
			$email = $_POST['email'];
			$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
			$headers .= "From: От кого письмо <avyazovoi0307@gmail.com>\r\n"; 
			$headers .= "Reply-To: avyazovoi0307@gmail.com\r\n"; 
			mail($email, "Восстановление пароля", "Ваш новый пароль: $pass \r\n", $headers);
			$_SESSION['message'] = [
				'text' => "We sent message on your email",
				'status' => 'success'
			];
			header('location:/admin/?restore'); die();
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
				header('location:/admin/?restore'); die();
		}
	}
}

//===============================function admin panel=======================================>

//-------------------------function edit login account------------------------------>
function edit_login($db){
	if(isset($_POST['edit_login'])){
		$check_login = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '".$_POST['login']."'");
		$errors = [];
		if($_POST['login'] == ''){
			$errors[] = 'This login is already taken! Please use different login.';
		}if(mysqli_num_rows($check_login)){
			$errors[] = 'Please, input new login!';
		}if(empty($errors)){
			$login = $_POST['login'];
			$user_id = $_SESSION['user']['id'];
			mysqli_query($db, "UPDATE `users` SET `login`= '$login' WHERE `id` = '$user_id'");
			$_SESSION['user']['name'] = $_POST['login'];
			$_SESSION['message'] = [
				'text' => 'Your logi is changed!',
				'status' => 'success'
			];
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
			header('location:/admin/?edit_account'); die();
	}
}

//-------------------------function edit email account------------------------------>
function edit_email($db){
	if(isset($_POST['edit_email'])){
		$check_email = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '".$_POST['email']."'");
		$errors = [];
		if($_POST['email'] == ''){
			$errors[] = 'Please, input new email!';
		}if(mysqli_num_rows($check_email)){
			$errors[] = 'This email is already taken! Please use different email.';
		}if(empty($errors)){
			$email = $_POST['email'];
			$user_id = $_SESSION['user']['id'];
			mysqli_query($db, "UPDATE `users` SET `email`= '$email' WHERE `id` = '$user_id'");
			$_SESSION['user']['email'] = $_POST['email'];
			$_SESSION['message'] = [
				'text' => 'Your logi is changed!',
				'status' => 'success'
			];
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
			header('location:/admin/?edit_account'); die();
	}
}

//-------------------------function edit avatar account------------------------------>
function edit_avatar($db){
	$uploaddir = '../image/avatar/';
	$uploadfile = $uploaddir . basename($_FILES['avatar']['name']);
	$getMime = explode('.', $_FILES['avatar']['name']);
	$mime = strtolower(end($getMime));
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg', 'svg');
	if(isset($_POST['edit_avatar'])){
		$errors = [];
		if($_FILES['avatar']['size'] > 3000000 ){
			$errors[] = 'Warning, this file is big! Max size is 3 mb';
		}if($_FILES['avatar']['name'] == ''){
			$errors[] = 'File is not selected';
		}if(is_uploaded_file($_FILES['avatar']['tmp_name']) == false){
			$errors[] = 'May be attac on server from hackers!';
		}if(!in_array($mime,$types)){
			$errors[] = 'File is not valid format';
		}if(empty($errors)){
			move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);
			$name = $_FILES['avatar']['name'];
			$user_id = $_SESSION['user']['id'];
			mysqli_query ($db, "UPDATE `users` SET `avatar` = '$name' WHERE `id` = '$user_id'");
			$_SESSION['user']['avatar'] = $name;
			$_SESSION['message'] = [
				'text' => 'Image has been uploaded!',
				'status' => 'success'
			];
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
			header('location: /admin/?edit_account'); die();
	}
}

//-------------------------function edit email account------------------------------>
function edit_password($db){
	if(isset($_POST['edit_password'])){

		$user_query = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = '".$_SESSION['user']['id']."'");
		$user = mysqli_fetch_assoc($user_query);
		$password = md5($_POST['password'] . $user['salt']);
		$errors = [];
		if($_POST['password'] == ''){
			$errors[] = 'Please, inpute your password!';
		}if($password !== $user['password']){
			$errors[] = 'Your passwors is not correct!';
		}if(strlen($_POST['new_password']) < 8 OR strlen($_POST['new_password']) > 15){
			$errors[] = 'The new password has invalid amount of symbols! Your new password must be at least 8 and no more than 15 symbols.';
		}if($_POST['new_password'] == ''){
			$errors[] = 'Please, inpute your new password!';
		}if($_POST['new_password_compare'] == ''){
			$errors[] = 'Please, input your password for comparison!';
		}if($_POST['new_password_compare'] !== $_POST['new_password']){
			$errors[] = 'Your new password is different!';
		}if(empty($errors)){
			$salt = rand();
			$new_password = md5($_POST['new_password'] . $salt);
			$user_id = $_SESSION['user']['id'];
			mysqli_query($db, "UPDATE `users` SET `password`= '$new_password', `salt` = '$salt' WHERE `id` = '$user_id'");
			$_SESSION['message'] = [
				'text' => 'Your logi is changed!',
				'status' => 'success'
			];
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
			header('location:/admin/?edit_account'); die();
	}
}

//-------------------------function admin get article------------------------------>
function admin_get_articles($categorie_id = '', $order, $offset = 0, $limit, $db, $categories){
	$user_id = $_SESSION['user']['id'];
	if($categorie_id == ''){
		$articles = mysqli_query($db, "SELECT * FROM `articles` WHERE `user_id` = $user_id ORDER BY $order DESC LIMIT $offset, $limit");
	}else{
		$articles = mysqli_query($db, "SELECT * FROM `articles` WHERE `categorie_id` = $categorie_id AND `user_id` = $user_id ORDER BY $order DESC LIMIT $offset, $limit");
	}
		while( $art = mysqli_fetch_assoc($articles) ){
		$art_cat == false;
		foreach ( $categories as $cat ) {
			if ($art['categorie_id'] == $cat ['id']) {
				$art_cat = $cat;
			}
		}
		$img_src = '../image/articles/' . $art['image'];
		$id_art = $art['id'];
		$title_art = $art['title'];
		$id_cat = $art_cat['id'];
		$title_cat = $art_cat['title'];
		$text_substr = mb_substr($art['text'], 0, 100) . '...';
		include "includes/elems/item_article.php";
		}
}

//-------------------------function admin panel delete article------------------------------>
function admin_delete($db){
	if(isset($_GET['delete_comment'])){
		mysqli_query($db, "DELETE FROM `comments` WHERE `id` = " . $_GET['delete_comment']);
		$_SESSION['message'] = [
			'text' => 'Your comment is deleted!',
			'status' => 'success'
		];
		header('location:/admin/?my_comments'); die();
	}
	if(isset($_GET['delete_article'])){
		mysqli_query($db, "DELETE FROM `articles` WHERE `id` = " . $_GET['delete_article']);
		$_SESSION['message'] = [
			'text' => 'Your article is deleted!',
			'status' => 'success'
		];
		header('location:/admin/'); die();
	}
}

//-----------------------------function admin edit image------------------------------------>
function admin_edit_img($db){
$uploaddir = '../image/articles/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
$getMime = explode('.', $_FILES['file']['name']);
$mime = strtolower(end($getMime));
$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg', 'mp4');
	if(isset($_POST['edit_img'])){
		$errors = [];
		if($_FILES['file']['size'] > 3000000 ){
			$errors[] = 'Warning, this file is big!';
		}if($_FILES['file']['name'] == ''){
			$errors[] = 'File is not selected';
		}if(is_uploaded_file($_FILES['file']['tmp_name']) == false){
			$errors[] = 'May be attac on server from hackers!';
		}if(!in_array($mime,$types)){
			$errors[] = 'File is not valid format';
		}if(empty($errors)){
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
			$name = $_FILES['file']['name'];
			mysqli_query ($db, "UPDATE `articles` SET `image` = '$name' WHERE `id` =" . $_GET['edit']);
			$_SESSION['message'] = [
				'text' => 'Image has been uploaded!',
				'status' => 'success'
			];
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
			header('location: /admin/?edit=' . $_GET['edit']); die();
	}
}

//---------------------------------function admin edit title-------------------------------->
function admin_edit_title($db){
	$id = $_GET['edit'];
	if(isset($_POST['edit_title'])){
		$errors = [];
		if($_POST['title'] == ''){
			$errors[] = 'Please, input a new title!';
		}if(empty($errors)){
			$title = $_POST['title'];
			mysqli_query($db, "UPDATE `articles` SET `title` = '$title' WHERE `id` =" . $_GET['edit']);
			$_SESSION['message'] = [
				'text' => 'Title changed',
				'status' => 'success'
			];
			header('location: /admin/?edit=' . $_GET['edit']); die();
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
			header('location: /admin/?edit='.$_GET['edit']); die();
		}
	}
}

//----------------------------------function admin edit text-------------------------------->
function admin_edit_text($db){
	if(isset($_POST['edit_text'])){
		$errors = [];
		if($_POST['text'] == ''){
			$errors[] = 'Please, input a new text!';
		}if(empty($errors)){
			$text = $_POST['text'];
			mysqli_query($db, "UPDATE `articles` SET `text` = '$text' WHERE `id` =" . $_GET['edit']);
			header('location: /admin/?edit=' . $_GET['edit']);
			$_SESSION['message'] = [
				'text' => 'text changed',
				'status' => 'success'
			];
			header('location: /admin/?edit=' . $_GET['edit']); die();
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
			header('location: /admin/?edit=' . $_GET['edit']); die();
		}
	}
}

//----------------------------------function admin add new article-------------------------------->
function add_article($db, $categories){
$uploaddir = '../image/articles/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
$getMime = explode('.', $_FILES['file']['name']);
$mime = strtolower(end($getMime));
$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
	if(isset($_POST['add_article'])){
		$errors = [];
		if($_POST['categorie'] == 'all_categories'){
			$errors[] = 'Please, select a categorie!';
		}if($_POST['title'] == ''){
			$errors[] = 'Please, input title!';
		}if($_FILES['file']['size'] > 3000000 ){
			$errors[] = 'Warning, this file is big!';
		}if($_FILES['file']['name'] == ''){
			$errors[] = 'File is not selected';
		}if(is_uploaded_file($_FILES['file']['tmp_name']) == false){
			$errors[] = 'May be attac on server from hackers!';
		}if(!in_array($mime,$types)){
			$errors[] = 'File is not valid format';
		}if($_POST['text'] == ''){
			$errors[] = 'Please, input text!';
		}if(empty($errors)){
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
			$img = $_FILES['file']['name'];
			$user_id = $_SESSION['user']['id'];
			mysqli_query($db, "INSERT INTO `articles`(`image`, `title`, `text`, `categorie_id`, `user_id`) VALUES ('$img', '".$_POST['title']."', '".$_POST['text']."', '".$_POST['categorie']."', '$user_id')");
			$_SESSION['message'] = [
				'text' => 'You created a new article!',
				'status' => 'success'
			];
			header('location: /admin/'); die();
		}else{
			$_SESSION['message'] = [
				'text' => $errors['0'],
				'status' => 'errors'
			];
		}
		header('location: /admin/?add_article'); die();
	}
}

//----------------------------------function admin get title categorie-------------------------------->
function get_title_categorie($categories){
	if(isset($_POST['select'])) {
		if( $_POST['categorie'] == 'all_categories' ){
			$categorie_id = '';
			echo 'Все Ваши статьи';
		}else{
			$categorie_id = $_POST['categorie'];
			foreach($categories as $cat){
				if($categorie_id == $cat['id']){
					echo 'Все статьи категории: ' . $cat['title'];
				}
			}
		}
	}else{
		echo 'Все Ваши статьи';
	}
	return $categorie_id;
}