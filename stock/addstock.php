<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //

if (isset($_POST['submit'])) {
    $stockCode = $_POST['stockcode'];
    $stockName = $_POST['stockname'];
    $stockDate = $_POST['stockdate'];
    $stockSupplier = $_POST['stocksupplierid'];
    $stockCategory=$_POST['stockcategoryid'];
    $userId=$_SESSION['userid'];
    //echo "<script>alert('Stock insertion ................');</script>";
    $stockDate = strtotime($stockDate);
    $mysqldate = date('Y-m-d H:i:s', $stockDate);
    $stock_purchase_date = $mysqldate;
    $query = "insert into stocks(Stocks_Code,Stocks_Name,Stocks_Date,Stocks_Supplier,User_Id,Category) values('$stockCode','$stockName','$stock_purchase_date',$stockSupplier,'$userId',$stockCategory)";
    $msg = mysqli_query($con, $query);
    
    if ($msg) {
        $c = count($_POST['chk']);
        for ($i = 0; $i < $c; $i ++) {            
            //echo "<script>alert('stock code  is $stockCode');</script>";
            $Stock_Id= $db->queryUniqueValue("SELECT Stocks_Id FROM stocks where Stocks_Code='$stockCode'");
            echo "<script>alert('id is $Stock_Id');</script>";
            $itemName = $_POST['FabricType'][$i];
            $reed = $_POST['Reed'][$i];
            $pick = $_POST['Pick'][$i];
            $warp = $_POST['Warp'][$i];
            $wept = $_POST['Wept'][$i];
            $width = $_POST['Width'][$i];
            $stockQuantity= $_POST['Quantity'][$i];
            $stockSellingPrice = $_POST['SellingPrice'][$i];
            $stockCompanyPrice = $_POST['CompanyPrice'][$i];
           /*  echo "<script>alert('item is $itemName');</script>";            
            echo "<script>alert('reed is $reed');</script>";            
            echo "<script>alert('pick is $pick');</script>";            
            echo "<script>alert('item is $itemName');</script>";
            echo "<script>alert('$stockQuantity');</script>"; */
            
            $query = "insert into stocks_details(Stocks_Fabric_Type,Stocks_Quantity,Stocks_Reed,Stocks_Pick,Stocks_Warp,Stocks_Wept,Stocks_Width,Stocks_Id,Selling_Price,Company_Price) values('$itemName','$stockQuantity','$reed','$pick','$warp','$wept','$width',$Stock_Id,'$stockSellingPrice','$stockCompanyPrice')";
            $msg = mysqli_query($con, $query);
            
            
            $query = "insert into stocks_avail(Stocks_Fabric_Type,Stocks_Quantity,Stocks_Id,Stocks_Code) values('$itemName','$stockQuantity',$Stock_Id,'$stockCode')";
            $msg = mysqli_query($con, $query);
            
        }
        echo "<script>alert('Stock added successfully');</script>";
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
<title>Add Stock</title>
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
<script type="text/javascript" src="js/tablescript.js"></script>
<script type="text/javascript">
function total_amount() {
    alert("total_amount --");
    document.getElementById('total').value = document.getElementById('price').value * document.getElementById('qty').value;
    //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);

}

function grand_total() {
    alert("grandtotal --");

    if (document.getElementById('total').value === "") {
        alert("value is ." + document.getElementById('total').value);
    } else {

        document.getElementById('grandtotal').value = document.getElementById('total').value;
    }
}

function numbersonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
        if (unicode < 48 || unicode > 57)
            return false
    }
}



function sales_report_pdf_fn() {
    window.open("sales_pdf_report.php?=" + $('').val(),

        "myNewWinsr", "width=300,height=500,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
}


function print1() {
    window.open("sales_print.php?start_date=admin", "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
}
    
    
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
						<h2 class="page-title">Add Stock</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Stock</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">

											<div class="form-group">
											<?php
                        $max = $db->maxOfAll("Stocks_Id", "stocks");
                        $max = $max + 1;
                        $autoid = "STC" . $max . "";
                        ?>
												<label class="col-sm-2 control-label">Stock Code </label>
												<div class="col-sm-8">
													<input type="text" readonly="readonly" value="<?php echo $autoid; ?>" name="stockcode"
														class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Stock Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="stockname"
														id="cns" value="" required="required">

												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Stock Date</label>
												<div class="col-sm-8">
													<input class="form-control" name="stockdate" placeholder=""
														value="<?php echo date('d-m-Y H:i:s');?>" type="text" id="name"
														maxlength="200" class="round default-width-input" />

												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Select Category</label>
												<div class="col-sm-8">
													<select class="form-control" name="stockcategoryid">
												<?php
            $db->query("SELECT * FROM Category ");
            while ($row = $db->fetchNextObject()) {
                ?>
												<option value=<?php echo $row->Category_Id ?>><?php echo $row->Category_Name ?></option>
												<?php  } ?>
												</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Supplier</label>
												<div class="col-sm-8">
													<select class="form-control" name="stocksupplierid">
												<?php
            $db->query("SELECT * FROM suppliers ");
            while ($row = $db->fetchNextObject()) {
                ?>
												<option value=<?php echo $row->Suppliers_Id ?>><?php echo $row->Suppliers_Name ?></option>
												<?php  } ?>
												</select>
												</div>
											</div>


											<fieldset class="row2">
												<legend>Item Details</legend>
												<input type="button" value="Add Item"
													onClick="addRow('dataTable','dataTableRow')" /> <input
													type="button" value="Remove Item"
													onClick="deleteRow('dataTable')" />
												<div style="overflow-x: scroll;">
													<div style="height: 100px; background: white;">
														<table id="dataTable" class="form" border="1" id="cssTable">
															<tbody>
																<tr valign="middle" bgcolor="#00ff80" >
																	<th style="text-align:center;">S.No</th>
																	<th style="text-align:center;">Fabric Type</th>
																	<th style="text-align:center;">Reed</th>
																	<th style="text-align:center;">Pick</th>
																	<th style="text-align:center;">Warp</th>
																	<th style="text-align:center;">Wept</th>
																	<th style="text-align:center;">Width</th>
																	<th style="text-align:center;">Quantity</th>
																	<th style="text-align:center;">Company Price</th>
																	<th style="text-align:center;">Selling Price</th>
																</tr>
																<tr id="dataTableRow">
																	<td><input type="checkbox" required="required"
																		name="chk[]" checked="checked" /></td>
																	<td width="20"><input type="text" required="required"
																		class="small" name="FabricType[]"></td>
																	<td width="20"><input type="text" required="required"
																		class="small" name="Reed[]" onkeypress="return numbersonly(event);"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Pick[]" onkeypress="return numbersonly(event);"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Warp[]" onkeypress="return numbersonly(event);"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Wept[]" onkeypress="return numbersonly(event);"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Width[]" onkeypress="return numbersonly(event);"></td>
																	<td><input type="text" required="required"
																		class="small" name="Quantity[]" onkeypress="return numbersonly(event);"></td>
																	<td><input type="text" required="required"
																		class="small" name="CompanyPrice[]" onkeypress="return numbersonly(event);"></td>
																	<td><input type="text" required="required"
																		class="small" name="SellingPrice[]" onkeypress="return numbersonly(event);"></td>

																</tr>
															</tbody>
														</table>
													</div>
												</div>
												

											</fieldset>
											
											<div class="clear"></div>
											
											<div class="col-sm-8 col-sm-offset-2">
												<input class="btn btn-primary" type="submit" name="submit"
													value="Add stock">
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
</body>

</html>