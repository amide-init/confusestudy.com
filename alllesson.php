<?php 
include 'core/init.php';
include 'include/header.php';
?>

<div id="new_div">

<?php
$show = show_all_lesson();


if(mysql_num_rows($show) >= 1){
	while($amin = mysql_fetch_assoc($show)){
		?>
		 <section id="new_section">
		  <header style="font-size:1.4em; border-bottom:2px solid red;">
		<?php echo $amin['name'];?>
		
		 </header>
		<?php
	
		$user = mysql_fetch_assoc(user_info_from_id($amin['user_id']));
	?>    
	
	<div id="logo">
		<div id="profile">
		<?php
		echo '<img src="'.$user['profile'] .'"/>';
		
		?>
		</div>
		</div>
		
		<div id="logo" style="padding:10px;">
		<?php
		echo $user['firstname'] . '  ' . $user['lastname'].'<br>';
		echo $user['scname'].'<br>';
		
		echo '<p style=" padding:10px;">'.$amin['about'].' gfhg jghj j hgjuhg  <br>  ggh  gfhg jghj j hgjuhg fhg jghj j hgjuhg fhg jghj j hgjuhg fhg jghj j hgjuhg fhg jghj j hgjuhg</p>';
		echo '<p>Question( '.question_count_by_l_id($amin['l_id']).' )</p>';
		?>
		
		</div>
		 </section>
		<?php
	}
}

?>

</div>


<?php
include 'include/footer.php';
?>