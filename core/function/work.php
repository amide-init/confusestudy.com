<?php

function apply_exists($user_id , $hire_id){
	$user_id = (int)$user_id;
	$hire_id = (int)$hire_id;
	 return(mysql_result( mysql_query("SELECT COUNT(`id`)FROM `user_to_job` WHERE `user_id`= $user_id AND `hire_id` = $hire_id"),0)==1) ? true : false;
}

function get_hire_info($hire_id){
	$hire_id = (int)$hire_id;
	return mysql_query("SELECT * FROM `hire` WHERE `hire_id` = $hire_id");
	
} 
function recover_account($recover_email){
	$remove_hack = md5($recover_email + microtime());
mysql_query("UPDATE `students` SET `reset` = '$remove_hack' WHERE `email` = '$recover_email'");
email($recover_email , 'RECOVER YOUR ACCOUNT' , 
"We heard that you lost your Confusestudy password. Sorry about that! \n

But don’t worry! You can use the following link  to reset your password:\n\n http://www.confusestudy.com/recover?email=". $recover_email ."&reset_code=". $remove_hack ."\n\n

Thanks,\n
Your friends at Confusestudy");

}
function new_password_update($new_password , $email , $reset_code){
	$new_password_hash = md5($new_password);
	$email = sanitize($email);
	$reset_code = sanitize($reset_code);
	mysql_query("UPDATE `students` SET `password` = '$new_password_hash' WHERE `email` = '$email' AND `reset` = '$reset_code'");
	
	
	
	
}
function apply_user_job($apply_data ){
		array_walk($apply_data , 'array_sanitize');										     
	   					         
	      $fields = '`' . implode('`, `', array_keys($apply_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $apply_data) . '\'';
		  mysql_query("INSERT INTO `user_to_job` ($fields) VALUES ($data)");
}



function hire_job($hire_data){
	array_walk($hire_data , 'array_sanitize');										     
	   					         
	      $fields = '`' . implode('`, `', array_keys($hire_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $hire_data) . '\'';	  
	
          mysql_query("INSERT INTO `hire` ($fields) VALUES ($data)");
	
}
function show_all_job(){
	return mysql_query("SELECT * FROM `hire` ORDER BY `hire_id` DESC ");
}
function show_pdf($q_id){
	$q_id = (int)$q_id;
	return mysql_query("SELECT * FROM `pdf` WHERE `q_id` = $q_id");
	
}
function show_some_pdf(){
return mysql_query("SELECT * FROM `pdf`  ORDER BY `pdf_id`  LIMIT 8");
}
function show_pdf_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_query("SELECT * FROM `pdf` WHERE `user_id` = $user_id");
	
}
function show_all_pdf(){
	return mysql_query("SELECT * FROM `pdf`");
		
	
}
function show_videos($q_id){
	$q_id = (int)$q_id;
	return mysql_query("SELECT * FROM `videos` WHERE `q_id` = $q_id");
	
}
function show_one_video(){
	return mysql_query("SELECT * FROM `videos` ORDER BY `v_id` DESC LIMIT 3");
}
function show_video_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_query("SELECT * FROM `videos` WHERE `user_id` = $user_id");
	
}
function show_all_videos(){
	return mysql_query("SELECT * FROM `videos`");
		
	
}

function add_videos( $q_id, $title , $user_id  , $link_extn , $description){
	 $q_id = (int)$q_id;
     $user_id = (int)$user_id;
	 $path = 'https://www.youtube.com/embed/'.$link_extn;
	mysql_query("INSERT INTO `videos` (`q_id` , `title` , `video` , `description` , `user_id`) VALUES ($q_id , '$title' , '$path' , '$description' , $user_id) ");
	
}


function fill_answer( $q_id, $user_id , $my_answer){ 
 $q_id = (int)$q_id;
 $user_id = (int)$user_id;

	mysql_query("INSERT INTO `all_answer` (`que_id` , `s_id` , `answer`) VALUES ($q_id , $user_id , '$my_answer')");
}
function fill_answer_pdf( $q_id, $user_id , $file_temp , $file_extn , $title){ 
 $q_id = (int)$q_id;
 $user_id = (int)$user_id;
$file_path ='uploads/answers/' . substr(md5(time()), 0, 10) . '.' .$file_extn;
move_uploaded_file($file_temp , $file_path);

	mysql_query("INSERT INTO `pdf` (`q_id` , `user_id` , `pdf` , `title`) VALUES ($q_id , $user_id , '$file_path' , '$title')");
}
function show_answer($q_id){
	$q_id = (int)$q_id;
	return mysql_query("SELECT * FROM `all_answer` WHERE `que_id` = $q_id");
}

function show_all_answer_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_query("SELECT  * FROM `all_answer` WHERE `s_id` = $user_id");
	
}


