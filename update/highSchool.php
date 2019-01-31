
<div id="my_que_div">
<h2>Update your profile</h2>
<section id="new_section">






<?php
if(empty($_POST) === false){
	$required_fields = array('sc_name', 'passing_year');
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
       
     
      'sc_name'           => $_POST['sc_name'],
      '+2passing_year'     => $_POST['passing_year'],
	  '+2grade'           => $_POST['grade'],
      'about_school+2'    => $_POST['about_school+2'],
      'about_twelve'      => $_POST['about_twelve']   
	  
	  	  
   ); 
   
   if(user_collage_check($session_user_id) === true){
   change_collage_setting($session_user_id, $setting_data);  
 header('Location: setting.php?highSchool&success'); 
  exit();
   }else{
	   insert_collage_info($session_user_id , $setting_data);
	   header('Location: setting.php?highSchool&success'); 
  exit();
	   
   }
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
	

	

	?>
<form action="" method="post">
School/collage name:
<input type="text" id="hire" name="sc_name" value="<?php echo $my_collage_data['sc_name']; ?>" ><br><br>
Passing year:
<input type="text" id="hire" size="4" size name="passing_year" value="<?php echo $my_collage_data['+2passing_year']; ?>" ><br><br>
Grade:
<select id="hire" name="grade">
  <option value="<?php echo $my_collage_data['+2grade']; ?>"><?php echo $my_collage_data['+2grade']; ?></option>
  <option value="Below 50% || below 5 CGPA">Below 50% || below 5 CGPA</option>
  <option value="50%-60% || 5CGPA-6CGPA">50%-60% || 5CGPA-6CGPA</option>
  <option value="60%-70% || 6CGPA-7CGPA">60%-70% || 6CGPA-7CGPA</option>
  <option value="70%-80% || 7CGPA-8CGPA">70%-80% || 7CGPA-8CGPA</option>
  <option value="80%-90% || 8CGPA-9CGPA">80%-90% || 8CGPA-9CGPA</option>
  <option value="90%-100% || 9CGPA-10CGPA">90%-100% || 9CGPA-10CGPA</option>
  <option value="100% || 10CGPA">100% || 10CGPA</option>
</select><br><br>
About your +2 school/collage:<br>
<textarea name="about_school+2" style="max-width:450px; max-height:100px; min-width:450px; min-height:100px;" ><?php echo $my_collage_data['about_school+2']; ?></textarea><br><br>
About your 12th board exams:<br>
<textarea name="about_twelve" style="max-width:450px; max-height:100px; min-width:450px; min-height:100px;" ><?php echo $my_collage_data['about_twelve']; ?></textarea>
   
   <br><br>
<input type="submit" id="my_button" value="update">

</form>

<?php

}

?>

</section>
</div>
