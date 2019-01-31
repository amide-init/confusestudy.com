<?php 
include 'core/init.php';
include 'include/header.php';
?>

<div id="new_div">

<?php
$show = show_all_videos();
if(mysql_num_rows($show) >= 1){
	while($amin = mysql_fetch_assoc($show)){
		?>
		<section id="new_section">
		<header>
		<?php echo only_question_from_q_id($amin['q_id']) ;?>
		</header>
		<iframe width="500" height="300" src="<?php  echo $amin['video']; ?>" frameborder="0" allowfullscreen></iframe>
		
		Description:<hr>
		<?php echo $amin['description']; ?>
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