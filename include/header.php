
<!doctype html>
<html lang="en">
<head>
<script src="http://localhost/mypage/ckeditor/ckeditor.js"></script>
<title>confusestudy</title>
<link rel="icon" type="image/gif" href="http://localhost/mypage/myimage/icon.png" />
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=0.6">
<link rel="stylesheet" type="text/css" href="http://localhost/mypage/css/screen.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/mypage/css/subscreen.css" />
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=192136997937134";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="all_div">

<header id="top_header">
<div id="logo">
<a href="http://localhost/mypage" style="text-decoration:none; color:white;"><h1>CONFUSE STUDY</h1></a>



</div>
<div id="xlogo">
<form action="http://localhost/mypage/friend" method="get">
<input type="text" style="color:#c4302b; padding:4px; font-weight:bold; border:2px solid #3b5998; border-radius:5px;" name="search" placeholder="find your friend..">
</form>
<?php
if(logged_in()=== true){
	
	
	echo 'hello, '. $user_data['firstname'] . ' <div id="small_profile"><a href="http://localhost/mypage/profile.php" title="Your profile"><img src=" http://localhost/mypage/'.$user_data['profile'].'"></a></div>';
	
	
}else{
	
?>
<ul>
<li><a href="http://localhost/mypage/login.php">Login</a></li>
<li><a href="http://localhost/mypage/register.php">Sinup</a></li>
</ul>
<?php
}
?>
</div>
</header>