function search_people($search){
	return mysql_query("SELECT * FROM `students` WHERE `firstname` LIKE '%".mysql_real_escape_string($search)."%'");
}
function question_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`q_id`)FROM `question` WHERE `sid` = $user_id"),0);
}
function answer_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`a_id`)FROM `all_answer` WHERE `s_id` = $user_id"),0);
}
function answer_count_by_q_id($q_id){
	$q_id = (int)$q_id;
	return mysql_result(mysql_query("SELECT COUNT(`a_id`) FROM `all_answer` WHERE `que_id` = $q_id"),0);
	
}
function show_lesson_answer($user_id , $q_id){
	$user_id = (int)$user_id;
	$q_id    = (int)$q_id;
	if(mysql_result(mysql_query("SELECT COUNT(`a_id`) FROM `all_answer` WHERE `que_id` = $q_id AND `s_id` = $user_id"),0) >=1){
	return mysql_result(mysql_query("SELECT `answer` FROM `all_answer` WHERE `que_id` = $q_id AND `s_id` = $user_id"),0);
	}else{
		return false;
	}
}
function show_last_question_from_user_id($user_id){
	return mysql_query("SELECT * FROM `question` WHERE `sid` = $user_id ORDER BY `q_id` DESC LIMIT  1");
}
function pdf_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`pdf_id`)FROM `pdf` WHERE `user_id` = $user_id"),0);
}
function video_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`v_id`)FROM `videos` WHERE `user_id` = $user_id"),0);
}

function pdf_count_by_q_id($q_id){
	$q_id = (int)$q_id;
	return mysql_result(mysql_query("SELECT COUNT(`pdf_id`)FROM `pdf` WHERE `q_id` = $q_id"),0);
}
function video_count_by_q_id($q_id){
	$q_id = (int)$q_id;
	return mysql_result(mysql_query("SELECT COUNT(`v_id`)FROM `videos` WHERE `q_id` = $q_id"),0);
}

function like_exists($user_id , $answer_id ){
	$user_id = (int)$user_id;
	$answer_id = (int)$answer_id;
	return(mysql_result(mysql_query("SELECT COUNT(`like_id`) FROM `answer_like` WHERE `user_id` = $user_id AND `answer_id` = $answer_id") , 0) == 1)?true:false;
	
}
function follower_exists($my_id , $his_id){
	$my_id = (int)$my_id;
	$his_id = (int)$his_id;
	return(mysql_result(mysql_query("SELECT COUNT(`f_id`) FROM `followers` WHERE `session_id` = $my_id AND `follower_id` = $his_id") , 0) == 1)?true:false;
	
}
function like_count($answer_id ){
	
	$answer_id = (int)$answer_id;
	return mysql_result(mysql_query("SELECT COUNT(`like_id`)FROM `answer_like` WHERE  `answer_id` = $answer_id "),0);
}
function like_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`like_id`)FROM `answer_like` WHERE  `sid` = $user_id "),0);
}
function follower_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`f_id`)FROM `followers` WHERE  `follower_id` = $user_id "),0);
}
function show_all_follower_by_id($user_id){
		$user_id = (int)$user_id;
	   return mysql_query("SELECT * FROM `followers` WHERE `follower_id` = $user_id ");
}
function create_lesson($user_id , $lesson , $about){
	$user_id = (int)$user_id;
	$lesson_url  = createSeoUrl($lesson);
	mysql_query("INSERT INTO `lession` (`user_id` , `name` , `about` , `url`) VALUES ($user_id , '$lesson' , '$about' , '$lesson_url')");
}
function select_lession_by_id($id){
	$id = (int)$id;
	return mysql_query("SELECT * FROM `lession` WHERE `user_id` = $id");
	
}
function show_lesson_from_l_id($l_id){
	$l_id = (int)$l_id;
	return mysql_query("SELECT * FROM `lession` WHERE `l_id` = $l_id");
	
}
function lession_count_by_id($user_id){
	$user_id = (int)$user_id;
	return mysql_result(mysql_query("SELECT COUNT(`l_id`)FROM `lession` WHERE  `user_id` = $user_id "),0);
}
function question_count_by_l_id($l_id){
	$l_id = (int)$l_id;
	return mysql_result(mysql_query("SELECT COUNT(`q_id`)FROM `question` WHERE  `lession` = $l_id "),0);
	
}
function show_all_lesson(){
	return mysql_query("SELECT * FROM `lession`");
}
function show_question_from_lesson($l_id){
	$l_id = (int)$l_id;
	return mysql_query("SELECT * FROM `question` WHERE `lession` = $l_id");
}
?>