<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //
                                                    // include('includes/checklogin.php');
                                                    // check_login();
                                                    // code for add courses
if (isset($_POST['submit'])) {
    $Username = $_POST['Username'];
    $Userstate = $_POST['Userstate'];
    
    $Useraddress = $_POST['Useraddress'];
    $Usercity = $_POST['Usercity'];
    $Userpincode = $_POST['Userpincode'];
    
    $Usercontactnumber = $_POST['Usercontactnumber'];
    $Useremail = $_POST['Useremail'];
    $Usercode = $_POST['Usercode'];
    $query = "insert into Users(Users_Code,Users_Name,Users_Address,Users_City,Users_State,Users_Pincode,Users_Contact_Number,Users_Email) values('$Usercode','$Username','$Useraddress','$Usercity','$Userstate','$Userpincode','$Usercontactnumber','$Useremail')";
    $msg = mysqli_query($con, $query);
    
    if ($msg) {
        echo "<script>alert('User Updated successfully');</script>";
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
<title>Edit User</title>
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
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Edit User</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit User</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">

											<?php
											$id = $_GET['id'];
											$ret = "select * from Users where User_Id=?";
											$stmt = $mysqli->prepare($ret);
											$stmt->bind_param('i', $id);
											$stmt->execute(); // ok
											$res = $stmt->get_result();
											// $cnt=1;
											while ($row = $res->fetch_object()) {
        ?>
                        <div class="form-group">
												<label class="col-sm-2 control-label">First Name : </label>
												<div class="col-sm-8">
													<input type="text" name="fname" id="fname"
														class="form-control" required="required" value="<?php echo $row->User_First_Name;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Middle Name : </label>
												<div class="col-sm-8">
													<input type="text" name="mname" id="mname"
														class="form-control" value="<?php echo $row->User_Middle_Name;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Last Name : </label>
												<div class="col-sm-8">
													<input type="text" name="lname" id="lname"
														class="form-control" required="required" value="<?php echo $row->User_Last_Name;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Gender : </label>
												<div class="col-sm-8">
													<select name="gender" class="form-control"
														required="required">
														<option value="">Select Gender</option>
														<option value="male">Male</option>
														<option value="female">Female</option>
														<option value="others">Others</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Contact No : </label>
												<div class="col-sm-8">
													<input type="text" name="contact" id="contact"
														class="form-control" required="required"
														value="<?php echo $row->Contact_No;?>">
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Email id: </label>
												<div class="col-sm-8">
													<input type="email" name="email" id="email"
														class="form-control" onBlur="checkAvailability()"
														required="required" value="<?php echo $row->User_Email;?>"> <span
														id="user-availability-status" style="font-size: 12px;"></span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Password: </label>
												<div class="col-sm-8">
													<input type="password" name="password" id="password"
														class="form-control" required="required" value ="<?php echo $row->Password;?>"> 
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Confirm Password : </label>
												<div class="col-sm-8">
													<input type="password" name="cpassword" id="cpassword"
														class="form-control" required="required" value ="<?php echo $row->Confirm_Password;?>">
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">User Type : </label>
												<div class="col-sm-8">
													<select class="form-control" name="usertypeid">
												<?php
            $db->query("SELECT * FROM role ");
            while ($rolerow = $db->fetchNextObject()) {
                ?>
												<option value=<?php echo $rolerow->Role_Id ?>><?php echo $rolerow->Role_Name ?></option>
												<?php  } ?>
												</select>
												</div>
											</div>
											
											<?php } ?>
											<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Edit User">
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