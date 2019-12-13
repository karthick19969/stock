<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
include ('includes/config.php');
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); 

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $tablename="Category";
    
    $db->execute("DELETE FROM $tablename WHERE Category_Id=$id");
    echo "<script>alert('Data Deleted');</script>" ;
    
 
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
<title>Manage Categories</title>
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
						<h2 class="page-title">Manage Categories</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Categories Details</div>
							<div class="panel-body">
								<table id="zctb"
									class="display table table-striped table-bordered table-hover"
									cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Category Name</th>
											<th>Category Description</th>
											<th>Action</th>

										</tr>
									</thead>
									<!-- tfoot>
										<tr>
											<th>Sl No</th>
											<th>Stock Code</th>
											<th>Stock Name(Short)</th>
											<th>Stock Name(Full)</th>
											<-th>Regd Date</th>
											<th>Action</th>										</tr>
									</tfoot-->
									<tbody>
<?php
// $aid=$_SESSION['id'];
$ret = "select * from category";
$stmt = $mysqli->prepare($ret);
// $stmt->bind_param('i',$aid);
$stmt->execute(); // ok
$res = $stmt->get_result();
$cnt = 1;
while ($row = $res->fetch_object()) {
    ?>
<tr>
											<td><?php echo $cnt;;?></td>
											<td><?php echo $row->Category_Name;?></td>
											<td><?php echo $row->Category_Description;?></td>
											<td><a
												href="editcategory.php?id=<?php echo $row->Category_Id;?>"><i
													class="fa fa-edit"></i></a>&nbsp;&nbsp; <a
												href="managecategory.php?del=<?php echo $row->Category_Id;?>"
												onclick="return confirm(\"Do you want to delete\");"><i
													class="fa fa-close"></i></a></td>
										</tr>
									<?php
    $cnt = $cnt + 1;
}
$stmt->close();
?>										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Loading Scripts -->
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
