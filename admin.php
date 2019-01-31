<?php

include 'core/init.php';
protect_page();
admin_protect();


include 'include/header.php';

 include 'include/navbar.php';

$solve  = solve();
$null =  mysql_num_rows($solve)


?>

<div class="sidebar">

Name:
<?php
 echo $user_data['firstname'];?>
 <hr>
 From:
 <?php 
 echo $user_data['scname'];
 ?>
 

 
</div>
<div class="main">
<h3>I AM the Cheif Excutive Officer (CEO) </h3><br><br>
<table border="0" id="admin">
<tr><td><a href="admin.php?users">NUMBER OF USERS</a></td>             <td>:</td>             <td> <?php echo no_of_users(); ?> </td> </tr>
<tr><td>LAST UDER'S ID</td>                             <td>:</td>             <td> <?php  //echo last_user_id(); ?></td>   </tr>
<tr><td>NAME OF LAST USERS</td>                         <td>:</td>             <td><?php  echo  last_user_name();  ?></td> </tr>
<tr><td>NUMBER OF QUESTION</td>                         <td>:</td>             <td> <?php  echo no_of_question(); ?></td> </tr>
<tr><td>NUMBER OF UNSOLVED QUESTION</td>                <td>:</td>             <td><?php  echo $null ?></td>  </tr>
<tr><td>LAST QUESTION   </td>                           <td>:</td>             <td> </td> </tr>
<tr><td>LAST QUESTION ID'S</td>                         <td>:</td>             <td> 219</td> </tr>
<tr><td><a href="">TOPPER USER</a> </td>                <td>:</td>             <td> aamin uddin</td>  </tr>
</table>


</div>

<div class="main">
<h3>All user</h3>
<p>
<?php
$kostion = user_all();

if(mysql_num_rows($kostion) >= 1){
				
				echo mysql_num_rows($kostion).'   users are avilable</p><hr><hr>';
				
				while($query_rows=mysql_fetch_assoc($kostion)){
                                       echo '<h4>'.$query_rows['firstname'].''.$query_rows['lastname'].'</h4>';
					
                  			?>
					<div class="profile">
					<?php echo '<img src="', $query_rows['profile'], '" alt="',$query_rows['firstname'], '\'s Profile image">'; ?>
					</div>
					<p>
					<?php
					echo '<a href="student.php?user='.$query_rows['id'].'">'.$query_rows['firstname'].'</a><br>';
 					echo $query_rows['scname'].'<br>';
					echo $query_rows['intrest'].'<br>';
					echo $query_rows['active'].'<br>';
					echo $query_rows['email'].'<hr>';
					
					
					}
				}
?>

</p>
</div>
<?php
include 'include/footer.php';
?>
