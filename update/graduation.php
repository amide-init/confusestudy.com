
<div id="my_que_div">
<h2>Update your profile</h2>
<section id="new_section">






<?php
if(empty($_POST) === false){
	$required_fields = array('fname', 'lname', 'scname', 'email', 'intrest');
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
       
     
      'collage_name'      => $_POST['collage_name'],
	  'course'            => $_POST['course'],
      'starting_year'     => $_POST['starting_year'],
	  'passing_year'      => $_POST['passing_year'],
      'about_collage'     => $_POST['about_collage'],
      'about_graduation'  => $_POST['about_graduation']   
	  
	  	  
   ); 
   if(user_grad_check($session_user_id) === true){
   change_graduation_setting($session_user_id, $setting_data);
 header('Location: setting.php?graduation&success'); 
  exit();
   }else{
	   insert_grad_info($session_user_id , $setting_data);
	    header('Location: setting.php?graduation&success'); 
  exit();
   }
   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
	

	

	?>
<form action="" method="post">
collage/university name:
<input type="text" id="hire" name="collage_name" value="<?php echo $graduation_data['collage_name']; ?>" ><br><br>
Course:
<input type="text"id="hire"  name="course" value="<?php echo $graduation_data['course']; ?>" ><br><br>
Starting year:
<input type="text"id="hire" size="4" name="starting_year" value="<?php echo $graduation_data['starting_year']; ?>" ><br><br>
Expected passing year:
<input type="text" id="hire" size="4" name="passing_year" value="<?php echo $graduation_data['passing_year']; ?>" >
<br><br>
About your collage/university:<br>
<textarea name="about_collage" style="max-width:450px; max-height:100px; min-width:450px; min-height:100px;"  ><?php  echo $graduation_data['about_collage']; ?></textarea><br><br>
About your Graduation life:<br>
<textarea name="about_graduation" style="max-width:450px; max-height:100px; min-width:450px; min-height:100px;" > <?php echo $graduation_data['about_graduation'];?></textarea>
   
   <br><br>
<input type="submit" id="my_button" value="update">

</form>

<?php

}

?>

</section>
</div>
