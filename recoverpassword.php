<?php
          include 'core/init.php';
		  logged_in_redirect();
	  include 'include/header.php';
          include 'include/navbar.php';
	  include 'include/searcheng.php';
	  ?>
	        <div id="new_div">
			<div id="my_que_div">
			
			
			
			
			<section id="new_section">
			<h2>recovery your account</h2>
			<?php
			if(isset($_GET['success']) && empty($_GET['success'])) {
	echo 'please check you email , we send a link to reset your password';
}else{
			if(isset($_POST['recover']) === true){
				$recover_email = $_POST['recover'];
				if(empty($recover_email) === true){
					echo 'fill you email id first...';
				}else{
					recover_account($recover_email);
					echo '<script type="text/javascript">window.location= "./recoverpassword?success"</script>';
				}
			}
			?>
		
			<form action="" method="post">
			
			<input type="text" style="padding:5px;  margin:5px; border:1px solid gray;" placeholder="email id" name="recover" >
			<input type="submit" id ="my_button" value="recovery account"  size="200">
			
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
	   