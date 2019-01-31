 <div id="my_new_div">
		  <ul>
		  <li><a href="http://localhost/mypage/subject">Question</a></li>
		  <li><a href="http://localhost/mypage/findjob">Jobs</a></li>
		  <li><a href="http://localhost/mypage/hire">Hire</a></li>
		  
		  
		  <?php
		  if(logged_in() === true){
			  echo '<li><a href="http://localhost/mypage/profile">profile</a></li>';
		  }
		  ?>
		  </ul>
		  </div>