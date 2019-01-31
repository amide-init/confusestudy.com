<?php 
include 'core/init.php';
include 'include/header.php';
//include 'include/navbar.php';
//include 'include/searchengine.php';

?>

<div id="new_div">
<section id="main_section">
<h2>Accounts..</h2>
<p>Welcome to the this content ..</p>
</div>

<div id="new_div">


<?php 
$subject = 'account';
$kostion = question_from_subject($subject);

if(mysql_num_rows($kostion) >= 1){
				
			
				
				while($query_rows=mysql_fetch_assoc($kostion)){
					?>
					<section id="main_section">
					<?php
					echo '<h2>Topic:'.$query_rows['topic'].'</h2>';
					echo '<p><strong>'.$query_rows['question'].'</strong></p>';
					echo '<p>'. $query_rows['solution'] .'</p>';
					echo '<a href="'.$query_rows['apdf'].'">OPEN</a><hr>';
					$info = $query_rows['sid'];
					
					?>
					</section>
					<?php
					
					}
					
				}
	
?>

   
   


</div>


<?php
//include 'include/newbar.php';
include 'include/footer.php';
?>