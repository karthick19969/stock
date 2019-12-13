<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //

if (isset($_POST['submit'])) {
    $subCategoryName = $_POST['subcategoryname'];
    $subCategoryDescription = $_POST['subcategorydescription'];
    $category = $_POST['categoryid'];
    $query = "insert into subcategory(Subcategory_Name,Subcategory_Description,Category) values('$subCategoryName','$subCategoryDescription',$category)";
    $msg = mysqli_query($con, $query);
    
    if ($msg) {
        echo "<script>alert('Subcategory added successfully');</script>";
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
<title>Add Subcategory</title>
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

						<h2 class="page-title">Add SubCategory</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add SubCategory</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">

											<div class="form-group">
												<label class="col-sm-2 control-label">Select Category</label>
												<div class="col-sm-8">
													<select class="form-control" name="categoryid">
												<?php
                                                     $db->query("SELECT * FROM category ");
                                                        while ($row = $db->fetchNextObject()) {
                                                ?>
												<option value=<?php echo $row->Category_Id ?>><?php echo $row->Category_Name ?></option>
												<?php  } ?>
												</select>

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Subcategory Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="subcategoryname" id="subcategoryname"
														value="" required="required">

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Subcategory Description</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="subcategorydescription" id="subcategorydescription"
														value="" required="required">

												</div>
											</div>
											<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Add SubCategory">
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

</body>

</html>