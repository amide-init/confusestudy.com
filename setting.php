<?php
include 'core/init.php';
protect_page();
include 'include/header.php';

include 'include/navbar.php';

?>
<div id="new_div">

<div id="my_que_div">
<h2>Choose one for update ....</h2>
<section id="new_section">
<ul>
<li><a href="setting?private">Update your Display information</a></li>
<li><a href="setting?school">Update school information</a></li>
<li><a href="setting?highSchool">Update high school(+2) information</a></li>
<li><a href="setting?graduation">Update your Graduation information</a></li>
<li><a href="setting?address">Update your address and pincode</a></li>
<li><a href="changepassword">changed password</a></li>
</ul>

</section>

</div>
<?php
if(isset($_GET['private']) === true && empty($_GET['private']) === true){
	include 'update/private.php';
}else if(isset($_GET['school']) === true && empty($_GET['school']) === true){
	include 'update/school.php';
}else if(isset($_GET['highSchool']) === true && empty($_GET['highSchool']) === true){
	
	include 'update/highSchool.php';
}else if(isset($_GET['graduation']) === true && empty($_GET['graduation']) === true){
	
	include 'update/graduation.php';
}else if(isset($_GET['address']) === true && empty($_GET['address']) === true){
	include 'update/address.php';
}
	?>
</div>
<?php
//include 'include/newbar.php';
include 'include/footer.php';
?>