
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
if(empty($errors) === true) {
	if(user_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
$errors[]='This email \'' .$_POST['email']. '\' already exists Sorry!!!!';
}
	 if(preg_match("/\\s/",$_POST['email']) == true) {
		$errors[]='Write  the email in right sense...';
	}
	
}

}


if(isset($_GET['success']) && empty($_GET['success'])) {
	echo 'your profile is now update !!!';
}else{


if(empty($_POST) === false && empty($errors) === true) {
   $setting_data = array(
       
     
      'firstname'    => $_POST['fname'],
      'lastname'     => $_POST['lname'],
	  'email'        => $_POST['email'],
      'scname'       => $_POST['scname'],
      'intrest'      => $_POST['intrest'],   
	  'birth'        => $_POST['birth'],
	  'gender'       => $_POST['gender']
	  	  
   ); 
   change_setting($session_user_id, $setting_data);
   
 header('Location: setting?private&success'); 
  exit();
   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
	

	

	?>
<form action="" method="post">
firstname:<br>
<input type="text" id="hire" name="fname" value="<?php echo $user_data['firstname'];?>" ><br><br>
lastname:<br>
<input type="text" id="hire" name="lname" value="<?php echo $user_data['lastname'];?>" ><br><br>
email:<br>
<input type="text" id="hire" readonly name="email" value="<?php echo $user_data['email'];?>" ><br><br>
school/collage/university name:<br>
<input type="text" id="hire" name="scname" value="<?php echo $user_data['scname'];?>" ><br><br>
Intrested subject:<br>
<input type="text" id="hire" name="intrest" value="<?php echo $user_data['intrest'];?>">
   
   <br><br>
Date of birth:<br>
<input type="text" id="hire" name="birth" value="<?php echo $user_data['birth']; ?>" size="8" placeholder="DD/MM/YYYY" >
<br><br>
Gender:<br>
<select id="hire" name="gender">
   <option value="<?php echo $user_data['gender']; ?>"><?php echo $user_data['gender']; ?></option>
   <option value="Male">Male</option>
   <option type="Female">Female</option>
   <option type="Other">Other</option>
</select><br><br>
  
<input type="submit" id="my_button" value="update">

</form>

<?php

}

?>

</section>
</div>
