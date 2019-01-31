<?php


include 'core/init.php';
protect_page();

include 'include/header.php';
 include 'include/navbar.php';
include 'include/searcheng.php';
 $user_info_one   = mysql_fetch_assoc(user_info_from_id($session_user_id));
 $user_info_quara = question_info_from_id($session_user_id);
 $show_answer     = show_all_answer_by_id($session_user_id);
 $show_pdf     	  = show_pdf_by_id($session_user_id);
 $show_videos     = show_video_by_id($session_user_id);
 $show_follower   = show_all_follower_by_id($session_user_id);
 $show_lession    = select_lession_by_id($session_user_id);
?>
<div id="new_div">
<div id="my_que_div">

<section id="new_section">
<h2><?php echo $user_data['firstname'];?>'s profile </h2>
<div id="profile">
<?php
if(isset($_FILES['profile']) === true) {
	if(empty($_FILES['profile']['name']) === true) {
		echo 'plz choose a file';
	} else {
		$allowed = array('jpg' , 'jpeg', 'gif', 'png');
		
		$file_name = $_FILES['profile']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['profile']['tmp_name'];
		
		if(in_array($file_extn, $allowed) === true) {
			change_profile_image($session_user_id, $file_temp, $file_extn);
		} else {
			echo 'Incorrect file type. Allowed:';
			echo implode(', ', $allowed);
		}
	}
}



if(empty($user_data['profile']) === false) {
	echo '<img src="', $user_data['profile'], '" alt="',$user_data['firstname'], '\'s Profile image">';
}
?>

</div>

<hr>
<p>Update Profile Image</p>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="profile">
<input type="submit" value="upload" style="background:#3b5998; color:white; font-weight:bold; padding:4px;">

</form>

</section>
<section id="new_section">

<div id="xlogo" style="font-size:0.7em;">
<ul>
    <li><a href="profile">My profile</a></li>
   <li><a href="profile?&questions">Question( <?php echo  question_count_by_id($session_user_id); ?> )</a></li>
   <li><a href="profile?&answer">Answer( <?php echo answer_count_by_id($session_user_id); ?> )</a></li>
   <li><a href="profile?&pdf">PDF( <?php echo pdf_count_by_id($session_user_id); ?> )</a></li>
   <li><a href="profile?&videos">videos( <?php echo video_count_by_id($session_user_id); ?> )</a></li>
   <li><a href="profile?&lesson">Lesson( <?php echo lession_count_by_id($session_user_id); ?> )</a></li>
   <li><a href="profile?&follower">Followers(  <?php echo follower_count_by_id($session_user_id); ?> )</a></li>
   <li>likes( <?php  echo like_count_by_id($session_user_id); ?> )</li>
 
</ul>
</div>
</section>
<section id="new_section" >




<table>
<tr>

<td>Name:</td><td>
<?php
 echo $user_data['firstname'].' '.$user_data['lastname'];?>
 </td></tr>
 <tr>
 <td>school/collage/univesity:</td><td>
 <?php 
 echo $user_data['scname'];
 ?></td></tr>
 
 <tr>
 <td>email_id:</td><td>
 <?php 
 echo $user_data['email'];
 ?><td></tr>
 


 <tr>
   <td>Intrested subject:</td><td>
   <?php
   echo $user_data['intrest'];
   ?></td></tr>

 <tr>
 
   <td><a href="./profile.php?question">No. of submit question:</a></td><td>
 <?php
 
 
echo question_count_for_id($session_user_id);

 
 ?></td></tr>
 <tr>
 
   <td>Total Score:</td><td>
 <?php
 
 
$number = question_count_for_id($session_user_id);
$total = $number + $number*$number*3;
echo $total; 
 ?></td></tr>
 </table>
 <div id="xlogo">
<a href="setting?private" title="edit your profile">Edit...</a>
</div>
</section>
<div id="xlogo">
<a href="jprofile.php" id="my_button">My Resume</a> 
</div>

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
		 <iframe width="500" height="300" src="<?php  echo $my_videos['video']; ?>" frameborder="0" allowfullscreen></iframe>
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
		 <section id="new_section">
		 <header>
		 <div id="mid_profile">
		 <img src="<?php echo $follower_info['profile']; ?>"/>
		 </div>
		 </header>
		  
		  
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
<h2><?php echo $user_data['firstname'].'\'s'; ?> school ( 10th board ) information...</h2>
<table>
    <tr>
	  <td>school name</td>
	  <td>::</td>
	  <td><?php echo $my_school_data['name_of_school']; ?></td>
	  
	</tr>
	<tr><td><hr></td><td></td><td><hr></td></tr>
	<tr>
	  <td>Passing year</td>
	  <td>::</td>
	  <td><?php echo $my_school_data['passing_year']; ?></td>
	</tr>
	<tr><td><hr></td><td></td><td><hr></td></tr>
	<tr>
	  <td>Grade/Marks</td>
	  <td>::</td>
	  <td><?php echo $my_school_data['grade']; ?></td>
	</tr>
	<tr><td><hr></td><td></td><td><hr></td></tr>
	<tr>
	  <td>About my school</td>
	  <td>::</td>
	  <td><?php echo $my_school_data['about_school']; ?></td>
	</tr>
	<tr><td><hr></td><td></td><td><hr></td></tr>
	<tr>
	  <td>About my 10th board exams</td>
	  <td>::</td>
	  <td><?php echo $my_school_data['about_ten']; ?></td>
	</tr>
	
</table>
<div id="xlogo">
<a href="setting?school">Edit...</a>
</div>
</section>
<section id="new_section">
<h2><?php echo $user_data['firstname'].'\'s'; ?> 12th board information...</h2>

<table>
   <tr>
      <td>Name of school/collage</td>
	  <td>::</td>
	  <td><?php  echo $my_collage_data['sc_name']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
      <td>Passing Year</td>
	  <td>::</td>
	  <td><?php  echo $my_collage_data['+2passing_year']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
      <td>Garde/Marks</td>
	  <td></td>
	  <td><?php  echo $my_collage_data['+2grade']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
      <td>About my School/collage</td>
	  <td>::</td>
	  <td><?php  echo $my_collage_data['about_school+2']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
     <tr>
      <td>About my board 12th board exams </td>
	  <td>::</td>
	  <td><?php  echo $my_collage_data['about_twelve']; ?></td>
   </tr>
</table>
<div id="xlogo">
<a href="setting?highSchool">Edit...</a>
</div>
</section>
<section id="new_section">
<h2>Graduation...</h2>
<table>
   <tr>
       <td>College Name</td>
	   <td>::</td>
	   <td><?php echo $graduation_data['collage_name']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
       <td>Course Name</td>
	   <td>::</td>
	   <td><?php echo $graduation_data['course']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
       <td>Starting Year</td>
	   <td>::</td>
	   <td><?php echo $graduation_data['starting_year']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
       <td>Expected passing Year</td>
	   <td>::</td>
	   <td><?php echo $graduation_data['passing_year']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
       <td>About my Graduation</td>
	   <td>::</td>
	   <td><?php echo $graduation_data['about_graduation']; ?></td>
   </tr>
   <tr><td><hr></td><td></td><td><hr></td></tr>
   <tr>
       <td>About my collage</td>
	   <td>::</td>
	   <td><?php echo $graduation_data['about_collage']; ?></td>
   </tr>
</table>
<div id="xlogo">
<a href="setting?graduation">Edit...</a>
</div>
</section>
<?php 
 }
 ?>
</div>
</div>

<?php
//include 'include/newbar.php';
include 'include/footer.php';
?>