<?php
include 'core/init.php';
include 'include/header.php';
include 'include/navbar.php';
$time_now=mktime(date('h')+4,date('i')+30,date('s'));
           $date = date('d-m-Y H:i:s', $time_now);
?>
<div id="new_div">
<?php
if(isset($_GET['id'] ) === true && isset($_GET['apply']) === true){
$hire_id = $_GET['id'];
$apply_id = $_GET['apply'];
}

?>

	
<div id="my_que_div">
<h2>Final submission...</h2>
<?php
if(empty($_POST) === false){
	$required_fields = array('full_name', 'full_address0', 'full_address1', 'email', 'mobile' );
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill all the information correctly';
			break 1;
		}
	}
if(empty($errors) === true) {
	if(apply_exists($session_user_id , $hire_id) === true) {
		$errors[]='You are already apply for this job...';
	}
	 if(preg_match("/\\s/",$_POST['email']) == true) {
		$errors[]='Write  the email in right sense...';
	}
	
	
}

}

if(empty($_POST) === false && empty($errors) === true) {
   $apply_data = array(
      'user_id'        => $session_user_id, 
      'hire_id'        => $hire_id,
      'about'          => $_POST['about'],
      'date'           => $date   	  
   ); 
   apply_user_job($apply_data );
   echo '<script type="text/javascript">window.location= "./findjob?success"</script>';
   die();
   
}else if (empty($errors) === false) {
	echo output_errors($errors);
}

?>

<form action="" method="post" style="line-height:1.5em;">
<table>
<tr>
<td>Full name </td>
<td>: :</td>
<td  id="hire"><input type="text" name="full_name"  value="<?php echo $user_data['firstname'] . " " . $user_data['lastname'];?>"></td>
</tr>
<tr>
<td> Address</td>
<td>: :</td>
<td  id="hire"><input type="text" name="full_address0"  value="<?php echo $user_address['current_address']; ?>"><br>
    <input type="text" name="full address1"  value="<?php echo $user_address['pincode']; ?>"></td>
</tr>
<tr>
<td>Email </td>
<td>: :</td>
<td id="hire"><input type="text" name="email"  value="<?php echo $user_data['email'];?>"></td>
</tr>
<tr>
<td>Mobile number </td>
<td>: :</td>
<td id="hire"><input type="text" name="mobile"  value="<?php echo $user_address['mobile'];?>"></td>
</tr>
<tr>
<td>About yourself </td>
<td>: :</td>
<td id="hire"><textarea type="text" name="about" style="max-width:200px; min-width:200px; min-height:100px;" ></textarea></td>
</tr>
<tr><td><input type="submit" id="my_button"  value="Apply"></td></tr>
</table>
</form>
</div>	

</div>
<?php
include 'include/footer.php';
?>