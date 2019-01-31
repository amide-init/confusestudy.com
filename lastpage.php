<?php 
require 'core/init.php';
include 'include/header.php';
include 'include/navbar.php';

include 'include/searcheng.php';


?>
<div id="new_div">
<section id="main_section">
<?php

if(isset($_GET['search'])){
	if(empty($_GET['search']) === true) {
		echo 'you should write something....  ';
	} else {
	$que   = $_GET['search'];
	$exque = explode(' ', strtolower($que));
	$un = array('what', 'is', 'who', 'describe', 'when', 'how','and' );
	
  $result = array_diff($exque, $un);
  
  
  
foreach($result as $key=>$value) {
	$query_run = mysql_query("SELECT  `q_id`,`url`, `question` FROM `question` WHERE `question` LIKE '%".mysql_real_escape_string($value)."%' ");
	if(mysql_num_rows($query_run) >= 1){
				
				
				while($query_rows=mysql_fetch_assoc($query_run)){
					?><a href="<?php echo 'text/'.$query_rows['url'].'/'.$query_rows['q_id'];?>"><?php echo $query_rows['question'].'<br><br><br>'; ?></a><?php
					
					}
				}else {
					echo 'Sorry  !!! you have not this type question like ' . $value.'<br>';
				}
	

}

	}
	
}



?>
</section>
</div>

<?php

	  //include 'include/newbar.php';
include 'include/footer.php';
?>