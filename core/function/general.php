<?php 
function logged_in_redirect() {
	if(logged_in()===true) {
		echo '<script type="text/javascript">window.location= "./index.php"</script>';
		exit();
	}
}

function protect_page() {
	if(logged_in() === false){
		header('Location: protected.php');
		exit();
	}
}
function admin_protect() {
	
 if(is_admin($_SESSION['id']) === false) {
	 header('Location: index.php');
	 exit();
 }
}

function array_sanitize(&$item) {
	$item = mysql_real_escape_string($item);
}

function sanitize($data){
return mysql_real_escape_string($data);
}
function output_errors($errors){
	return '<ul><li>' .implode('</li><li>',$errors).'</li></ul>';
}

function email($to , $subject , $body){
	mail($to , $subject , $body , 'From:confusestudy@confusestudy.com');
}
function createSeoUrl($slug){
	$letter_spaces_hypens_number = '/[^\-\_\s\pN\pL]+/u';
	$spaces_duplicate_hypens     = '/[\-\_\s]+/';
	$slug = preg_replace($letter_spaces_hypens_number , '' , mb_strtolower($slug , 'UTF-8'));
	$slug = preg_replace($spaces_duplicate_hypens , '-' , $slug);
	$slug = trim($slug , '-');
	return $slug;
	
} 


?>