<?php
session_start();
require_once ("includes/dbconnection.php");
$msg = false;
$show =true;
if (isset($_POST['submit'])) {
    $categoryName = $_POST['categoryname'];
    $categoryDescription = $_POST['categorydescription'];
    
    $query = "insert into category(Category_Name,Category_Description) values('$categoryName','$categoryDescription')";
    $msg = mysqli_query($con, $query);
    if(!$msg)
        $show=false;
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
<title>Add Category</title>
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

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Add Category</h2>
						<?php
    
if ($msg) {
        echo "Category successfully";
    } else {
        if(!$show){
        echo "OOPS ! Something went wrong.";
        }
    }
    ?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Category</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
											<div class="form-group">
												<label class="col-sm-2 control-label">Category Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="categoryname"
														id="categoryname" value="" required="required">

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Category Description</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="categorydescription" id="categorydescription"
														value="" required="required">

												</div>
											</div>
											<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Add Category">
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