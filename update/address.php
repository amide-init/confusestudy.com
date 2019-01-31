
<div id="my_que_div">
<h2>Update your profile</h2>
<section id="new_section">






<?php
if(empty($_POST) === false){
	$required_fields = array('home_town', 'current_city', 'mobile', 'pincode');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill all the information correctly';
			break 1;
		}
	}


}


if(isset($_GET['success']) && empty($_GET['success'])) {
	echo 'your profile is now update !!!';
}else{


if(empty($_POST) === false && empty($errors) === true) {
   $setting_data = array(
       
     
      
      'home_town'     => $_POST['home_town'],
	  'current_address'  => $_POST['current_city'],
      'mobile'        => $_POST['mobile'],
      'pincode'       => $_POST['pincode']   
	
	  	  
   ); 
   
   if(user_address_check($session_user_id)===true){
   change_address($session_user_id, $setting_data);
    header('Location: setting.php?address&success'); 
  exit();
   }else{
	   insert_address($session_user_id , $setting_data);
	    header('Location: setting.php?address&success'); 
  exit();
   }

   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
	

	

	?>
<form action="" method="post">
Home Town:<br>
<input type="text" id="hire" name="home_town" value="<?php echo $user_address['home_town'];?>" ><br><br>
Current City:<br>
<input type="text" id="hire" name="current_city" value="<?php echo $user_address['current_address'];?>" ><br><br>
Mobile number:<br>
<input type="text" id="hire" name="mobile" value="<?php echo $user_address['mobile'];?>" ><br><br>
Current Address pincode<br>
<input type="text" id="hire" name="pincode" value="<?php echo $user_address['pincode'];?>" ><br><br>

   
   <br><br>
<input type="submit" id="my_button" value="update">

</form>

<?php

}

?>

</section>
</div>
