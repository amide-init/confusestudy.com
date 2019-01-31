<div id="new_div">



<section id="main_section">
<h2>Fill the form for your job profile</h2>
<?php
if(empty($_POST) === false){
	$required_fields = array('ten','twelve' , 'ten_score' ,'ten_total', 'twelve_score' , 'twelve_total' , 'ccity' , 'htown' , 'mobile' , 'postal_code');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill all the information correctly';
			break 1;
		}
	}
}

if(empty($errors) === true) {
	if(strlen($_POST['mobile']) !=10){
		$errors[] = 'this mobile number does not exist';
	}
	if(strlen($_POST['ten']) != 4 || strlen($_POST['twelve']) != 4){
		$errors[] = 'check your passing years';
	}
	
}	
if(empty($_POST) === false && empty($errors) === true) {
   $register_data = array(
      'ten'        => $_POST['ten'], 
      'twelve'     => $_POST['twelve'],
      'ten_score'    => $_POST['ten_score'],
      'twelve_score'     => $_POST['twelve_score'],
      'ten_total'       => $_POST['ten_total'],
      'twelve_total'      => $_POST['twelve_total'],  
       'ccity'       => $_POST['ccity'],
      'htown'      => $_POST['htown'],	
      'country'       => $_POST['country'],
      'postal_code'      => $_POST['postal_code'],
     'mobile'       => $_POST['mobile']
      
       	  
   ); 
   echo 'ok fie';	
} 
	print_r($errors);
?>


<form action="" method="post">
<table style="float:center; color:#3b5998; font-size:110%; font-style:italic; font-weight:bold;">
<tr>
    <td>10th passing year:</td>
    <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;"  placeholder="2011" name="ten" size="5"></td>
</tr>	
<tr>
    <td>12th passing year:</td>
    <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" placeholder="2013"  name="twelve" size="5"></td>
</tr>
<tr>
    <td>score in 10th:</td>
          <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="ten_score" size="4">
	 /
	<input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="ten_total" size="4"></td>
</tr>
<tr>
    <td>Score in 12th: </td>
      <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="twelve_score" size="4">
	 /
	<input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;"  name="twelve_total" size="4"></td>
</tr>
<tr>
    <td>Current City:</td>
    <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;"  name="ccity"></td>
</tr>
<tr>
    <td>Home Town:</td>
    <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;"  name="htown"></td>
</tr>
<tr>
    <td>Country:</td>
    <td><input type="text" style="color:#c4302b8; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="country" ></td>
</tr>
<tr>
    <td>Mobile number:</td>
    <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="mobile" size="8"></td>
</tr>
<tr>
    <td>Postal code:</td>
    <td><input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="postal_code" size="6"></td>
</tr>
</table>
<input type="submit" name="submit" style="background:#3b5998; color:white; padding:2px;">
</form>
</section>
</div>