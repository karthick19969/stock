<!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#3e454c">
<title>Stock Management System</title>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-social.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link rel="stylesheet" href="css/fileinput.min.css">
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/stock.css">
<link rel="stylesheet" href="css/header.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript"
	src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
function valid()
{
if(document.registration.password.value!= document.registration.cpassword.value)
{
alert("Password and Re-Type Password Field do not match  !!");
document.registration.cpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">

		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
<?php

if (isset($_REQUEST['msg']) && isset($_REQUEST['type'])) {
    ?> <h2 class="page-title"></h2>
        <?php
    if ($_REQUEST['type'] == "error")
        $msg = "<div class='error-box round'>" . $_REQUEST['msg'] . "</div>";
    else if ($_REQUEST['type'] == "warning")
        $msg = "<div class='warning-box round'>" . $_REQUEST['msg'] . "</div>";
    else if ($_REQUEST['type'] == "confirmation")
        $msg = "<div class='confirmation-box round'>" . $_REQUEST['msg'] . "</div>";
    else if ($_REQUEST['type'] == "information")
        $msg = "<div class='information-box round'>" . $_REQUEST['msg'] . "</div>";
        if($_REQUEST['ui'] !=''){
            $ui=$_REQUEST['ui'];
            if($ui=="logout"){
                $msg = $msg . "<a href='index.php'>login</a>" ;
            }
        }
    echo $msg;
} else {
    ?>
						<h2 class="page-title">User Login</h2>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="well row pt-2x pb-3x bk-light">
									<div class="col-md-8 col-md-offset-2">

										<form action="checklogin.php" class="mt" method="post">
											<label for="" class="text-uppercase text-sm">Email</label> <input
												type="text" placeholder="Email" name="email"
												class="form-control mb"> <label for=""
												class="text-uppercase text-sm">Password</label> <input
												type="password" placeholder="Password" name="password"
												class="form-control mb"> <input type="submit" name="login"
												class="btn btn-primary btn-block" value="login">

										</form>

									</div>
									
								</div>

									<div class="col-md-8 col-md-offset-2">
										<input class="btn btn-primary" type="submit" name="submit"
											value="New User?"> <input class="btn btn-primary"
											type="submit" name="submit" value="Forgot Password">
									</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="well row pt-2x pb-3x bk-light">
									

								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>