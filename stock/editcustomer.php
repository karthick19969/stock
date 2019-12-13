<?php
session_start();
include ('includes/config.php');
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //

// check_login();
// code for add courses
if (isset($_POST['submit'])) {
    //echo "<script>alert('Update in progresssssssssssss ....');</script>";
    $customerid = $_POST['customerId'];
    //echo "<script>alert('Customer update .... $customerid');</script>";
    
    $customername = $_POST['customername'];
    
   // echo "<script>alert('Customer update ....$customername');</script>";
    $customerstate = $_POST['customerstate'];
    
    //echo "<script>alert('Customer update state ....$customerstate');</script>";
    $customeraddress = $_POST['customeraddress'];
   // echo "<script>alert('Customer update addres ....$customeraddress');</script>";
    $customercity = $_POST['customercity'];
    //echo "<script>alert('Customer update city ....$customercity');</script>";
    $customerpincode = $_POST['customerpincode'];
    //echo "<script>alert('Customer update pincode ....$customerpincode');</script>";
    $customercontactnumber = $_POST['customercontactnumber'];
    //echo "<script>alert('Customer update number ....$customercontactnumber');</script>";
    $customeremail = $_POST['customeremail'];
    //echo "<script>alert('Customer update email ....$customeremail');</script>";
    $customercode = $_POST['customercode'];
    //echo "<script>alert('Customer update code ....$customercode');</script>";
    
   
    $query = "update customer set Customer_Code=?,Customer_Name=?,Customer_Address=?,Customer_City=?,Customer_State=?,Customer_Pincode=?,Customer_Contact_Number=?,Customer_Email=? where Customer_Id=?";
    
    //$query = "update customer set Customer_Code=? where Customer_Id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssssssi', $customercode,$customername,$customeraddress,$customercity,$customerstate,$customerpincode,$customercontactnumber,$customeremail, $customerid);
    //$rc = $stmt->bind_param('sssi', $customercode,$customerid);
   $stmt->execute();
    
    
    //$query = "insert into customer(Customer_Code,Customer_Name,Customer_Address,Customer_City,Customer_State,Customer_Pincode,Customer_Contact_Number,Customer_Email) values('$customercode','$customername','$customeraddress','$customercity','$customerstate','$customerpincode','$customercontactnumber','$customeremail')";
    //$msg = mysqli_query($con, $query);
    
   
        echo "<script>alert('Customer Updated successfully');</script>";
    
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
<title>Edit customer</title>
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

						<h2 class="page-title">Edit Customer</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Customer</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">


											
											<?php
											$id = $_GET['id'];
											$ret = "select * from Customer where Customer_Id=?";
											$stmt = $mysqli->prepare($ret);
											$stmt->bind_param('i', $id);
											$stmt->execute(); // ok
											$res = $stmt->get_result();
											// $cnt=1;
											while ($row = $res->fetch_object()) {
                        ?>
                        <input type="hidden" name="customerId" value="<?php echo $row->Customer_Id; ?>" />
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Customer Code </label>
												<div class="col-sm-8">
													<input type="text" readonly="readonly" 
													value="<?php echo $row->Customer_Code;?>" name="customercode"
														class="form-control">
												</div>
												
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Customer Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" readonly="readonly" name="customername"
														id="customername" value="<?php echo $row->Customer_Name;?>" required="required">

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Address Lines</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="customeraddress" value="<?php echo $row->Customer_Address;?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">City</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="customercity"
														value="<?php echo $row->Customer_City;?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">State</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="customerstate" value="<?php echo $row->Customer_State;?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Pincode</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="customerpincode" value="<?php echo $row->Customer_Pincode;?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Contact Number</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														required="required" name="customercontactnumber" value="<?php echo $row->Customer_Contact_Number;?>">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Email</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														required="required" name="customeremail" value="<?php echo $row->Customer_Email;?>">
												</div>
											</div>
<?php } ?>

											<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Edit">
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