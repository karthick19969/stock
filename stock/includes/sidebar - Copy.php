

<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		<li class="start"><a href="dashboard.php"><i class="icon-custom-home"></i>
				<span class="title">Dashboard</span> <span class="selected"></span>
		</a>
<?php
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
include ('includes/config.php');
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //
$type = 0;
$ut = $_SESSION['role'];
//echo "<script>alert('ut is  $ut ');</script>";
$tbl_name = "role"; // Table name
$searchuser = "SELECT * FROM $tbl_name WHERE Role_Id='$ut'";
$result = mysql_query($searchuser);
$userrole = "";
if ($result) {
    // Register $myusername, $mypassword and redirect to file "dashboard.php"
    $row = mysql_fetch_row($result);
    $userrole = $row[1];
}
if (strcasecmp($userrole, "admin") == 0) {
    echo "Admin";
    
    $type = 1;
} elseif (strcasecmp($userrole, "employee") == 0) {
    echo "Employee";
    $type = 2;
} elseif (strcasecmp($userrole, "customer") == 0) {
    echo "Customer";
    $type = 3;
} elseif (strcasecmp($userrole, "Normal Users") == 0) {
    echo "Normal User";
    $type = 4;
}
?>
			<!-- ul class="nav pull-right notifcation-center">
				<li class="dropdown" id="header_task_bar"><a href="#" data-toggle="">
						<div class="iconset top-home"></div>
				</a></li>

			</ul--></li>
			
				<?PHP
    
    if ($type == 2) {
        ?>
					<li><a href="#"><i class="fa fa-files-o"></i> Stock</a>
			<ul>
				<li><a href="addstock.php">Add Stock</a></li>
				<li><a href="managestock.php">Manage Stock</a></li>
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i> Suppliers</a>
			<ul>
				<li><a href="addsupplier.php">Add Supplier</a></li>
				<li><a href="managesupplier.php">Manage Suppliers</a></li>
			</ul></li>
		<li><a href="#"><i class="fa fa-files-o"></i>Customer</a>
			<ul>
				<li><a href="addcustomer.php">Add Customer</a></li>
				<li><a href="managecustomer.php">Manage Customers</a></li>
			</ul></li>
		<?PHP }elseif ($type==4) { ?>
					<li><a href="#"><i class="fa fa-files-o"></i> Stock</a>
			<ul>
				<li><a href="addstock.php">Add Stock</a></li>
				<li><a href="managestock.php">Manage Stock</a></li>
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i> Suppliers</a>
			<ul>
				<li><a href="addsupplier.php">Add Supplier</a></li>
				<li><a href="managesupplier.php">Manage Suppliers</a></li>
			</ul></li>
		<li><a href="#"><i class="fa fa-files-o"></i>Customer</a>
			<ul>
				<li><a href="addcustomer.php">Add Customer</a></li>
				<li><a href="managecustomer.php">Manage Customers</a></li>
			</ul></li>
		
	<?php } elseif ($type==1) { 	?>
				
		

		<li><a href="#"><i class="fa fa-files-o"></i> Stock</a>
			<ul>
				<li><a href="addstock.php">Add Stock</a></li>
				<li><a href="managestock.php">Manage Stock</a></li>
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i> Suppliers</a>
			<ul>
				<li><a href="addsupplier.php">Add Supplier</a></li>
				<li><a href="managesupplier.php">Manage Suppliers</a></li>
			</ul></li>
		<li><a href="#"><i class="fa fa-files-o"></i>Customer</a>
			<ul>
				<li><a href="addcustomer.php">Add Customer</a></li>
				<li><a href="managecustomer.php">Manage Customers</a></li>
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i>Category</a>
			<ul>
				<li><a href="addcategory.php">Add Category</a></li>
				<li><a href="managecategory.php">Manage Category</a></li>
				<!-- li><a href="addsubcategory.php">Add SubCategory</a></li>
				<li><a href="managesubcategory.php">Manage SubCategory</a></li-->
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i>User</a>
			<ul>
				<li><a href="userregistration.php">Add User</a></li>
				<li><a href="manageusers.php">Manage User</a></li>
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i>Sales Order</a>
			<ul>
				<li><a href="addsales.php">Add Sales</a></li>
				<li><a href="managesales.php">Manage Sales</a></li>
			</ul></li>

		<li><a href="#"><i class="fa fa-files-o"></i>Report</a>
			<ul>
				<li><a href="report.php">Report</a></li>

			</ul></li>
		<li><a href="access-log.php"><i class="fa fa-file-o"></i>Access log</a></li>
				<?php } ?>

			</ul>
</nav>