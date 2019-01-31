<?php
include 'core/init.php';
logged_in_redirect();

include 'include/header.php';
include'include/navbar.php';
?>

<div id="another_new_div">
<section id="wide_new_section">
<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
	?>
	<h2>Thanks, we have activated your account</h2>
	<p>You are free to login...</p>

	<?php
}else if(isset($_GET['email'],$_GET['email_code'])===true) {
	$email      = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	if(user_exists($email) === false) {
		$errors[]='Oops , somthing went wrong , and we couldn\'t find that email address!';
		
	} else if(activate($email , $email_code) === false) {
		$errors[]='We had problem to activating your account';
	}
	if(empty($errors) === false) {
	?>
	<h2>Opps....</h2>
    <?php	
	echo output_errors($errors);
	}else {
		echo '<script type="text/javascript">window.location= "./activate.php?success"</script>';;
		exit();
	}
}else{
	echo '<script type="text/javascript">window.location= "./index.php"</script>';
	exit();
	
}

?>
</section>
<section id="wide_new_section">
Welcome to our community  of confusestudy,<br>


</section>



</div>

<?php

include 'include/footer.php';
?>