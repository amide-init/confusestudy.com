<?php
include 'core/init.php';
include 'include/header.php';
include 'include/navbar.php';
include 'include/searcheng.php';


?>

<div id="new_div">
<div id="my_que_div">
<?php
if(logged_in()=== true){
	?>
<div id="xlogo">
<a href="myarea" style="font-size:0.7em; color:green;">Add  your question</a>
</div>
<?php
}
?>
<h2> Question stating from newest....</h2>
<?php
if(isset($_GET['page']) === true){
$number = $_GET['page'];
}else{
	$number = '0';
}


$koston = all_question($number);

while($query_rows = mysql_fetch_assoc($koston)){
	?>
<section id="new_section">

	<?php
	echo '<a href="'.$query_rows['url'].'/'.$query_rows['q_id'].'/text">'.$query_rows['question'].'</a>';
	?>
	<p style="opacity:0.5;"> Number of answer <?php echo answer_count_by_q_id($query_rows['q_id']); ?></p>
	<footer style="color:gray;">
	<?php
echo 'Tags : ' . $query_rows['tag'] .  ' <br> Date : ' . $query_rows['date'];
	?>
	</footer>
	</section>
	
	<?php
}
?>

</div>
<div id="my_que_div">
<section id="new_section">
<h2>lesson starting from newest....</h2>
<?php
$my_lesson = mysql_query("SELECT * FROM `lession` ORDER BY `l_id` DESC LIMIT 8");
while($lesson_row = mysql_fetch_assoc($my_lesson)){
	  echo  '<a href="lesson/'.$lesson_row['url'].'/'.$lesson_row['l_id'].'">'. $lesson_row['name'].'('.question_count_by_l_id($lesson_row['l_id']).')</a><br><br>';
}
?>
<footer>
<a href="allpdf">more lesson..</a>
</footer>
</section>
<section id="new_section">
<h2>You can also attach youtube video as answer according to the question  </h2>
<?php
$my_video = show_one_video();

while($video = mysql_fetch_assoc($my_video)){
	$ques = mysql_fetch_assoc(question_from_q_id($video['q_id']));
 ?>
 <header><?php echo '<a href="http://localhost/mypage/'.$ques['url'].'/'.$video['q_id'].'/video">'.$ques['question'].'</a>'; ?></header>
 <iframe width="550" height="300" src="<?php  echo $video['video']; ?>" frameborder="0" allowfullscreen></iframe>
 <footer style="background:white; color:black; text-align:left;"> <?php echo '<p><strong>'.$video['title'] .'</strong><br>'.$video['description'].'</p>'; ?></footer>
 <?php
}

?>
</section>
<section id="new_section">
<h2>You can also upload a PDF as answer according to the question..</h2>
<?php 
$my_pdf = show_some_pdf();
while($pdf = mysql_fetch_assoc($my_pdf)){
	$ques_next = mysql_fetch_assoc(question_from_q_id($pdf['q_id']));
	

?>
 <header><?php echo '<a href="http://localhost/mypage/'.$ques_next['url'].'/'.$pdf['q_id'].'/pdf">'.$ques_next['question'].'</a>'; ?></header>
 <p><a href="<?php echo $pdf['pdf']; ?>"><?php echo $pdf['title']; ?></a></p><hr><hr>
 <?php
}
 ?>
</section>




</div>
</div>

<?php
include 'include/shortkey.php';
include 'include/footer.php';
?>