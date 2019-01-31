<?php

session_start();
ob_start();
//error_reporting(0);
include 'database/connect.php';
require 'function/general.php';
require 'function/user.php';
require 'function/work.php';


if(logged_in()===true){
	$session_user_id=$_SESSION['id'];

	$user_data=user_data($session_user_id,'id','email','password','firstname','lastname' , 'birth' , 'gender' , 'scname', 'intrest', 'type', 'profile');
	$my_school_data = my_school_data($session_user_id ,'school_id' , 'user_id'  , 'passing_year' , 'name_of_school', 'grade' , 'about_school' , 'about_ten' );
	$my_collage_data = my_collage_data($session_user_id ,  'sc_name' , '+2passing_year' , '+2grade' , 'about_school+2' , 'about_twelve');
    $graduation_data = graduation_data($session_user_id , 'un_id' , 'user_id' , 'collage_name' , 'course' , 'starting_year' , 'passing_year' , 'about_collage' , 'about_graduation' );
    $user_address = user_address($session_user_id , 'a_id' , 'user_id' , 'home_town' , 'current_address' , 'mobile' , 'pincode' );


if(logged_in()===false){
	session_destroy();
	header('Location: index.php');
	exit();
}


}






$errors=array();
$output=array();
?>