<?php
include 'core/init.php';

include 'include/header.php';
include 'include/navbar.php';


if(empty($_GET['user'])===true){
	header("Location: ./index");
}elseif(isset($_GET['user']) === true) {
	

 $user_id = $_GET['user'];
}
 $user_info_one   = mysql_fetch_assoc(user_info_from_id($user_id));
 $user_info_quara = question_info_from_id($user_id);
 $show_answer     = show_all_answer_by_id($user_id);
 $show_pdf     	  = show_pdf_by_id($user_id);
 $show_videos     = show_video_by_id($user_id);
 $show_follower   = show_all_follower_by_id($user_id);
 $show_lession    = select_lession_by_id($user_id);
 ?>

 <div id="new_div">

 <div id="my_que_div">
 <h2><?php echo $user_info_one['firstname'].'\'s profile' ?></h2>

 <section id="new_section" style="color:#3b5998; font-style:italic; ">
 <div id="mid_profile">
 <img src="<?php echo $user_info_one['profile']; ?>">
 </div>

  <table>
  <tr>
    <td>Full name</td>
    <td>::</td> 
    <td><?php echo $user_info_one['firstname'] . " " . $user_info_one['lastname'];?></td>
 </tr>
 <tr>
    <td>School/Collage Name</td>
    <td>::</td> 
    <td><?php echo $user_info_one['scname'];?></td>
 </tr>
 <tr>
    <td>Email</td>
    <td>::</td> 
    <td><?php echo $user_info_one['email']  ;?></td>
 </tr>
 <tr>
    <td>Date of birth</td>
    <td>::</td> 
    <td><?php echo $user_info_one['birth'];?></td>
 </tr>
  <tr>
    <td>Intrested subject</td>
    <td>::</td> 
    <td><?php echo $user_info_one['intrest'];?></td>
 </tr>
 </table>
 </section>
 <section id="new_section">
 <ul>
 <li><a href="student?user=<?php echo $user_id; ?>&questions">Question( <?php echo  question_count_by_id($user_id); ?> )</a></li>
 <li><a href="student?user=<?php echo $user_id ?>&answer">Answer( <?php echo answer_count_by_id($user_id); ?> )</a></li>
 <li>Score( <?php echo 7*question_count_by_id($user_id) + 15*answer_count_by_id($user_id); ?> )</li>
 <li><a href="student?user=<?php echo $user_id; ?>&pdf">PDF( <?php echo pdf_count_by_id($user_id); ?> )</a></li>
 <li><a href="student?user=<?php echo $user_id; ?>&videos">videos( <?php echo video_count_by_id($user_id); ?> )</a></li>
  <li><a href="student?user=<?php echo $user_id; ?>&lesson">Lesson( <?php echo lession_count_by_id($user_id); ?> )</a></li>
 <li><a href="student?user=<?php echo $user_id; ?>&follower">Followers(  <?php echo follower_count_by_id($user_id); ?> )</a></li>
 <li>likes( <?php  echo like_count_by_id($user_id); ?> )</li>
 </ul>
 
 </section>
 </div>
 <div id="my_que_div">
 <?php
 if(isset($_GET['questions'] )=== true  && empty($_GET['questions']) === true){
	 ?>
 <h2><?php  echo mysql_num_rows($user_info_quara); ?> question is contributed by  <?php echo $user_info_one['firstname']; ?></h2>
 
 <?php
 if(mysql_num_rows($user_info_quara) >= 1){
     
	      while($query_rows = mysql_fetch_assoc($user_info_quara)){
			  ?>
	<section id="new_section">

	
	<?php
	echo '<a href="'.$query_rows['url'].'/'.$query_rows['q_id'].'/text">'.$query_rows['question'].'</a>';
	?>
	<br><br>
	<p style="opacity:0.5;">Number of Answer <?php echo answer_count_by_q_id($query_rows['q_id']);?></p>
	
	<footer style="color:gray;">
	<?php
	echo 'Tag : ' . $query_rows['tag']. '<br> Date : ' . $query_rows['date'];
	?>
	</footer>
	</section>
	<?php
		  }
 
 } 
 }else if(isset($_GET['answer'] )=== true  && empty($_GET['ansewer']) === true){
	 if(mysql_num_rows($show_answer) >= 1){
	 while($my_ans = mysql_fetch_assoc($show_answer)){
		 ?>
		 <section id="new_section" style="padding:5px;">
		 <header>
		 <?php echo only_question_from_q_id($my_ans['que_id']); ?>
		 </header>
		 <?php echo '<p style="font-style:italic;">'.$my_ans['answer'].'</p>'; ?>
		 <br> <p style="opacity:0.4;">Like (<?php echo like_count($my_ans['a_id']); ?>)</p>
		 </section>
		
		 <?php
	 }
 }
 }else if(isset($_GET['pdf'] )=== true  && empty($_GET['pdf']) === true){
		 if(mysql_num_rows($show_pdf) >= 1){
	 while($my_pdf = mysql_fetch_assoc($show_pdf)){
		 ?>
		 <section id="new_section">
		  <header>
		 <?php echo '<i>[pdf for]</i> '. only_question_from_q_id($my_pdf['q_id']); ?>
		 </header>
		 <hr><br>
		 <?php echo '<a href="'.$my_pdf['pdf'].'">'.$my_pdf['title'].'</a>'; ?>
		<br>
		<p style="opacity:0.4;">use this link above</p>
		<br>
		 </section>
		 <?php
	 }
 } 
 }else if(isset($_GET['videos'] )=== true  && empty($_GET['videos']) === true){
	 		 if(mysql_num_rows($show_videos) >= 1){
	 while($my_videos = mysql_fetch_assoc($show_videos)){
		 ?>
		 <section id="new_section">
		  <header>
		 <?php echo '<i>[video for]</i> '. only_question_from_q_id($my_videos['q_id']); ?>
		 </header>
		 <iframe width="550" height="300" src="<?php  echo $my_videos['video']; ?>" frameborder="0" allowfullscreen></iframe>
		 <hr>
		 Description:<br>
		 <?php echo  $my_videos['description']; ?>
		 </section>
		 <?php
	 }
 }
 }else if(isset($_GET['follower'] )=== true  && empty($_GET['follower']) === true){
		 		 if(mysql_num_rows($show_follower) >= 1){
	 while($my_follower = mysql_fetch_assoc($show_follower)){
		 $follower_info = mysql_fetch_assoc(user_info_from_id($my_follower['session_id']));
		 ?>
		 <section id="new_section" style="color:#3b5998; font-weight:bold;">

		 <div id="mid_profile">
		 <img src="<?php echo $follower_info['profile']; ?>"/>
		 </div>
		<table>
  <tr>
    <td>Full name</td>
    <td>::</td> 
    <td><?php echo $follower_info['firstname'] . " " . $follower_info['lastname'];?></td>
 </tr>
 <tr>
    <td>School/Collage Name</td>
    <td>::</td> 
    <td><?php echo $follower_info['scname'];?></td>
 </tr>
 </table>
 <br><br>
		  <a href="student?user=<?php echo $follower_info['id']; ?>" id="my_button">view profile</a>
		  follower(<?php  echo follower_count_by_id($follower_info['id']); ?>)
	
		 </section>
		 <?php
	 }
 } 
 }else if(isset($_GET['lesson'] )=== true  && empty($_GET['lesson']) === true){

	 if(mysql_num_rows($show_lession) >= 1){
	 while($my_lession	 = mysql_fetch_assoc($show_lession)){
		
		 ?>
		 <section id="new_section" style="text-align:center; border:2px solid #3b5998; ">
	     
		 <?php echo '<a href="lesson?number='.$my_lession['l_id'].'">'.$my_lession['name'];  ?>(<?php echo question_count_by_l_id($my_lession['l_id']);?>)</a><br><br><hr>
         <footer style="background:white; text-align:left; color:black; opacity:0.4;">
		 <?php echo $my_lession['about'];  ?>
         </footer>
		  
		 </section>
	 <?php
	 }
	 }
 }else{
	 ?>
	 <section id="new_section">
	 
	 </section>
	 <?php
 }
 ?>

 </div>

 
 </div>
 <?php
 
 



include 'include/footer.php';
?>