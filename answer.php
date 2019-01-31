<?php

include 'core/init.php';

 include 'include/header.php';
 include 'include/navbar.php';
	include 'include/searcheng.php';
	if(empty($_GET['title']) === true || empty($_GET['question']) === true  || empty($_GET['mode']) === true){
		header("Location: ./index");
	}
	$title = $_GET['title'];
	$quara = $_GET['question'];
$mode = $_GET['mode']
?>

<div id="new_div">

<section id="nav_section">
<ul>
    <li><a href="http://localhost/mypage/<?php echo 'answer/'.$_GET['title'].'/'.$_GET['question']; ?>">Text( <?php echo answer_count_by_q_id($quara); ?> )</a></li>
	<li><a href="http://localhost/mypage/<?php echo 'pdf/'.$_GET['title'].'/'.$_GET['question']; ?>">PDF( <?php echo pdf_count_by_q_id($quara); ?> )</a></li>
	<li><a href="http://localhost/mypage/<?php echo 'videos/'.$_GET['title'].'/'.$_GET['question']; ?>">Videos( <?php echo video_count_by_q_id($quara); ?> )</a></li>
</ul>
</section>
</div>
<div id="new_div">

<p>
<?php
$title = $_GET['title'];
$quara = $_GET['question'];
$mode = $_GET['mode'];
 $kostion = all_question_from_q_id($title , $quara);

 
if(mysql_num_rows($kostion) == 1){
				
				
				
				while($query_rows=mysql_fetch_assoc($kostion)){
					
					
				
				
			
echo '<h1>'.$query_rows['question'].'</h1>';


   
   $info = $query_rows['sid'];
   

				}
}			
 
?>

</div>
<?php
include 'include/anstext_pdf_videos.php';
 

?>
<div id="new_div">

<?php
if(logged_in()===true){
	if($mode == 'answer'){
	


if(isset($_POST['my_answer']) === true) {
	$my_answer = $_POST['my_answer'];
if(empty($my_answer)=== true){
	echo 'write your answer...';
}else{
	fill_answer($quara , $_SESSION['id'] , $my_answer );
   header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
   die;

  

		
	
}
}
?>
<form action="" id="textareaeditor" method="post">
<textarea class="ckeditor"  name="my_answer" ">
</textarea><br>
<input type="submit" value="my answer" id="my_button">
</form>





<?php
	}else if($mode == 'pdf'){
		
if(isset($_FILES['pdf']) === true) {
	if(empty($_FILES['pdf']['name']) === true) {
		echo 'plz choose a file';
	} else {
		$allowed = array('pdf' , 'doc' ,'docx');
		
		$file_name = $_FILES['pdf']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['pdf']['tmp_name'];
		
	
		
		             
 		
		$title = $_POST['title'];
		
		if(in_array($file_extn, $allowed) === true) {
			
			
			fill_answer_pdf($quara , $session_user_id, $file_temp, $file_extn , $title );
			  header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
   die;
		

			
		} else {
			echo 'Incorrect file type. Allowed:';
			echo implode(', ', $allowed);
		}
	}
}

		?>
		<div id="my_que_div">
		<h2>Your answer...(use only less than 4 MB file)</h2>
		<form action="" method="post" enctype="multipart/form-data">
		Title name :<br><input type="text" name="title"><br>
         <input type="file" name="pdf">

       <input type="submit" value="My Answer" id="my_button">
</form>
	</div>	
		<?php
	}else if($mode == 'videos'){
		if(isset($_POST['title']) === true && isset($_POST['link'])=== true && isset($_POST['description']) === true) {
	    $title       = $_POST['title'];
		$link        = $_POST['link'];
		$description = $_POST['description'];
         if(empty($title)=== true || empty($link) === true){
	       echo 'write your title name and youtube video link atleast';
              }else{
				  $link_extn = end(explode('/', $link));
	               add_videos($quara , $title , $_SESSION['id'] , $link_extn ,$description  );
				    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
   die;
		
				   
	
}
}
	
		?>
		<div id="my_que_div">
		<h2>Add Youtube videos</h2>
		<form action="" method="post">
		Title name :<br><input type="text" placeholder="channel name or anything " name="title"><br><br>
		Youtube video link:<br><input type="text"  style ="width:80%;" placeholder=" example: https://youtu.be/G62HrubdD6o " name="link"><br><br>
		description :<br><textarea name="description" placeholder="Write short description about your videos" style="max-width:500px; max-height:100px; min-width:500px; min-height:100px; "></textarea><br>
		
		<input type="submit" value="Add video" id="my_button">
		
		</form>
		</div>
		<?php

	}
}else{
	echo 'if you want to add your answer for this question then login/sinup first....';
}
?>
</div>



<?php
//include 'include/newbar.php';
include 'include/footer.php';
?>