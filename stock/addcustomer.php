<?php
session_start();
require_once ("includes/dbconnection.php");
// include('includes/checklogin.php');
// check_login();
// code for add courses
if (isset($_POST['submit'])) {
    $customername = $_POST['customername'];
    $customerstate = $_POST['customerstate'];
    $customeraddress = $_POST['customeraddress'];
    $customercity = $_POST['customercity'];
    $customerpincode = $_POST['customerpincode'];
    $customercontactnumber = $_POST['customercontactnumber'];
    $customeremail = $_POST['customeremail'];
    $customercode = $_POST['customercode'];
    $query = "insert into customer(Customer_Code,Customer_Name,Customer_Address,Customer_City,Customer_State,Customer_Pincode,Customer_Contact_Number,Customer_Email) values('$customercode','$customername','$customeraddress','$customercity','$customerstate','$customerpincode','$customercontactnumber','$customeremail')";
    $msg = mysqli_query($con, $query);
    
    if ($msg) {
        echo "<script>alert('Customer added successfully');</script>";
    }
}

?>
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
<title>Add customer</title>
<link rel="stylesheet" href="css/stock.css">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-social.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link rel="stylesheet" href="css/fileinput.min.css">
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/header.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
</head>
<body class="bk-img">
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Add Customer</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Customer</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">


											<div class="form-group">
											<?php
                        $max = $db->maxOfAll("Customer_Id", "Customer");
                        $max = $max + 1;
                        $autoid = "CUST" . $max . "";
                        ?>
                        <label class="col-sm-2 control-label">Customer Code </label>
												<div class="col-sm-8">
													<input type="text" readonly="readonly" value="<?php echo $autoid; ?>" name="customercode"
														class="form-control">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Customer Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="customername"
														id="customername" value="" required="required">

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Address Lines</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="customeraddress" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">City</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="customercity"
														value="">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">State</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="customerstate" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Pincode</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="customerpincode" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Contact Number</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														required="required" name="customercontactnumber" value="">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Email</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														required="required" name="customeremail" value="">
												</div>
											</div>


											<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Save">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
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
	<?php include("includes/footer.php");?>
</body>
</html>