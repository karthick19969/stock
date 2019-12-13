<?php
session_start();
include ('includes/config.php');
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS);
if (isset($_POST['submit'])) {
    $categoryName = $_POST['categoryname'];
    $categoryDescription = $_POST['categorydescription'];
    $id = $_POST['categoryid'];
    
    echo "<script>alert('Category is  $id');</script>";
    
    echo "<script>alert('Category is  $categoryName');</script>";
    echo "<script>alert('Category is  $categoryDescription');</script>";
    
    if($db->query("UPDATE category SET Category_Name='$categoryName', Category_Description='$categoryDescription' WHERE Category_Id=$id")){
        $data = " $categoryName  Category Details Updated";
        $msg = '<p style=color:#153450;font-family:gfont-family:Georgia, Times New Roman, Times, serif>' . $data . '</p>'; //
    }else{
        echo "<script>alert('Category has not Updated ');</script>";
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
<title>Edit Category</title>
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

						<h2 class="page-title">Edit Category</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Category</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php
            $id = $_GET['id'];
            $ret = "select * from category where Category_Id=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('i', $id);
            $stmt->execute(); // ok
            $res = $stmt->get_result();
            // $cnt=1;
            while ($row = $res->fetch_object()) {
                ?>
                <input type="hidden" name="categoryid" value="<?php echo $row->Category_Id;?>" />
											<div class="form-group">
												<label class="col-sm-2 control-label">Category Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="categoryname"
														id="categoryname"
														value="<?php echo $row->Category_Name;?>"
														required="required">

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Category Description</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="categorydescription" id="categorydescription"
														value="<?php echo $row->Category_Description;?>">

												</div>
											</div>
											


<?php } ?>
												<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Update Stock">
											</div>
									
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