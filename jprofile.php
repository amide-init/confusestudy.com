<?php
include 'core/init.php';
protect_page();
include 'include/header.php';
include 'include/navbar.php';
?>

<div id="new_div">
<!-- students database-->
<aside>
<div id="profile" style="background:white;" >
<img src="<?php echo $user_data['profile']; ?>">
</div>
</aside>
<div id="my_que_div">
<section id="new_section">
<h2>Basic</h2>
<ul>
      <li>Name : <?php echo $user_data['firstname'] . " " . $user_data['lastname']; ?></li>
	  <li>Collage/school :  <?php  echo $user_data['scname'];?></li>
	  <li>Email : <?php  echo $user_data['email']?></li>
	  <li>Date of birth : <?php echo $user_data['birth'];  ?></li>
	  <li>Gender : <?php echo $user_data['gender']; ?></li>
	 
</ul>
</section>

<section id="new_section">
<h2>Address...</h2>
<ul> 
    <li>Home Town : <?php echo $user_address['home_town']; ?></li>
	<li>Current city : <?php echo $user_address['current_address']; ?></li>
	<li>mobile number : <?php echo $user_address['mobile']; ?></li>
	<li>Pincode : <?php echo $user_address['pincode']; ?></li>
</ul>
</section>
<section id="new_section">
<button id="my_button" style="margin:0px; width:100%;" onclick="window.print()">Print...</button>
</section>
</div>
</div>



<?php
include 'include/footer.php';
?>