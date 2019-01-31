<?php




function change_profile_image($id , $file_temp , $file_extn){
	$file_path ='images/profile/' . substr(md5(time()), 0, 10) . '.' .$file_extn;
	 move_uploaded_file($file_temp, $file_path);
	
	mysql_query("UPDATE `students` SET `profile` = '" . mysql_real_escape_string($file_path) . "' WHERE `id` = " . (int)$id);
	
	
}
function no_of_users(){
	 return mysql_result(mysql_query("SELECT COUNT(`id`) FROM `students`"),0);
}




function last_user_name(){
	return mysql_result(mysql_query("SELECT `firstname` , `lastname` FROM `students` ORDER BY `id` DESC"),0);
}


function no_of_question(){
	return mysql_result(mysql_query("SELECT COUNT(`q_id`) FROM `question`"),0);
}

function is_admin($id) {
	$id = (int)$id;
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `students` WHERE `id` = $id AND `type` = 1"), 0) == 1) ? true : false;
	
}

function change_setting($id,$setting_data) {
	      $id = (int)$id;
	      array_walk($setting_data , 'array_sanitize');										     
	      $update = array();
          foreach($setting_data as $field => $data ) {
			  $update[] = '`' . $field . '` = \'' . $data . '\'';
		  }
			mysql_query("UPDATE `students` SET ". implode(', ', $update) ." WHERE `id` = $id");  
		  }		  
function change_school_setting($id,$setting_data) {
	      $id = (int)$id;
	      array_walk($setting_data , 'array_sanitize');										     
	      $update = array();
          foreach($setting_data as $field => $data ) {
			  $update[] = '`' . $field . '` = \'' . $data . '\'';
		  }
			mysql_query("UPDATE `school_info` SET ". implode(', ', $update) ." WHERE `user_id` = $id");  
		  }
function change_collage_setting($id,$setting_data) {
	      $id = (int)$id;
	      array_walk($setting_data , 'array_sanitize');										     
	      $update = array();
          foreach($setting_data as $field => $data ) {
			  $update[] = '`' . $field . '` = \'' . $data . '\'';
		  }
			mysql_query("UPDATE `collage_info` SET ". implode(', ', $update) ." WHERE `user_id` = $id");  
		  }		  
function change_graduation_setting($id,$setting_data) {
	      $id = (int)$id;
	      array_walk($setting_data , 'array_sanitize');										     
	      $update = array();
          foreach($setting_data as $field => $data ) {
			  $update[] = '`' . $field . '` = \'' . $data . '\'';
		  }
			mysql_query("UPDATE `graduation` SET ". implode(', ', $update) ." WHERE `user_id` = $id");  
		  }	
		  
function change_address($id,$setting_data) {
	      $id = (int)$id;
	      array_walk($setting_data , 'array_sanitize');										     
	      $update = array();
          foreach($setting_data as $field => $data ) {
			  $update[] = '`' . $field . '` = \'' . $data . '\'';
		  }
			mysql_query("UPDATE `user_address` SET ". implode(', ', $update) ." WHERE `user_id` = $id");  
		  }		
