<?php

include 'core/init.php';
protect_page();
include 'include/header.php';
//include 'include/navbar.php';
?>


<div id="new_div">

<section id="main_section">

<h2>Change Password</h2>

<?php
if(empty($_POST) === false) {
	$required_fields = array('current_password', 'new_password', 'new_password_again');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill all the information correctly';
			break 1;
		}
	}
	
	if(md5($_POST['current_password']) === $user_data['password']) {
		if(trim($_POST['new_password']) !== trim($_POST['new_password_again'])) {
			$errors[] = 'Your new password do not match';
		 } else if(strlen($_POST['new_password']) < 6) {
			 $errors[] = 'Your password must be at least six characters long';
			
		}
	} else {
		$errors[] = 'Your current password is incorrect. Try again !';
		
	}
}

if(isset($_GET['success']) && empty($_GET['success'])) {
	echo 'Your password has been change';
} else {

if(empty($_POST) === false && empty($errors) === true) {
	change_password($session_user_id, $_POST['new_password']);
	echo '<script type="text/javascript">window.location= "./changepassword.php?success"</script>';
}else if(empty($errors) === false) {
	echo output_errors($errors);
}



?>



<form action=""  method="post" >
Current Password:<br>
<input type="text" name="current_password"><br>
New Password:<br>
<input type="password" name="new_password"><br>
New Password again:<br>
<input type="password" name="new_password_again"><br><br>
<input type="submit" style="background:#3b5998; padding:4px;color:white; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" value="change password">




</form>
<?php
	}
	?>
</section>
</div>
<?php
//include 'include/newbar.php';

include 'include/footer.php';
?>