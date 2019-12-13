<?php
if (false) {
    ?><div class="brand clearfix">
	<a href="#" class="logo" style="font-size: 25px;">Stock Management
		System</a> <span class="menu-btn"><i class="fa fa-bars"></i></span>
	<ul class="ts-profile-nav">
		<li class="ts-account"><a href="#"><img src="img/ts-avatar.jpg"
				class="ts-avatar hidden-side" alt=""> Account <i
				class="fa fa-angle-down hidden-side"></i></a>
			<ul>
				<li><a href="my-profile.php">My Account</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul></li>
	</ul>
</div>

<?php
} else {
    ?>
<div class="brand clearfix header navbar navbar-inverse">
	<!-- div class="sidebar-toggle-box">
		<div class="fa fa-bars tooltips" data-placement="right"
			data-original-title="Toggle Navigation"></div>
			
	</div-->
	<!--  a href="#" class="logo" style="font-size: 10px; color:green">Fabric Merchandise Management System</a-->
	<!-- span class="menu-btn"><i class="fa fa-bars"></i></span-->

<a href="#" class="logo" style="font-size: 12px; color:green">Fabric Merchandise Management System</a>

	<div class="header-quick-nav">
		<div class="pull-left">
			<div class="chat-toggler">
				<div class="user-details">
					
					<div class="company">
						<img src="images/logo-am.png" alt="" data-src="images/logo-am.png"
						data-src-retina="images/logo-am.png" width="35" height="35"><a href="company.php">Ambika Mills </a></img>
					</div>
				</div>
			</div>
		</div>
		<div class="pull-right">

			<div class="chat-toggler">
				<div class="user-details">
					<div class="username">
						<?php
    if (! empty($_SESSION['userfirstname'])) {
        $name = $_SESSION['userfirstname'];
        
        ?><span class="bold"><?php echo $_SESSION['userfirstname'];  ?></span>
						    
						    <?php
    } else {
        ?>
        <span class="bold"></span> <?php }       ?>
						
					</div>
				</div>
				<div class="profile-pic">
					<img src="images/user.png" alt="" data-src="images/user.png"
						data-src-retina="images/user.png" width="35" height="35" />
				</div>
			</div>
			<ul class="nav quick-section ">
				<!-- div class="iconset top-down-arrow">
				</div-->
				<li class="quicklinks"><a data-toggle="dropdown"
					class="dropdown-toggle  pull-right " href="#" id="user-options">

						<div class="iconset top-settings-dark"></div>
				</a>
					<ul class="dropdown-menu  pull-right" role="menu"
						aria-labelledby="user-options">
						<li><a href="profile.php"> My Account</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log
								Out</a></li>
					</ul></li>

			</ul>
		</div>
		<!-- END CHAT TOGGLER -->
	</div>
</div>
<?php } ?>