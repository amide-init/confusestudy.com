<?php
include 'core/init.php';
logged_in_redirect();
include 'include/header.php';
include 'include/navbar.php';
$email      = $_GET['email'];
$reset_code = $_GET['reset_code'];
?>
<div id="new_div">
<div id="my_que_div">
<h2>Reset your password...</h2>
<?php
if(empty($_POST) === false){
	$required_fields = array('new_password' , 'new_password_again');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill first ...';
			break 1;
		}
	}
	if(empty($errors) === true) {
		 if(strlen($_POST['new_password']) < 6) {
		$errors[]='Your password must be at least 6 characters...';
	}
	 if($_POST['new_password'] !== $_POST['new_password_again']) {
		$errors[]='Your password do not match..';
	}
	}
	
}

if(isset($_GET['success']) && empty($_GET['success'])) {
	echo 'your password has been changed , You are free to login......';
}else{


if(empty($_POST) === false && empty($errors) === true) {
   $new_password = $_POST['new_password'] ;
   new_password_update($new_password , $email , $reset_code);
   echo '<script type="text/javascript">window.location= "./recover?success"</script>';
   die();
   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
?>
<section id="new_section">
<form action=""method="post">
New password :<br>
<input type="password" id="hire" name="new_password"><br>
Re-type new password :<br>
<input type="password"  id="hire" name="new_password_again"><br>
<input type="submit" id="my_button" value="change password">
</form>
</section>
<?php
}
?>
</div>
</div>
<?php
include 'include/footer.php';
?>