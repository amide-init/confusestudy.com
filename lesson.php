<?php
include 'core/init.php';
include 'include/header.php';
if(empty($_GET['number'])===true){
	header("Location: ./index");
}elseif(isset($_GET['number']) === true) {
	

 $l_id = $_GET['number'];
}
$show   =  show_question_from_lesson($l_id);

$lesson =  mysql_fetch_assoc(show_lesson_from_l_id($l_id));
$user_info_one   = mysql_fetch_assoc(user_info_from_id($lesson['user_id']));
?>

<section id="lesson_div">
<a href="student?user=<?php echo $user_info_one['id']; ?>">
<div id="xlogo" style="font-size:0.8em;">
<?php echo $user_info_one['firstname']." ". $user_info_one['lastname'].'<br>'.$user_info_one['scname']; ?>
</div>
<div id="xlogo">
<div id="small_profile">
<img src="<?php echo 'http://www.confusestudy.com/'.$user_info_one['profile']; ?>">
</div>
</div></a>
<?php

 echo '<h1 style="color:#c4302b; margin:10px;">'.$lesson['name'].'('. question_count_by_l_id($l_id) .')</h1>' ;
 echo '<p style="text-align:left; opacity:0.3; font-weight:bold; font-style:serif;">'. $lesson['about'] .'</p>';
?>
</section>
<?php
if(mysql_num_rows($show)  >= 1){
	while($lesson_row = mysql_fetch_assoc($show)){
		?>
<section id="lesson_div">
<header style="color:#3b5998; font-weight:bold; margin:5px;">
<?php echo $lesson_row['question'] . '<br>'; ?>	
</header>
<?php
echo show_lesson_answer($lesson_row['sid'] , $lesson_row['q_id']);
?>
<footer>
</footer>


</section>

<?php
}
}
include 'include/footer.php';
