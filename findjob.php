<?php
include 'core/init.php';
include 'include/header.php';
 include 'include/navbar.php';

 #main_section > form > input[type="text"]
$kostion = show_all_job();
?>
<div id="new_div">
<div id="my_que_div">
<?php
if(isset($_GET['success'])=== true && empty($_GET['success'])=== true) {
	echo '<p style="color:green; padding:5px; font-weight:bold;">You are applied for  this job . Thank you for using our service</p>';
}

echo '<h2>There are ' . mysql_num_rows(show_all_job()) . ' jobs for you ....</h2>';
if(mysql_num_rows($kostion) >= 1){
				
			
				
				while($query_rows=mysql_fetch_assoc($kostion)){
					?>
					
					<section id="new_section">
					
					<header>Date :: <?php echo $query_rows['date']; ?><hr></header>
					
					<table id="my_table">
					<tr>
					<td><em>Are you intrested for job in </em>:</td>
					<td id="td1"> <?php echo $query_rows['company']; ?></td>
					</tr>
					<tr>
					<td><em>This job is submitted by </em>:</td>
					<td id="td1"><?php echo $query_rows['co_name']; ?></td>
					</tr>
					<tr>
					<td><em>salary</em>:</td>
					<td id="td1"><?php echo $query_rows['min_salary'] . " -- " . $query_rows['max_salary']; ?></td>
					</tr>
					<tr>
					<td><em>Address</em>:</td>
					<td id="td1"><?php echo $query_rows['address']; ?></td>
					</tr>
					<tr>
					<td><em>contact number:</em>:</td>
					<td id="td1"><?php echo $query_rows['co_number'] ; ?></td>
					</tr>
					<tr>
					<td><em>Minimum Qualification:</em>:</td>
					<td id="td1"><?php echo $query_rows['qualification'] ; ?></td>
					</tr>
					<tr>
					<td><em>postal code:</em>:</td>
					<td id="td1"><?php echo $query_rows['postal_code']; ?></td>
					</tr>
					<tr>
					<td><em>About this job:</em>:</td>
					<td id="td1"><?php echo $query_rows['about_job']; ?></td>
					</tr>
					
					
					
					</table>
					<footer>
					<?php
					if(logged_in() === true){
					echo '<a href="apply?apply='.  sha1(md5($session_user_id)) . '&id='. $query_rows['hire_id'] . '&token='. md5(microtime()+$user_data['email']) .' " id="my_button">Apply</a>';
					}else{
						echo '<a href="login" id="my_button">Login for Apply</a>';
					}
					?>
					</footer>
					
					</section>
					<?php
					
					}
					
				}
?>  
</div>
</div> 
<?php

include 'include/footer.php';
?>