<?php
session_start();
include ('includes/config.php');
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS);
// include('includes/checklogin.php');
// check_login();
// code for add stocks
if ($_POST['submit']) {
    $stockId = $_POST['stockid'];
    $stockCode = $_POST['stockcode'];
    $stockName = $_POST['stockname'];
    $stockDate = $_POST['stockdate'];
    $stockSupplier = $_POST['stocksupplierid'];
    echo "<script>//alert('Stock insertion ................');</script>";
    $stockDate = strtotime($stockDate);
    $mysqldate = date('Y-m-d H:i:s', $stockDate);
    $stock_purchase_date = $mysqldate;
    $query = "update stocks set Stocks_Code=?,Stocks_Name=?,Stocks_Date=?,Stocks_Supplier=? where Stocks_Id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssii', $stockCode, $stockName, $stockDate,$stockSupplier, $stockId);
    $stmt->execute();
    echo "<script>//alert('Stock has been Updated successfully');</script>";
    if (true) {
        $c = count($_POST['chk']);
        for ($i = 0; $i < $c; $i ++) {
           
            
            echo "<script>//alert('stock code  is $stockCode');</script>";
            $Stock_Id= $db->queryUniqueValue("SELECT Stocks_Id FROM stocks where Stocks_Code='$stockCode'");
            echo "<script>//alert('id is $Stock_Id');</script>";
            
            $detailsId = $_POST['stockdetails'][$i];
            echo "<script>//alert('stock details id   is $detailsId');</script>";
            
            $itemName = $_POST['FabricType'][$i];
            $reed = $_POST['Reed'][$i];
            $pick = $_POST['Pick'][$i];
            $warp = $_POST['Warp'][$i];
            $wept = $_POST['Wept'][$i];
            $width = $_POST['Width'][$i];
            $stockQuantity= $_POST['Quantity'][$i];
            $stockSellingPrice = $_POST['SellingPrice'][$i];
            $stockCompanyPrice = $_POST['CompanyPrice'][$i];
            echo "<script>//alert('item is $itemName');</script>";
            echo "<script>//alert('reed is $reed');</script>";
            echo "<script>//alert('pick is $pick');</script>";
            echo "<script>//alert('item is $itemName');</script>";
            
            
            echo "<script>//alert('$stockQuantity');</script>";
            echo "<script>//alert(' selling price is $stockSellingPrice');</script>";
            
            
            //$query = "update stocks_details set Stocks_Fabric_Type=?,Stocks_Quantity=?,Stocks_Reed=?,Stocks_Pick=?,Stocks_Warp=?,Stocks_Wept=?,Stocks_Width=?,Selling_Price=?,Company_Price=? where Stocks_Details_Id=?";
            //$query = "update stocks_details set Stocks_Fabric_Type=?,Stocks_Quantity=?,Stocks_Reed=?,Stocks_Pick=?,Stocks_Warp=?,Stocks_Wept=?,Stocks_Width=?,Selling_Price=?  where Stocks_Details_Id=?";
            $query = "update stocks_details set Stocks_Fabric_Type=?,Stocks_Quantity=?,Stocks_Reed=?,Stocks_Pick=?,Stocks_Warp=?,Stocks_Wept=?,Stocks_Width=?,Selling_Price=?,Company_Price=? where Stocks_Details_Id=?";
            $stmt = $mysqli->prepare($query);
            //$rc = $stmt->bind_param('sssssssssi',$itemName,$stockQuantity, $reed,$pick,$warp,$wept,$width,$stockSellingPrice,$stockCompanyPrice, $detailsId);
            //$rc = $stmt->bind_param('ssssssssi',$itemName,$stockQuantity, $reed,$pick,$warp,$wept,$width,$stockSellingPrice, $detailsId);
            $rc = $stmt->bind_param('sssssssssi',$itemName,$stockQuantity, $reed,$pick,$warp,$wept,$width,$stockSellingPrice,$stockCompanyPrice, $detailsId);
            $stmt->execute();
            echo "<script>//alert('Stock details updated successfully');</script>";
            
           // $query = "update stocks_avail set Stocks_Fabric_Type=?,Stocks_Quantity =? Where values('$itemName','$stockQuantity')";
            //$msg = mysqli_query($con, $query);
            
        }
       
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
<title>Edit Stock</title>
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

<script type="text/javascript">
function total_amount() {
    //alert("total_amount --");
    document.getElementById('total').value = document.getElementById('price').value * document.getElementById('qty').value;
    //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);

}

function grand_total() {
    //alert("grandtotal --");

    if (document.getElementById('total').value === "") {
        //alert("value is ." + document.getElementById('total').value);
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

						<h2 class="page-title">Edit Stock</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit stock</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php
            $id = $_GET['id'];
            $ret = "select * from stocks where Stocks_Id=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('i', $id);
            $stmt->execute(); // ok
            $res = $stmt->get_result();
            // $cnt=1;
            while ($row = $res->fetch_object()) {
                ?><input type="hidden" name="stockid" value="<?php echo $row->Stocks_Id;?>" />
											<div class="form-group">
												<label class="col-sm-2 control-label">Stock Code </label>
												<div class="col-sm-8">
													<input type="text" readonly="readonly" name="stockcode"
														value="<?php echo $row->Stocks_Code;?>"
														class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Stock Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" readonly="readonly"  name="stockname" id="cns"
														value="<?php echo $row->Stocks_Name;?>"
														required="required">
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Stock Date</label>
												<div class="col-sm-8">
													<input class="form-control" name="stockdate" placeholder=""
														value="<?php echo $row->Stocks_Date;?>" type="text"
														id="name" maxlength="200"
														class="round default-width-input" />

												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Select Category</label>
												<div class="col-sm-8">
													<select class="form-control" name="stockcategoryid">
												<?php
                $db->query("SELECT * FROM Category ");
                while ($rowcat = $db->fetchNextObject()) {
                    ?>
												<option value=<?php echo $rowcat->Category_Id ?>><?php echo $rowcat->Category_Name ?></option>
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
                while ($rowsupp = $db->fetchNextObject()) {
                    ?>
												<option value=<?php echo $rowsupp->Suppliers_Id ?>><?php echo $rowsupp->Suppliers_Name ?></option>
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
														<table id="dataTable" class="form" border="1">
															<tbody>
																<tr bgcolor="#00ff80" align="center">
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
																<?php
												$retDetails = "select * from stocks_details where Stocks_Id=?";
												$stmtDetails = $mysqli->prepare($retDetails);
												$stmtDetails->bind_param('i', $id);
												$stmtDetails->execute(); // ok
												$resDetails = $stmtDetails->get_result();
												// $cnt=1;
												while ($rowDetails = $resDetails->fetch_object()) {
                    ?>
																<tr id="dataTableRow">
																	<td><input type="checkbox" required="required"
																		name="chk[]" checked="checked" />
																		<input type="hidden" 
																		name="stockdetails[]" value="<?php echo $rowDetails->Stocks_Details_Id ?>" /></td>
																	<td width="20"><input type="text" required="required"
																		class="small" name="FabricType[]" value="<?php echo $rowDetails->Stocks_Fabric_Type ?>"></td>
																	<td width="20"><input type="text" required="required"
																		class="small" name="Reed[]" value="<?php echo $rowDetails->Stocks_Reed ?>"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Pick[]" value="<?php echo $rowDetails->Stocks_Pick ?>"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Warp[]" value="<?php echo $rowDetails->Stocks_Warp ?>"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Wept[]" value="<?php echo $rowDetails->Stocks_Wept ?>"></td>
																	<td width="50"><input type="text" required="required"
																		class="small" name="Width[]" value="<?php echo $rowDetails->Stocks_Width ?>"></td>
																	<td><input type="text" required="required"
																		class="small" name="Quantity[]" value="<?php echo $rowDetails->Stocks_Quantity ?>"></td>
																		
																	<td><input type="text" required="required" 
																		class="small" name="CompanyPrice[]" value="<?php echo $rowDetails->Company_Price ?>"></td>
																		
																	<td><input type="text" required="required"
																		class="small" name="SellingPrice[]" value="<?php echo $rowDetails->Selling_Price ?>"></td>

																</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>


											</fieldset>
<?php } ?>
												<div class="col-sm-8 col-sm-offset-2">

												<input class="btn btn-primary" type="submit" name="submit"
													value="Update Stock"> <input
													class="btn btn-primary" type="submit" name="PrintButton"
													value="Print" onClick='print1();'>
												<!--button class="btn btn-primary" type="button" name="submit"
													value="Save" onClick='getrows();'>Save </button>
													
													<button class="btn btn-primary" type="button"
													name="Print" value="Print" onClick='print1();'>Print</button-->
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