<?php
include 'core/init.php';
if( isset($_GET['aid']) === true && isset($_GET['sid']) === true && isset($_GET['quara']) === true){
	
	$answer_id = $_GET['aid'];
	$sid       = $_GET['sid'];
	$quara     = $_GET['quara'];
	$answer_id = (int)$answer_id;
	$sid       = (int)$sid;
	if(like_exists($session_user_id , $answer_id) === false){
	mysql_query("insert into `answer_like` (`user_id` , `answer_id` ,`sid` ) values ($session_user_id , $answer_id , $sid)");
	 header('Location: answer?question='.$quara.'&mode=text');
	}else{
		 header('Location: answer?question='.$quara.'&mode=text');
	}
}

?>