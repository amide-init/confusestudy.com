<?php
include 'core/init.php';
protect_page();
include 'include/header.php';
 include 'include/navbar.php';
?>



<div id="new_div">
<div id="my_que_div">

<?php
if(empty($_POST) === false){
	$required_fields = array( 'co_name'  , 'min_salary' , 'max_salary' , 'co_number' , 'postal_code' , 'add01' );
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill all the information correctly';
			break 1;
		}
	}
	if(empty($errors) === true) {
	if(strlen($_POST['co_number']) != 10){
		$errors[] = 'your moblile phone number is not valid';
	} 
	if(strlen($_POST['postal_code']) != 6){
	  $errors[] = 'use valid six digit postal/pin code of your area';
	}
	
}	
}

if(isset($_GET['success']) && empty($_GET['success'])) {
	echo '<p style="color:#3b5998; padding:10px; margin:10px; font-weight:bold;">Your job submission have successfully loaded......</p> ';
}else{


if(empty($_POST) === false && empty($errors) === true) {
   $hire_data = array(
      'company'        => $_POST['company'], 
      'co_name'     => $_POST['co_name'],
      'qualification'    => $_POST['qualification'],
      'min_salary'     => $_POST['min_salary'],
      'max_salary'    =>  $_POST['max_salary'],
        'co_number'  =>    $_POST['co_number'],
      	  'postal_code' =>  $_POST['postal_code'],
		  'address'  =>  $_POST['add01'] . " " . $_POST['add02'] . " " .  $_POST['add03'],
		  'web' =>  $_POST['web'],
		  'required' =>  $_POST['required'],
		  'about_job' => $_POST['about_job'],
		  'date'      => date("y.m.d"),
		  'user_id'   => $session_user_id
   ); 
   hire_job($hire_data);
    header('Location: hire?success'); 
  exit();
  

   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}
}	
?>

<form action="" method="post">
<table id="job_table">
  <tr>
  <td>
       hire for:
  </td>
  <td>
  <select id="hire" name="company">
    <option value="school">school</option>
	<option value="college">college</option>
	<option value="institute">institute</option>
	<option value="private company">private company</option>
	<option value="Govt. company">Govt. company</option>
	<option value="Coaching">coaching</option>
	<option value="private tuitions">private tuitions</option>
	
   </select>
   </td>
 </tr>
 <tr> 
    <td>
      name/company name : 
	</td>
    <td>
	<input type="text" id="hire" name="co_name" placeholder=" ex : narendra modi">
	</td>
 </tr>
 <tr>
    <td>
     minimum qualification:</td>
	<td>
     <select id="hire" name="qualification">
    <option value="below secondry education">below secondry education</option>
	<option value="secondry education">secondry education( 10th)</option>
	<option value="intermediate">intermediate( 12th )</option>
	<option value="Graduation">graduation</option>
	<option value="Master">master</option>

</select></td></tr>
<tr><td>salary</td>

<td><input type="text" id="hire" name="min_salary" placeholder="minimum salary"><br>
<input type="text" id="hire" name="max_salary" placeholder="maximum salary"></td></tr>
<tr>
  <td>contact number(mobile) </td>
  <td><input type="text" id="hire" name="co_number" placeholder="ex: 8989898989"></td>
</tr>
<tr>
  <td>postal code</td>
  <td><input type="text" id="hire" name="postal_code" placeholder="ex: 700032"></td>
</tr>
<tr>
  <td>address</td>
  <td><input type="text" id="hire" name="add01" placeholder="line one"><br>
  <input type="text" id="hire" name="add02" placeholder="line two"><br>
  <input type="text" id="hire" name="add03" placeholder="line three"></td>
</tr>
<tr>
  <td>website (optional)</td>
  <td><input type="text" id="hire" name="web" placeholder="ex : www.confusestudy.com"></td>
</tr>
<tr>
  <td>required empoly</td>
  <td> <select id="hire" name="required">
    <option value="1">1</option>
	<option value="1 to 5">below 5</option>
	<option value="5 to 10">5 to 10</option>
	<option value="10 to 20">10 to 20</option>
	<option value="20 to 50">20 to 50</option>
	<option value="more than 50">more than 50</option>
	</select></td>
</tr>
<tr>
 <td>about job (optional)</td>
 <td><textarea name="about_job" id="hire" rows="4" cols="40" placeholder="write somthing about this job..."></textarea></td>
</tr>
<tr><td><colspan="2"><input type="submit" style="background: linear-gradient(#67ae55, #578843);
    background-color: #69a74e;
    box-shadow: inset 0 1px 1px #a4e388;
    border-color: #3b6e22 #3b6e22 #2c5115;
	font-weight:bold;
	font-size:0.8em;
	margin-top:20px;
	color:white; padding:8px; " value="submit"></colspan><td></tr>
</table>
</form>

</div>
</div>


<?php
include 'include/footer.php';

?>