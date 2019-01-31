<?php 
include 'core/init.php';
include 'include/header.php';
?>

<div id="new_div">

<?php
$show = show_all_pdf();

if(mysql_num_rows($show) >= 1){
	while($amin = mysql_fetch_assoc($show)){
		?>
		 <section id="new_section">
		  <header>
		 <?php echo '<i>[pdf for]</i> '. only_question_from_q_id($amin['q_id']); ?>
		 </header>
		 <hr><br>
		 <?php echo '<a href="'.$amin['pdf'].'">'.$amin['title'].'</a>'; ?>
		<br>
		<p style="opacity:0.4;">use this link above</p>
		<br>
		<footer>
		<?php 
		$user = mysql_fetch_assoc(user_info_from_id($amin['user_id']));
		?>
		<div id="small_profile">
		<?php
		echo '<img src="'.$user['profile'] .'"/>';
		?>
		</div>
		<?php
		echo $user['firstname'] . '  ' . $user['lastname'].'<br>';
		echo $user['scname'];
		?>
		</footer>
		 </section>
		<?php
	}
}

?>

</div>


<?php
include 'include/footer.php';
?>