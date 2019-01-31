<?php
include 'core/init.php';

include 'include/header.php';
include 'include/navbar.php';

if(empty($_GET['search'])=== true){
	
	header("Location: ./index");
}elseif(isset($_GET['search']) === true){
	$search = $_GET['search'];
}
$found_people = search_people($search);

	

?>




<div id="new_div">
<div id="my_que_div">
<h2><?php echo mysql_num_rows($found_people);?> People found...</h2>
<?php
if(mysql_num_rows($found_people) >= 1){
while($query_rows = mysql_fetch_assoc($found_people)){
?>
<section id="new_section" style="text-align:center; color:#3b5998; font-weight:bold;">
<div id="mid_profile">
<img src="<?php echo $query_rows['profile']; ?>">
</div>
<?php echo $query_rows['firstname'] . " " . $query_rows['lastname']; ?><br>
<?php echo $query_rows['scname']; ?><br>
<br><br>
<a href="student?user=<?php echo $query_rows['id']; ?>" id="my_button" style="color:white;">View Profile</a>
</section>
<?php
}
}else{
	echo 'Sorry !!! There are no people of '.  $search . ' name';
}
?>
</div>

</div>


<?php
//include 'include/newbar.php';
include 'include/footer.php';

?>