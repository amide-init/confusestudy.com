

<?php 
include 'core/init.php';
 logged_in_redirect();

include 'include/header.php';
//include 'include/navbar.php';
       //include 'include/searchengine.php';
      
   
 

?>
<div id ="new_div">
<section id="main_section">
<h2> Registration Section:</h2>


<?php
if(empty($_POST) === false){
	$required_fields = array('fname', 'lname', 'email', 'pass', 'passagain');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill all the information correctly';
			break 1;
		}
	}
if(empty($errors) === true) {
	if(user_exists($_POST['email']) === true) {
		$errors[]='This email \'' .$_POST['email']. '\' already exists Sorry!!!!';
	}
	 if(preg_match("/\\s/",$_POST['email']) == true) {
		$errors[]='Write  the email in right sense...';
	}
	 if(strlen($_POST['pass']) < 6) {
		$errors[]='Your password must be at least 6 characters...';
	}
	 if($_POST['pass'] !== $_POST['passagain']) {
		$errors[]='Your password do not match..';
	}
}

}
if(isset($_GET['success']) && empty($_GET['success'])) {
	echo 'you have registered successully ! Please check you email to activate your account';
}else{


if(empty($_POST) === false && empty($errors) === true) {
   $register_data = array(
      'email'        => $_POST['email'], 
      'password'     => $_POST['pass'],
      'firstname'    => $_POST['fname'],
      'lastname'     => $_POST['lname'],
      'birth'        => '',
	  'gender'       => '',
	  'scname'       => '',
	  'intrest'      => '',	  
      'email_code'   => md5($_POST['email'] + microtime()),
	  
      'profile'      => 'images/profile/confusestudy.jpg',
      'reset'        => '' 	  
   ); 
   register_user($register_data);
   echo '<script type="text/javascript">window.location= "./register.php?success"</script>';
   die();
   
   
   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
	


?>

<br><br><br>
<form action="" method="post">
<table  style="font-weight:bold; color:#3b5998; font-style:Tahoma; font-size:120%;">
<tr><td>firstname:</td><td><input type="text"style="color:red; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="fname"  ></td></tr>
<tr><td>lastname:</td><td><input type="text" style="color:#3b5998; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="lname"></td></tr>

<tr><td>email_id:</td><td><input type="text" style="color:#3b5998; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="email"></td></tr>
<tr><td>password:</td><td><input type="password" style="color:#3b5998; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="pass"/></td></tr>
<tr><td>password again:</td><td><input type="password" style="color:#3b5998; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="passagain"></td></tr>

<tr><td><input type="submit" id="my_button" value="create an account"></td></tr>

</table>
</form>
<?php
}
?>
</section>

</div>

<?php

 include 'include/footer.php'; ?>