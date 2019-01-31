<?php
if($mode == 'answer'){

$all_answer = show_answer($quara);


 
 while($answer_rows = mysql_fetch_assoc($all_answer)){
	
	$ref = $answer_rows['s_id'];
	$answer_id = $answer_rows['a_id'];
	
	$my_info = mysql_fetch_assoc(user_info_from_id($ref));
	 ?>
	<div id="another_new_div">
	<div id="wide_new_section">
	<?php

	echo '<h2>Answer:</h2>'.$answer_rows['answer'].'<br>';
	
	?><div id="small_profile">
	<a href="student?user=<?php echo $ref; ?> "><img src="<?php echo 'http://localhost/mypage/'.$my_info['profile']; ?>"></a>
	</div>
	<footer>
	<?php
	echo $my_info['firstname'].'<br>';
	echo $my_info['scname'];
	if(logged_in() === true){
	?>
	<div id="xlogo" style="font-size:0.8em;">
	<ul>
	<li><a href="like?aid=<?php echo $answer_id; ?>&quara=<?php echo $quara; ?>&sid=<?php echo $ref; ?>">like(<?php echo like_count($answer_id ); ?>)</a></li>
	<li><a href="followers?myid=<?php echo $session_user_id; ?>&hisid=<?php echo $ref; ?>&quara=<?php echo $quara; ?>">Follow( <?php echo follower_count_by_id($ref); ?> )</a></li>
	
	</ul>
	</div>
	<?php } ?>
	</footer>
	</div></div>
 <?php
 }

}else if($mode == 'pdf'){
	$show_Pdf = show_pdf($quara);
	 while($answer_rows = mysql_fetch_assoc($show_Pdf)){
	
	$ref = $answer_rows['user_id'];
	$my_info = mysql_fetch_assoc(user_info_from_id($ref));
	 ?>
	<div id="new_div">
	<div id="my_que_div">
	
	<?php
	echo  '<h2>'.$answer_rows['title'].'<h2>';
      echo '<a href="'.$answer_rows['pdf'].'">click here for pdf...</a>';
	
	
	?><div id="small_profile">
	<img src="<?php echo $my_info['profile']; ?>">
	</div>
	<footer>
	<?php
echo $my_info['firstname'].'<br>';
	echo $my_info['scname'];
	
	?>
	<div id="xlogo">
	.
	</div>
	</footer>
	</div></div>
 <?php
	 }
}else{
		$show_videos = show_videos($quara);
	 while($answer_rows = mysql_fetch_assoc($show_videos)){
	
	$ref = $answer_rows['user_id'];
	$my_info = mysql_fetch_assoc(user_info_from_id($ref));
	 ?>
	<div id="new_div">
	<div id="my_que_div">
	<section id="new_section">
	<iframe width="550" height="300" src="<?php echo $answer_rows['video']; ?>" frameborder="0" allowfullscreen></iframe>
	
	</section>
	<footer>
	<div id="small_profile">
	<img src="<?php echo $my_info['profile']; ?>">
	</div>
	<?php
	echo $my_info['firstname']  ." " . $my_info['lastname'].'<br>';
	echo $my_info['scname'];
	?>
	
	<footer>
	</div></div>
	<?php
	 }
}
?>