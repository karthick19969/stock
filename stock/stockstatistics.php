<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");

$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //
?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin - Dashboard</title>

<!-- Stylesheets -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700'
	rel='stylesheet'>
<link rel="stylesheet" href="css/style.css">

<!-- Optimize for mobile devices -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- jQuery & JS files -->

<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<link rel="stylesheet" href="css/stock.css">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- link rel="stylesheet" href="css/bootstrap.min.css"-->
<link rel="stylesheet" href="css/bootstrap.min.v335.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-social.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link rel="stylesheet" href="css/fileinput.min.css">
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/header.css">
<style>
@font-face {
	font-family: Lobster;
	src: url('Lobster.otf');
}

h1 {
	font-family: Lobster;
	text-align: center;
}

table {
	border-collapse: collapse;
	border-radius: 25px;
	width: 880px;
}

table, td, th {
	border: 1px solid #00BB64;
}

tr input {
	width: 50px;
	height: 30px;
	border: 1px solid #fff;
}

tr input .total {
	width: 120px;
	height: 30px;
	border: 1px solid #fff;
}

input:focus {
	border: 1px solid yellow;
}

.space {
	margin-bottom: 2px;
}

#container {
	margin-left: 210px;
}

.but {
	width: 270px;
	background: #00BB64;
	border: 1px solid #00BB64;
	height: 40px;
	border-radius: 3px;
	color: white;
	margin-top: 10px;
	margin: 0px 0px 0px 290px;
}
</style>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>

</head>
<body>
<?php
include ('includes/header.php');
?>
	<div class="ts-main-content">
		<?php
include ('includes/sidebar.php');
?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Stock Stockistics</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Stock statistics</div>
									<div class="panel-body">
										<table style="width: 350px; float: left;">
											<tr>
												<td width="250" align="left">&nbsp;</td>
												<td width="150" align="left">&nbsp;</td>
											</tr>
											<tr>
												<td align="left">Total Number of Products</td>
												<td align="left"><?php echo  $count = $db->countOfAll("stocks_avail");?>&nbsp;</td>
											</tr>
											<tr>
												<td align="left">&nbsp;</td>
												<td align="left">&nbsp;</td>
											</tr>
											<tr>
												<td align="left">Total Sales Transactions</td>
												<td align="left"><?php echo  $count = $db->countOfAll("stocks_sales");?></td>
											</tr>
											<tr>
												<td align="left">&nbsp;</td>
												<td align="left">&nbsp;</td>
											</tr>
											<tr>
												<td align="left">Total number of Suppliers</td>
												<td align="left"><?php echo $count = $db->countOfAll("suppliers");?></td>
											</tr>
											<tr>
												<td align="left">&nbsp;</td>
												<td align="left">&nbsp;</td>
											</tr>
											<tr>
												<td align="left">Total Number of Customers</td>
												<td align="left"><?php echo $count = $db->countOfAll("customer");?></td>
											</tr>
											<tr>
												<td align="left">&nbsp;</td>
												<td align="left">&nbsp;</td>
											</tr>
											<tr>
												<td align="left">&nbsp;</td>
												<td align="left">&nbsp;</td>
											</tr>
										</table>
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
	<script src="js/jquery-v2.1.3.js"></script>
	<script src="js/bootstrap-v3.3.5.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
	
	</script>

<?php
include ("includes/footer.php");
 ?>
</body>
</html>