function insert_address($id , $setting_data){
	    $id = (int)$id;
	 array_walk($setting_data , 'array_sanitize');										    
	    				         
	      $fields = '`' . implode('`, `', array_keys($setting_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $setting_data) . '\'';							     
          mysql_query("INSERT INTO `user_address` (`user_id` , $fields) VALUES ( $id , $data)");

}
function insert_school_info($id , $setting_data){
	    $id = (int)$id;
	 array_walk($setting_data , 'array_sanitize');										    
	    				         
	      $fields = '`' . implode('`, `', array_keys($setting_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $setting_data) . '\'';							     
          mysql_query("INSERT INTO `school_info` (`user_id` , $fields) VALUES ( $id , $data)");

}
function insert_collage_info($id , $setting_data){
	    $id = (int)$id;
	 array_walk($setting_data , 'array_sanitize');										    
	    				         
	      $fields = '`' . implode('`, `', array_keys($setting_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $setting_data) . '\'';							     
          mysql_query("INSERT INTO `collage_info` (`user_id` , $fields) VALUES ( $id , $data)");

}
function insert_grad_info($id , $setting_data){
	    $id = (int)$id;
	 array_walk($setting_data , 'array_sanitize');										    
	    				         
	      $fields = '`' . implode('`, `', array_keys($setting_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $setting_data) . '\'';							     
          mysql_query("INSERT INTO `graduation` (`user_id` , $fields) VALUES ( $id , $data)");

}
	
function question_count_for_id($sid){
           $sid = (int)$sid;
	 return mysql_result(mysql_query("SELECT COUNT(`q_id`) FROM `question` WHERE `sid` = $sid "),0);
	 
}
function question_email($email){
	$p=question_count_for_email($email);
	
	 return mysql_result(mysql_query("SELECT `question` FROM `question` WHERE `email` = '$email' ORDER BY `q_id` DESC"),0);
	
}
function change_password($id,$password){
	$id=(int)$id;
	$password=md5($password);
	
	
	mysql_query("UPDATE `students` SET `password` = '$password' WHERE `id`=$id");
}

function update_answer($q_id, $sid, $hal){
	$q_id = (int)$q_id;
	$sid = (int)$sid;
	
	mysql_query("UPDATE `question` SET `solution` = '$hal' , `sid` = $sid WHERE `q_id`=$q_id");
}


function user_data($id){
	$data=array();
	$id=(int)$id;
	
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	
	
	if($func_num_args >1) {
	unset($func_get_args[0]);
	
	
	$field='`' . implode('` , `' , $func_get_args) . '`';
	
	$data=mysql_fetch_assoc(mysql_query("SELECT $field FROM `students` WHERE `id` = $id"));
	
	
	return $data;
	}
}
function user_address($id){
	$data=array();
	$id=(int)$id;
	
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	
	
	if($func_num_args >1) {
	unset($func_get_args[0]);
	
	
	$field='`' . implode('` , `' , $func_get_args) . '`';
	
	$data=mysql_fetch_assoc(mysql_query("SELECT $field FROM `user_address` WHERE `user_id` = $id"));
	
	
	return $data;
	}
}

function my_school_data($id){
	$data=array();
	$id=(int)$id;
	
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	
	
	if($func_num_args >1) {
	unset($func_get_args[0]);
	
	
	$field='`' . implode('` , `' , $func_get_args) . '`';
	
	$data=mysql_fetch_assoc(mysql_query("SELECT $field FROM `school_info` WHERE `user_id` = $id"));
	
	
	return $data;
	}
}
function my_collage_data($id){
	$data=array();
	$id=(int)$id;
	
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	
	
	if($func_num_args >1) {
	unset($func_get_args[0]);
	
	
	$field='`' . implode('` , `' , $func_get_args) . '`';
	
	$data=mysql_fetch_assoc(mysql_query("SELECT $field FROM `collage_info` WHERE `user_id` = $id"));
	
	
	return $data;
	}
}
function graduation_data($id){
	$data=array();
	$id=(int)$id;
	
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	
	
	if($func_num_args >1) {
	unset($func_get_args[0]);
	
	
	$field='`' . implode('` , `' , $func_get_args) . '`';
	
	$data=mysql_fetch_assoc(mysql_query("SELECT $field FROM `graduation` WHERE `user_id` = $id"));
	
	
	return $data;
	}
}



function question_data($qid){
	$quara = array();
	$q_id  = (int)$q_id;

}


function logged_in(){
	return (isset($_SESSION['id']))?true:false;
}



function activate($email , $email_code){
	$email      = mysql_real_escape_string($email);
	$email_code = mysql_real_escape_string($email_code);
	
	if(mysql_result(mysql_query("SELECT COUNT(`id`) FROM `students` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"),0) ==1) {
		mysql_query("UPDATE `students` SET `active` = 1 WHERE `email` = '$email'");
		
		return true;
	}else{
		return false;
	}
}


function user_exists($email){
$email = sanitize($email);
 return(mysql_result( mysql_query("SELECT COUNT(`id`)FROM `students` WHERE `email`='$email'"),0)==1) ? true : false;
}
function user_address_check($id){
	$id = (int)$id;
	return(mysql_result( mysql_query("SELECT COUNT(`a_id`)FROM `user_address` WHERE `user_id`= $id"),0)==1) ? true : false;
}
function user_school_check($id){
	$id = (int)$id;
	return(mysql_result( mysql_query("SELECT COUNT(`school_id`)FROM `school_info` WHERE `user_id`= $id"),0)==1) ? true : false;
}
function user_collage_check($id){
	$id = (int)$id;
	return(mysql_result( mysql_query("SELECT COUNT(`collage_id`)FROM `collage_info` WHERE `user_id`= $id"),0)==1) ? true : false;
}
function user_grad_check($id){
	$id = (int)$id;
	return(mysql_result( mysql_query("SELECT COUNT(`un_id`)FROM `graduation` WHERE `user_id`= $id"),0)==1) ? true : false;
}
function fill_the_form($id){
	$id = (int)$id;
	return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `job` WHERE `user_id`= $id"),0)==1) ? true : false;
}
function user_active($email){
	$email = sanitize($email);
return (mysql_result( mysql_query("SELECT COUNT(`id`)FROM `students` WHERE `email`='$email' AND `active`=1"),0)==1) ? true : false;
}
function student_id_from_email_id($email){
	$email = sanitize($email);
return mysql_result(mysql_query("SELECT `id` FROM `students` WHERE `email`='$email'"),0,'id');
}

 function login($email,$password){
	 $email = sanitize($email);
	 $password=md5($password);
	 
     $id=student_id_from_email_id($email);
return (mysql_result( mysql_query("SELECT COUNT(`id`)FROM `students` WHERE `email`='$email' AND `password`='$password'"),0)==1) ? $id : false;
}



            
          function register_user($register_data) {                                                   
	      array_walk($register_data , 'array_sanitize');										    
	      $register_data['password'] = md5($register_data['password']);						         
	      $fields = '`' . implode('`, `', array_keys($register_data)) . '`';					     
	      $data   = '\'' . implode('\', \'', $register_data) . '\'';							     
          mysql_query("INSERT INTO `students` ($fields) VALUES ($data)");

     																						 
	      email($register_data['email'], 'Activate  your confusestudy account', "hello ". $register_data['firstname'] .",\n\n You need to activate your confusestudy account, so use the link below:\n\n  http://www.confusestudy.com/activate.php?email=". $register_data['email'] ."&email_code=". $register_data['email_code'] ."\n\n-confusestudy");
          }
				



                       /*    Question entry........functions   */
function question_entry($question_data) {
   
	array_walk($question_data , 'array_sanitize');
    $fields = '`' . implode('`, `', array_keys($question_data)) . '`';					   
	$data   = '\'' . implode('\', \'', $question_data) . '\'';			
    mysql_query("INSERT INTO `question` ($fields) VALUES ($data)");
}

/* only question entry functions             */







function user_info_from_id($id){
	  
	  $id = (int)$id;
	
	return mysql_query("SELECT * FROM `students` WHERE `id` = $id ");
	
}
function question_info_from_id($id) {

$id = (int)$id;
return mysql_query("SELECT * FROM `question` WHERE `sid` = $id ORDER BY `q_id` DESC");
}

function all_question($page_id) {
	$page_id = (int)$page_id;
	$number  = 15*$page_id; 
	return mysql_query("SELECT * FROM `question` ORDER BY 	`q_id` desc LIMIT 15 OFFSET $number");
}
function index_question() {
	 
	return mysql_query("SELECT * FROM `question` ORDER BY 	`q_id` desc LIMIT 15 ");
}

function all_question_from_q_id($title , $q_id) {
	$q_id = (int)$q_id;
	return mysql_query("SELECT * FROM `question` WHERE `q_id` = $q_id AND `url` = '$title'");
}
function question_from_q_id($q_id){
	$q_id = (int)$q_id;
	return mysql_query("SELECT `url` , `question` FROM `question` WHERE `q_id` = $q_id") ;
}
function only_question_from_q_id($q_id){
	$q_id = (int)$q_id;
	return mysql_result(mysql_query("SELECT  `question` FROM `question` WHERE `q_id` = $q_id") ,0);
}
function user_all(){
	
	return mysql_query("SELECT * FROM `students`");
	
}






?>