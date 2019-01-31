<?php
include 'core/init.php';
if( isset($_GET['myid']) === true && isset($_GET['hisid']) === true  && isset($_GET['quara']) === true){
	$my_id  = $_GET['myid'];
	$his_id = $_GET['hisid'];
	$quara     = $_GET['quara'];
	$my_id  = (int)$my_id;
	$his_id = (int)$his_id;
	if(follower_exists($my_id , $his_id)===false){
	mysql_query("INSERT INTO `followers` (`session_id` , `follower_id`) VALUES ($my_id , $his_id)");
	 header('Location: answer?question='.$quara.'&mode=text');
	}else{
		 header('Location: answer?question='.$quara.'&mode=text');
	}
}
?>