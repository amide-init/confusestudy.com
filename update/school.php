
<div id="my_que_div">
<h2>Update your profile</h2>
<section id="new_section">






<?php
if(empty($_POST) === false){
	$required_fields = array('school_name', 'passing_year');
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
       
     
      'name_of_school'    => $_POST['school_name'],
      'passing_year'      => $_POST['passing_year'],
	  'grade'             => $_POST['grade'],
      'about_school'       => $_POST['about_school'],
      'about_ten'         => $_POST['about_ten']   
	  
	  	  
   ); 
   if(user_school_check($id) === true){
   change_school_setting($session_user_id, $setting_data); 
 header('Location: setting.php?school&success'); 
  exit();
   }else{
	   insert_school_info($session_user_id , $setting_data);
	   header('Location: setting.php?highSchool&success'); 
  exit();
   }

   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
	

	

	?>
<form action="" method="post">
School name:<br>
<input type="text" name="school_name" id="hire" value="<?php echo $my_school_data['name_of_school']; ?>" ><br><br>
Passing year:<br>
<input type="text" name="passing_year" id="hire" size="4" value="<?php echo $my_school_data['passing_year']; ?>"  ><br><br>
Grade:<br>
<select id="hire" name="grade">
  <option value="<?php echo $my_school_data['grade']; ?>"><?php echo $my_school_data['grade']; ?></option>
<option value="Below 50% || below 5 CGPA">Below 50% || below 5 CGPA</option>
  <option value="50%-60% || 5CGPA-6CGPA">50%-60% || 5CGPA-6CGPA</option>
  <option value="60%-70% || 6CGPA-7CGPA">60%-70% || 6CGPA-7CGPA</option>
  <option value="70%-80% || 7CGPA-8CGPA">70%-80% || 7CGPA-8CGPA</option>
  <option value="80%-90% || 8CGPA-9CGPA">80%-90% || 8CGPA-9CGPA</option>
  <option value="90%-100% || 9CGPA-10CGPA">90%-100% || 9CGPA-10CGPA</option>
  <option value="100% || 10CGPA">100% || 10CGPA</option>
</select><br><br>
About your school:<br>
<textarea name="about_school"  style="max-width:450px; max-height:100px; min-width:450px; min-height:100px;" ><?php echo $my_school_data['about_school']; ?></textarea><br><br>
About your 10th board exams:<br>
<textarea name="about_ten" <?php echo $my_school_data['about_ten']; ?> style="max-width:450px; max-height:100px; min-width:450px; min-height:100px;"><?php echo $my_school_data['about_ten']; ?></textarea>
   
   <br><br>
<input type="submit" id="my_button" value="update">

</form>

<?php

}

?>

</section>
</div>
