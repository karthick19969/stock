<?php
session_start();
require_once ("includes/dbconnection.php");

include_once ("includes/stockdb.php");

$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //

if (isset($_POST['submitButton']))
	{
	//echo "<script>alert('................... Stock insertion started ...........');</script>";
	$user = $_SESSION['userfirstname'];
	$stockSalesCode = $_POST['salescode'];
	$stockSalesDate = $_POST['salesdate'];
	$billNo = $_POST['billNo'];
	$grandTotal = $_POST['grandtotal'];
	$payment = $_POST['payment'];
	$balance = $_POST['balance'];
	$customer = $_POST['customer'];
	$duedate = $_POST['duedate'];
	$selected_due_date = strtotime($duedate);
	$mysqlduedate = date('Y-m-d H:i:s', $selected_due_date);
	$due = $mysqlduedate;
	$selected_date = strtotime($stockSalesDate);
	$mysqldate = date('Y-m-d H:i:s', $selected_date);
	$today = $mysqldate;
	echo "<script>console.log('Stock customer ................$customer');</script>";
	$query = "insert into stocks_transactions(Transaction_Date,Stocks_Transactions_Type,Stocks_Sales_Code,Stocks_Customer,Receipt_Bill_Number,Total,Payment,Balance,Due) values('$today','Sell','$stockSalesCode',$customer,'$billNo','$grandTotal','$payment','$balance','$due')";
	$msg = mysqli_query($con, $query);
	if ($balance > 0)
		{
		    
		}

	$max_trans_id = $db->maxOfAll("Stocks_Transactions_Id", "stocks_transactions");
	echo "<script>console.log('Stock insertion ................$max_trans_id');</script>";
	$query = "insert into Stocks_Sales(Stocks_Sales_Code,Stocks_Transactions_Id,Stocks_Sales_Date,Stocks_Sales_Amount,User,Payment,Balance,Bill_No) values('$stockSalesCode',$max_trans_id,'$today','$grandTotal','$user','$payment','$balance','$billNo')";
	$msg = mysqli_query($con, $query);
	$c = $_POST['checkyear'];
	echo "<script>alert(' row count is ....$c');</script>";
	if ($msg)
		{
		for ($i = 0; $i < $c; $i++)
			{
			//echo "<script>alert(' row count is ....$i');</script>";
			$itemName = $_POST['stockcode_'.$i];
			$reed = $_POST['Reed_' . $i];
			$pick = $_POST['Pick_' . $i];
			$warp = $_POST['Warp_' . $i];
			$wept = $_POST['Wept_' . $i];
			$width = $_POST['Width_' . $i];
			echo "<script>alert('------------------- Stock width -----.$width');</script>";
			$stockQuantity = $_POST['Quantity_' . $i];
			$sellingPrice = $_POST['SellingPrice_' . $i];
			$totalPrice = $_POST['Total_' . $i];
			echo "<script>alert('------------------- Stock checking is available -------------------');</script>";
			$cntAvailableQuantity = $db->queryUniqueValue("SELECT count(*) FROM stocks_avail WHERE Stocks_Code='$itemName'");
			if ($cntAvailableQuantity > 0)
				{
				$availableQuantity = $db->queryUniqueValue("SELECT Quantity FROM stocks_avail WHERE Stocks_Code='$itemName'");
				$quantity = $availableQuantity - $stockQuantity;
				if ($quantity > 0)
					{
					$db->execute("UPDATE stocks_avail SET Quantity=$quantity WHERE Stocks_Code='$itemName'");
					}
				  else
					{
					echo "Sorry available quantity not available.Please raise purchase stock for updation ......";
					}
				}
			  else
				{
				echo "<script>alert('Stock not available ..............................');</script>";
				}

			$salesStockId = $db->maxOfAll("Stocks_Sales_Id", "stocks_sales");

			// $salesStockId = $db->queryUniqueValue("SELECT Stocks_Sales_Id FROM stocks_sales WHERE Stocks_Sales_Code='$stockSalesCode'");

			echo "<script>console.log('Stock sales id ..............................$salesStockId');</script>";
			$queryDetails = "insert into Stocks_Sales_Details(Stocks_Sales_Id,Stock_Name,Reed,Pick,Warp,Wept,Stocks_Quantity,Selling_Price,Amount) values($salesStockId,'$itemName','$reed','$pick','$warp','$wept','$stockQuantity',$sellingPrice,$totalPrice)";
			$msgDetails = mysqli_query($con, $queryDetails);
			}

		echo "<script>console.log('Stock added successfully');</script>";
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
<title>Edit Sales</title>
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
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<style>
@font-face{font-family: Lobster;src: url('Lobster.otf');}
h1{font-family: Lobster;text-align:center;}
table{border-collapse:collapse;border-radius:25px;width:880px;}
table, td, th{border:1px solid #00BB64;}
tr input{width:50px;height:30px;border:1px solid #fff;}
tr input .total{width:120px;height:30px;border:1px solid #fff;}
input:focus{border:1px solid yellow;} 
.space{margin-bottom: 2px;}
#container{margin-left:210px;}
.but{width:270px;background:#00BB64;border:1px solid #00BB64;height:40px;border-radius:3px;color:white;margin-top:10px;margin:0px 0px 0px 290px;}
</style>

<script type="text/javascript">

function calculateSum() {
	alert(' calculateSum --------');
	var sum = 0;
	//iterate through each td based on class and add the values
	    $(".total").each(function() {

	        //add only if the value is number
	        if(!isNaN(this.value) && this.value.length!=0) {
	            sum += parseFloat(this.value);
	        }

	    });
	//$('#grandtotal').text(sum);   
	//alert(' calculateSum --------'+sum);
	document.getElementById("grandtotal").value=parseFloat(sum).toFixed(2);; 
	}


function grand_total() {
	//alert('--------------- grand_total ---------');
	var row = $("#tbl_posts tbody tr").last();
}

function getRows(){
	//alert('get rows ');
	var row = $("#tbl_posts tbody tr").last(); // table row ID 
	var oldId = Number(row.attr('id').slice(-1));

   	// alert(oldId);


   	document.getElementById("checkyear").value = oldId;
   	//alert('checkyear --> '+document.getElementById("checkyear").value);
}
function addAnotherRow() {
    var row = $("#tbl_posts tbody tr").last().clone();
    
    var oldId = Number(row.attr('id').slice(-1));
    //alert('Row id is '+(oldId));   
    var id = 1 + oldId;
    //alert('Row oldId-1 is '+(oldId-1)); 
    row.attr('id', 'rec-' + id );
    row.find('.sn').html(id);
    row.find('input[name="stockcode_'+(oldId-1)+'"]').attr('id', 'stockcode_' + oldId).attr('name', 'stockcode_' + oldId);
    row.find('input[name="Reed_'+(oldId-1)+'"]').attr('id', 'Reed_' + oldId).attr('name', 'Reed_' + oldId).val("");
    row.find('input[name="Pick_'+(oldId-1)+'"]').attr('id', 'Pick_' + oldId).attr('name', 'Pick_' + oldId).val("");
    row.find('input[name="Warp_'+(oldId-1)+'"]').attr('id', 'Warp_' + oldId).attr('name', 'Warp_' + oldId).val("");
    row.find('input[name="Wept_'+(oldId-1)+'"]').attr('id', 'Wept_' + oldId).attr('name', 'Wept_' + oldId).val("");
    row.find('input[name="Width_'+(oldId-1)+'"]').attr('id', 'Width_' + oldId).attr('name','Width_' + oldId).val("");
    row.find('input[name="SellingPrice_'+(oldId-1)+'"]').attr('id', 'SellingPrice_' + oldId).attr('name', 'SellingPrice_' + oldId).val("");
    row.find('input[name="Quantity_'+(oldId-1)+'"]').attr('id', 'Quantity_' + oldId).attr('name', 'Quantity_' + oldId).val("");
    row.find('input[name="Total_'+(oldId-1)+'"]').attr('id', 'Total_' + oldId).attr('name', 'Total_' + oldId).val("");
   	
    $('#tbl_posts tbody').append(row);
}

function enableDiscountFields(chkDiscount) {
    var txtDiscountPer = document.getElementById("discount_per");
    var txtDiscountAmount = document.getElementById("discount_amount");
    txtDiscountPer.disabled = chkDiscount.checked ? false : true;
    txtDiscountAmount.disabled = chkDiscount.checked ? false : true;
    if (!txtDiscountPer.disabled) {
    	txtDiscountPer.focus();
    }
}
function changeStatus(isChecked){
	document.getElementById('discount_per').readOnly = !isChecked;
}



	

function balance_amount(){
	var payable = parseFloat(document.getElementById('payableamount').value);
	var payment = parseFloat(document.getElementById('payment').value);
	document.getElementById('balance').value = parseFloat(payment-payable).toFixed(2);
}

function numbersonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
        if (unicode < 48 || unicode > 57)
            return false
    }
}

function discount_amount_calc(){
	var total = document.getElementById('grandtotal').value;
	alert("total is "+total);
	if(total > 0){
	}else{
		
	}
	// console.log("------------------------------------------------------------");
	 var discountChecked  = document.getElementById("discountCheck");
	 alert("discountChecked.checked is "+discountChecked.checked);
	  if(discountChecked.checked){
		  // console.log("am here ........................");
		  var txtDiscountPer = document.getElementById("discount_per");		  
		  var per=  document.getElementById('discount_per').value;
		  //alert("am here 22222........................"+per);
		  if (per === "") {
		  }else{
			  // console.log("am here 22222........................");
				var total = document.getElementById('grandtotal').value;
				alert("total is "+total);
				if(total > 0){
					var disAmt = total * ( per / 100); 
					if(disAmt > 0 && disAmt <= total){
						document.getElementById('discount_amount').value = disAmt;
					}
				}else{
					alert("Please add the stock sales items to get the discount amount");
				}
		  }
		  //total_amount();
	  }
}

function sales_report_pdf_fn() {
    window.open("sales_pdf_report.php?=" + $('').val(),"myNewWinsr", "width=300,height=500,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
}


function print1() {
	   window.open("sales_print.php?start_date=", "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
}
    
    
    </script>
<script type="text/javascript">
$(document).ready( function() {	 
  $("#tbl_posts").on( 'change','tr .changeStatus', function() {
	  alert('am changeing ');
	  var $row = $(this).closest("tr");
		// var $text = $row.attr("id");
		var trid = $(this).closest('tr').attr('id'); // table row ID 
	   	//alert('row id '+trid);
	    var slicedId = Number(trid.slice(-1));
	    var selectedOptionValue =  $row.find("select").val();
		 alert('selectedOptionValue --> '+selectedOptionValue);
	    $.ajax({
            type:'POST',
            url:'getdata.php',
            dataType: "json",
            data:{option_value:selectedOptionValue},
            success:function(data){
                if(data.status == 'ok'){
                	console.log("User 23223 found..."+data.result.Stocks_Reed);
                	$row.find('input[name="Reed_'+(slicedId-1)+'"]').val(data.result.Stocks_Reed);
	             	  $row.find('input[name="Pick_'+(slicedId-1)+'"]').val(data.result.Stocks_Pick);
	             	 $row.find('input[name="Warp_'+(slicedId-1)+'"]').val(data.result.Stocks_Warp);
	             	$row.find('input[name="Wept_'+(slicedId-1)+'"]').val(data.result.Stocks_Wept);
	             	$row.find('input[name="Width_'+(slicedId-1)+'"]').val(data.result.Stocks_Width);
	             	$row.find('input[name="SellingPrice_'+(slicedId-1)+'"]').val(parseFloat(data.result.Selling_Price).toFixed(2)); 
                    
                }else{
                    $('.user-content').slideUp();
                    console.log("User not found...");
                } 
            }
        });
	   	
  });

  $("#tbl_posts").on( 'change keyup paste','tr .quantity', function() {
	  // alert($("input[name='Quantity']").val());
	  //alert('am keyup event ');
	  // var $row = $(this).closest("tr");
	  // var row = $("#tbl_posts tbody tr").last(); // table row ID 
	  // var oldId = Number(row.attr('id').slice(-1));
	  // alert('row d is '+oldId)	
	  var $row = $(this).closest("tr");
	  var trid = $(this).closest('tr').attr('id'); // table row ID
	 // alert(trid);
	  var oldId = Number($row.attr('id').slice(-1));
	 // alert('row d is '+oldId);
	  var sellingPrice = $row.find('input[name="SellingPrice_'+(oldId-1)+'"]').val();
	 // alert('sp is '+sellingPrice);
	  var qty =$row.find('input[name="Quantity_'+(oldId-1)+'"]').val();
	  // alert(qty);
	$row.find('input[name="Total_'+(oldId-1)+'"]').val(parseFloat(sellingPrice*qty).toFixed(2));

	$(calculateSum);
  });
	

 
});


  </script>

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
						<h2 class="page-title">Edit Sales</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Sales</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
										<?php
            $id = $_GET['id'];
            $ret = "select * from stocks_sales where Stocks_Sales_Id=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('i', $id);
            $stmt->execute(); // ok
            $res = $stmt->get_result();
            // $cnt=1;
            while ($row = $res->fetch_object()) {
                
            ?>
											<div class="col-md-6">
												<div class="form-group">										
						
		
											
												<label class="col-sm-3 control-label">Sales Code </label>
													<div class="col-sm-8">
														<input readonly="readonly" type="text"
															value="<?php echo $row->Stocks_Sales_Code;?>" name="salescode"
															class="form-control" required="required">
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">Sale Date</label>
													<div class="col-sm-8">

														<input type="text" name="salesdate" id="test2"
															value="<?php echo $row->Stocks_Sales_Date;?>" class="form-control"
															required="required">

													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">Bill No</label>
													<div class="col-sm-8">

														<input readonly="readonly" type="text" name="billNo"
															id="billno" value="<?php echo $row->Bill_No;?>"
															class="form-control" required="required">

													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">Customer</label>
													<div class="col-sm-8">
														<select class="form-control" name="customer">
												<?php
$db->query("SELECT * FROM Customer ");

while ($customerRow = $db->fetchNextObject())
	{
?>
												<option value=<?php
												echo $customerRow->Customer_Id; ?>><?php
												echo $customerRow->Customer_Name; ?></option>
												<?php
	} ?>
												</select>
													</div>
												</div>
											</div>

											<div class="form-group">
												<input class="btn btn-primary" type="submit" name="submit"
													value="Add row" onClick='addAnotherRow();'>
												<!-- a class="btn btn-primary pull-right add-record"
													data-added="0"><i class="glyphicon glyphicon-plus" ></i>&nbsp;Add
													Row</a-->
											</div>
											<!-- button type="button" class='delete'>- Delete</button>
											<button type="button" class='addmore'>+ Add More</button-->
											<fieldset class="row2">
												<input type="hidden" name="checkyear" id="checkyear"
													value="">
												<table class="table table-bordered" id="tbl_posts">
													<thead>
														<tr>
															<th bgcolor="#5D7B9D">#</th>
															<th bgcolor="#5D7B9D">Stock Name</th>
															<th bgcolor="#5D7B9D">Reed</th>
															<th bgcolor="#5D7B9D">Pick</th>
															<th bgcolor="#5D7B9D">Warp</th>
															<th bgcolor="#5D7B9D">Wept</th>
															<th bgcolor="#5D7B9D">Width</th>
															<th bgcolor="#5D7B9D">Price / meter</th>
															<th bgcolor="#5D7B9D">Quantity</th>
															<th bgcolor="#5D7B9D">Total</th>
															<th bgcolor="#5D7B9D">Action</th>
														</tr>
													</thead>
													<tbody id="tbl_posts_body">
														
															<!-- td><span class="sn">1</span>.</td-->
															
							<?php
							
							$salesDetailsRet = "select * from stocks_sales_details where Stocks_Sales_Id=?";
							$stmtSales = $mysqli->prepare($salesDetailsRet);
							$stmtSales->bind_param('i', $id);
							$stmtSales->execute(); // ok
							$salesDetailsResult = $stmtSales->get_result();
							$cnt=1;
							$rid=0;
							while ($salesDetailsResultRow = $salesDetailsResult->fetch_object()) {
	
?>				<tr id="rec-1">
															<td><span class="sn"><?php echo $cnt; ?></span>.</td>
															<td><select name="stockcode_<?php echo $rid; ?>" class="changeStatus">
							<?php
$sql = "SELECT * FROM stocks";
$result = mysql_query($sql);

while ($rowdropdown = mysql_fetch_array($result))
	{
?>						
																	<option
																		value='<?php
	echo $rowdropdown['Stocks_Id']; ?>'> <?php
	echo $rowdropdown['Stocks_Name'];
	} ?></option>
															</select></td>
															
																<!-- td><input type="text" required="required" id="stockcode_<?php echo $rid; ?>"
																name="stockcode_<?php echo $rid; ?>" class="changeStatus"
																onkeypress="return numbersonly(event);" /></td-->
																	
															<td><input type="text" required="required" id="Reed_<?php echo $rid; ?>"
																name="Reed_<?php echo $rid; ?>" class="reed"
																onkeypress="return numbersonly(event);" value=<?php echo $salesDetailsResultRow->Reed; ?> /> </td>
															<td><input type="text" required="required" id="Pick_<?php echo $rid; ?>"
																name="Pick_<?php echo $rid; ?>" class="pick"
																onkeypress="return numbersonly(event);" value=<?php echo $salesDetailsResultRow->Pick; ?> /></td>
															<td><input type="text" required="required" id="Warp_<?php echo $rid; ?>"
																name="Warp_<?php echo $rid; ?>" class="warp"
																onkeypress="return numbersonly(event);" value=<?php echo $salesDetailsResultRow->Warp; ?> /></td>
															<td><input type="text" required="required" id="Wept_<?php echo $rid; ?>"
																name="Wept_<?php echo $rid; ?>" class="wept"
																onkeypress="return numbersonly(event);" value=<?php echo $salesDetailsResultRow->Wept; ?> /></td>
															<td><input type="text" required="required" id="Width_<?php echo $rid; ?>"
																name="Width_<?php echo $rid; ?>" class="width"
																onkeypress="return numbersonly(event);"> <?php echo $salesDetailsResultRow->Width; ?> </input></td>
															<td><input type="text" required="required"
																class="sellingPrice" id="SellingPrice_<?php echo $rid; ?>"
																name="SellingPrice_<?php echo $rid; ?>"
																onkeypress="return numbersonly(event);" value=<?php echo $salesDetailsResultRow->Selling_Price; ?>  /></td>

															<td><input type="text" required="required"
																class="quantity" id="Quantity_<?php echo $rid; ?>" name="Quantity_<?php echo $rid; ?>"
																onkeyup="getRows();grand_total();"
																onkeypress="return numbersonly(event)" value=<?php echo $salesDetailsResultRow->Stocks_Quantity; ?>  /></td>
															<td><input name="Total_<?php echo $rid; ?>" type="text" id="Total_<?php echo $rid; ?>"
																class="total" maxlength="200" class="total" value=<?php echo $salesDetailsResultRow->Amount; ?>  /></td>
															<td><a class="btn btn-xs delete-record" data-id="1"><i
																	class="glyphicon glyphicon-trash"></i></a></td>
														</tr>
				<?php $rid++; $cnt++; }?>
													</tbody>
												</table>
											</fieldset>


											<div class="row">
												<div class="col-md-12">

													<div class="col-md-12">
														<div class="form-group">
															<label>Discount As Percentage</label> <input
																id="discountCheck" name="discountPerCheck"
																type="checkbox" onclick="enableDiscountFields(this)">
														</div>

													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Discount %</label>
															<div class="col-sm-8">

																<input type="text" name="discount_per" id="discount_per"
																	value="<?php
echo ""; ?>"
																	onkeypress="return numbersonly(event);"
																	class="form-control" disabled="disabled"
																	onkeyup="discount_amount_calc();">

															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Discount Amount:</label>
															<div class="col-sm-8">
																<input disabled="disabled" type="text"
																	class="form-control" id="discount_amount"
																	name="disc_amount">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Grand Total</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="grandtotal"
																	name="grandtotal" value="<?php echo $row->Stocks_Sales_Amount;?>" />
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Description</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id=""
																	name="description">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Mode</label>
															<div class="col-sm-8">
																<select name="mode" class="form-control">
																	<option value="cash">Cash</option>
																	<option value="cheque">Cheque</option>
																	<option value="other">Other</option>
																</select>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Payment</label>
															<div class="col-sm-8">
																<input type='number' step='0.01' value='0.00'
																	placeholder='0.00'
																	onkeypress="return numbersonly(event);"
																	onkeyup="balance_amount();" class="form-control"
																	id="payment" name="payment" />
																
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Balance</label>
															<div class="col-sm-8">
																<input type="number" step='0.01' value='0.00'
																	placeholder='0.00'
																	onkeypress="return numbersonly(event);"
																	onkeyup=" balance_amount(); " class="form-control"
																	id="balance" name="balance">
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Payable Amount</label>
															<div class="col-sm-8">
																<input type="number" step='0.01' value='0.00'
																	placeholder='0.00'
																	onkeypress="return numbersonly(event);"
																	onkeyup="payable();" class="form-control"
																	id="payableamount" name="payableamount">
															</div>
														</div>
													</div>


													<div class="col-md-9">
														<div class="form-group">
															<label class="col-sm-2 control-label">Due Date</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="duedate"
																	id="test2" value="<?php
echo date('d-m-Y'); ?>">
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Tax</label>
															<div class="col-sm-8">
																<input class="form-control" type="text" name="tax"
																	onkeypress="return numbersonly(event);">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-3 control-label">Tax Description</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="tax_dis">
															</div>
														</div>
													</div>
												</div>

											</div>

											<div class="col-sm-8 col-sm-offset-2">
												<input class="btn btn-primary" type="submit"
													name="submitButton" value="Update" /> <input
													class="btn btn-primary" type="submit" name="PrintButton"
													value="Print" onClick='print1();'>
												<!--button class="btn btn-primary" type="button" name="submit"
													value="Save" onClick='getrows();'>Save </button>
													
													<button class="btn btn-primary" type="button"
													name="Print" value="Print" onClick='print1();'>Print</button-->
											</div>
											<div class="col-sm-8 col-sm-offset-2"></div>
											<?php } ?>
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