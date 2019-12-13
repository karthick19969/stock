<!doctype html>
<?php
session_start();
include ('includes/config.php');
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS);
$flag=false;
if ($_POST['submit']) {
    $from = $_POST['fromdate'];
    
    $fromdate= date("Y-m-d", strtotime($from) );
    
    echo "<script>alert('from date .$from');</script>";
    $to=$_POST['todate'];
    $todate= date("Y-m-d", strtotime($to) );
    //$query = "SELECT * FROM stocks where Stocks_Date>='.$from.' and Stocks_Date<='.$to.';";
    $query = "SELECT * FROM stocks where Stocks_Date >= '$fromdate' and Stocks_Date<= '$todate';";
    echo "<script>alert('query is  .$query');</script>";
    
    $stmt= $mysqli->prepare($query) ;
    $stmt->execute() ;//ok
    $res=$stmt->get_result();
    $cnt=1;
    
    $flag=true;
    
}
?>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#3e454c">


<head>
<meta charset="utf-8">
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
<title>stock Report</title>

<link rel="stylesheet" href="css/datepickerui.css">
  
  <script src="js/jquerydate.js"></script>
  <script src="js/jquerydate-ui.js"></script>
 <script>
  $( function() {
    $( "#todate" ).datepicker();

    $( "#fromdate" ).datepicker();
  } );
  </script>
</head>
<body>
 <?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Stock Report</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Stock Report</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
											<div class="col-md-5">
												<div class="form-group">
													<label class="col-sm-2 control-label">From Date </label>
													<div class="col-sm-8">
														<input type="text" name="fromdate" id="fromdate"
															class="form-control" value="">


													</div>
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label class="col-sm-2 control-label">To Date</label>
													<div class="col-sm-8">
													
													
														<input class="form-control" name="todate" placeholder=""
															type="text" id="todate" class="round default-width-input" />

													</div>
												</div>
												</div>
												<div class="col-sm-8 col-sm-offset-2">

													<input class="btn btn-primary" type="submit" name="submit"
														value="Generate report">
												</div>
										
										</form>
										<div class="clear"></div>
										<div class="clear"></div>
										<div id="tableReport" class="col-md-12">
										<?php  if ($flag){
										    
										    // Return the number of rows in result set
										    $rowcount=mysqli_num_rows($res);
										    printf("Report has %d rows.\n",$rowcount);
										  ?>
										  <table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										  <thead> 
										<tr>
											<th>Stock Code</th>
											<th>Stock Name</th>							
											<th>Stock Date</th>
											<th>Quantity Available</th>
										</tr>
									</thead>
									<tbody>
										  <?php 
										    while($row=$res->fetch_object())
										    {
										        ?>
										        <tr><td><?php $stockId=$row->Stocks_Id; echo $row->Stocks_Code; ?></td>
<td><?php echo $row->Stocks_Name;?></td>

<td><?php echo $row->Stocks_Date;?></td>
<?php 

$StockQty= $db->queryUniqueValue("SELECT Stocks_Quantity FROM stocks_avail where Stocks_Id=$stockId");

?>
<td><?php echo $StockQty;?></td>
</tr>
										        
										        <?php 
										    }
										    ?>
										   </tbody> </table>
										    <?php 
										}?>
										</div>
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
	<script src="js/jquerydate.js"></script>
  <script src="js/jquerydate-ui.js"></script>
<?php include("includes/footer.php");?>

</body>
</html>