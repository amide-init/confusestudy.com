<?php
include 'core/init.php';
 logged_in_redirect();
 include 'include/header.php';

	   include 'include/navbar.php';    
	  //include 'include/searchengine.php';
	  ?>
	  <div id="new_div">
	  <section id="new_section" style="border:none;">
	  
	  
	  
	  <?php
			
if(empty($_POST)===false){
$email=$_POST['email'];

$password=$_POST['pass'];


if(empty($email)||empty($password)){
     $errors[]='fill first';
}else if(user_exists($email)===false){
     $errors[]='we have not your information' ;
}else if(user_active($email)===false){
     $errors[]='you have not actived your account';
}else{
     $login=login($email,$password);
      if($login===false){
            $errors[]='that email/password commbination is incorrect';
     }else{	 
            $_SESSION['id']=$login;
            echo '<script type="text/javascript">window.location= "./index"</script>';
		
            exit();
}
}
?>


<?php
echo '<p style="color:red;">'.output_errors($errors).'</p>';
}
?>


</section>

<section id="new_section">

<h2>login/register</h2>

<form action="login.php" method="POST">
email id<br>
<input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="email"/><br>
password<br>
<input type="password" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="pass"/><br>
<input type="submit" id="my_button" value="login"/>
</form>


 <a href="recoverpassword.php">forgetten password</a> 
 
 <a href="register" id="my_button">SinUp</a>




</div>
<?php

include 'include/footer.php';
?>