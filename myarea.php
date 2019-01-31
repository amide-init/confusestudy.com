 <?php
include 'core/init.php';
	   protect_page();
 include 'include/header.php';
 include 'include/navbar.php';
 include 'include/searcheng.php';
 $my_lession = select_lession_by_id($session_user_id);
      $questions       = show_last_question_from_user_id($session_user_id);
	  $row = mysql_fetch_assoc($questions);
		  $time_now=mktime(date('h')+4,date('i')+30,date('s'));
           $date = date('d-m-Y H:i:s', $time_now);

		  ?>
	
		 
		 <div id="new_div">
		 <div id="my_que_div">
		 <h2>Upload your question....</h2>
		 

		  <?php
	
			if(empty($_POST) === false){
	$required_fields = array('confusion' , 'tag');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'fill subject , topic , class ,  question first';
			break 1;
		}
	}
	
	if(empty($errors) === true) {
		if(strlen($_POST['confusion']) <8) {
		$errors[]='Type the question  ';
	}
	}
	
}
if(isset($_GET['success']) && empty($_GET['success'])) {
	echo '<p style="color:green;">Thank you for your contribution , this question and your answer really helpfull for other. </p><hr>';
	
	echo '<p style="color:balck; margin:10px;">'.$row['question'].'</p>';
    echo '<p style="margin:10px; text-align:center;"><a href="answer?question='.$row['q_id'].'&mode=text">Add your answer...</a></p>';

}else{

if(empty($_POST) === false && empty($errors) === true) {
	
   $question_data = array(
     
      'question'       => $_POST['confusion'],
	  'tag'            => $_POST['tag'],
	  'url'            => createSeoUrl($_POST['confusion']),
      'lession'        => $_POST['lession'],
      'sid'            => $session_user_id,
	  
      'date'	       =>  $date
   );
   question_entry($question_data);
  echo '<script type="text/javascript">window.location= "./myarea?success"</script>';
   exit();
   
}

?>
<form action="" method="post" >
<table>


<tr><td>Question:<br>
<textarea type="text" name="confusion" cols="60" placeholder="write your question...." rows="3"style=" max-width: 500px; " ></textarea></td>
</tr>

<tr><td>Tags:<br>
<textarea type="text" name="tag" placeholder="add some tag like topic , classs , subject or anything..." cols="60" rows="3"style=" max-width: 500px; " ></textarea></td>
</tr>
<td>Add in lession:
<select name="lession">
<option value="0" id="hire">individual</option>
<?php
if(mysql_num_rows($my_lession) >=1){
	while($lession_row = mysql_fetch_assoc($my_lession)){
		?>
		<option value="<?php echo $lession_row['l_id']; ?>" id="hire"><?php echo $lession_row['name']; ?></option>
		<?php
	}
}
?>
</select><td>
</tr>
<tr>
<td><a href="createlesson">create a new lesson</a></td>
</tr>
<tr>
<td><input type="submit" value="submit"id ="my_button"></td>
</tr>
</table>

</form>
<?php
}
?>
</div>
</div>
		 
		   <?php
		  
		
		 
		  include 'include/footer.php';
		  ?>