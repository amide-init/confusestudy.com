<?php
include 'core/init.php';
include 'include/header.php';
include 'include/navbar.php';
include 'include/searcheng.php';
?>
<div id="new_div">
<section id="new_section">

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo '<p style="color:green;">Your lesson has been created !!!</p>';
}elseif(isset($_POST['lesson']) === true && isset($_POST['about']) === true){
	$lesson  = $_POST['lesson'];
	$about    = $_POST['about'];
	if(empty($lesson) === true){  
	     echo 'lesson name is empty';
     }else{
		 create_lesson($session_user_id, $lesson , $about);
		 header('Location: createlesson?success');
		 die();
	 }
	
}




?>
<form action="" method="post">
<input type="text" id="hire" placeholder="write the name of the  lesson.." style="width:84%;" name="lesson"><br>
<textarea name="about" cols="60" placeholder="write here about your lesson...." rows="3"style="max-width: 500px;" ></textarea><br>
<input type="submit"  id="my_button" value="create lesson"><br>
</form>
</section>
</div>
<?php
include 'include/footer.php';
?>