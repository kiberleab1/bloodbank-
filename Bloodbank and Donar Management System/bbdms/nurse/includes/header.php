<?php
	$username=$_SESSION['alogin'];
	$sql = "SELECT * from  admin WHERE UserName=?";
	$query = $dbh -> prepare($sql);
	$query->execute([$username]);
	$results=$query->fetchAll(PDO::FETCH_ASSOC);
	$name=$results[0]["email"];
	
?>
<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 20px; padding-top:1%; color:#fff">BloodBank & Donor Management System </a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""><?php echo $username?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
