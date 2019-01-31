<?php
include 'core/database/connect.php';

?>
<section style="width:98%; border:2px solid #3b5998; color:green; margin:5px; padding:4px; height:200px;">
<form action="" method="post">
<input type="text" name="search" placeholder="aamin search engine..." style="width:80%; border:3px solid lightgreen; color:orange; font-weight:bold; padding:5px;" >
</form>
<?php
if(isset($_POST['search']) === true){
	$search = $_POST['search'];
	if(empty($search) === true){
		echo 'what is this';
	}else{
    
	 $query	= mysql_query("select * from `question` where `question` LIKE '%".mysql_real_escape_string($search)."%' ");
	 if(mysql_num_rows($query) == 0){
		echo 'Your question... but unfortunely we donot have this question... If you are registerd user then <a href="myarea">add</a> this question<br>';
		 echo '<a href="myarea">'.$search.'</a>';
		 
	 }else{
	 while($query_rows = mysql_fetch_assoc($query)){
		 echo '<em>'.$query_rows['q_id'].'.</em><i>' . "  " .$query_rows['question'].'</i><br>';
	 }
	 }
	}
}

?>
</section>
