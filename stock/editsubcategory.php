<?php
session_start();
include ('includes/config.php');
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS);
if ($_POST['submit']) {
    $subcategoryName = $_POST['subcategoryname'];
    $subcategoryDescription = $_POST['subcategorydescription'];
    $category = $_POST['categoryid'];
    $subcategoryid = $_POST['subcategoryid'];
    if ($db->query("UPDATE Subcategory SET Subcategory_Name='$subcategoryName', Subcategory_Description='$subcategoryDescription',Category=$category  WHERE Subcategory_Id=$id")) {
        $data = " $subcategoryName  Category Details Updated";
        $msg = '<p style=color:#153450;font-family:gfont-family:Georgia, Times New Roman, Times, serif>' . $data . '</p>'; //
    } else {
        echo "<script>alert('Subcategory has not Updated ');</script>";
    }
    
    /*
     * $query = "update stocks set stock_code=?,stock_short_name=?,stock_full_name=? where stock_id=?";
     * $stmt = $mysqli->prepare($query);
     * $rc = $stmt->bind_param('sssi', $coursecode, $coursesn, $coursefn, $id);
     * $stmt->execute();
     * echo "<script>alert('Stock has been Updated successfully');</script>";
     */
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
<title>Edit Subcategory</title>
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

						<h2 class="page-title">Edit Subcategory</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Subcategory</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php
            $id = $_GET['id'];
            $ret = "select * from Subcategory where Subcategory_Id=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('i', $id);
            $stmt->execute(); // ok
            $res = $stmt->get_result();
            // $cnt=1;
            while ($row = $res->fetch_object()) {
                ?>
                <input type="hidden" name="subcategoryid"
												value="<?php echo $row->Subcategory_Id;?>" />
											<div class="form-group">
												<label class="col-sm-2 control-label">Select Category</label>
												<div class="col-sm-8">
													<select class="form-control" name="categoryid">
												<?php
                $db->query("SELECT * FROM category ");
                while ($rowcat = $db->fetchNextObject()) {
                    ?>
												<option value=<?php echo $rowcat->Category_Id ?>><?php echo $rowcat->Category_Name ?></option>
												<?php  } ?>
												</select>

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Subcategory Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="subcategoryname" id="subcategoryname"
														value="<?php echo $row->Subcategory_Name;?>"
														required="required">

												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Subcategory
													Description</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														name="subcategorydescription" id="subcategorydescription"
														value="<?php echo $row->Subcategory_Description;?>"
														required="required">

												</div>
											</div>


<?php } ?>
												<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Update">
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