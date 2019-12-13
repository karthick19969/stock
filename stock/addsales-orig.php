<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //

if (isset($_POST['submit'])) {
    echo "<script>alert('................... Stock insertion started ...........');</script>";
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
    if ($balance > 0) {}
    $max_trans_id = $db->maxOfAll("Stocks_Transactions_Id", "stocks_transactions");
    echo "<script>console.log('Stock insertion ................$max_trans_id');</script>";
    $query = "insert into Stocks_Sales(Stocks_Sales_Code,Stocks_Transactions_Id,Stocks_Sales_Date,Stocks_Sales_Amount,User,Payment,Balance,Bill_No) values('$stockSalesCode',$max_trans_id,'$today','$grandTotal','$user','$payment','$balance','$billNo')";
    $msg = mysqli_query($con, $query);
    $c = count($_POST['chk']);
    echo "<script>alert(' row count is ....$c');</script>";
    if ($msg) {
        for ($i = 0; $i < $c; $i ++) {
            echo "<script>alert(' row count is ....$i');</script>";
            $itemName = $_POST['stockcode'][$i];
            $reed = $_POST['Reed'][$i];
            $pick = $_POST['Pick'][$i];
            $warp = $_POST['Warp'][$i];
            $wept = $_POST['Wept'][$i];
            $width = $_POST['Width'][$i];
            echo "<script>alert('------------------- Stock width -----.$width');</script>";
            $stockQuantity = $_POST['Quantity'][$i];
            $sellingPrice = $_POST['SellingPrice'][$i];
            $totalPrice = $_POST['total'][$i];
            echo "<script>alert('------------------- Stock checking is available -------------------');</script>";
            $cntAvailableQuantity = $db->queryUniqueValue("SELECT count(*) FROM stocks_avail WHERE Stocks_Code='$itemName'");
            if ($cntAvailableQuantity > 0) {
                $availableQuantity = $db->queryUniqueValue("SELECT Quantity FROM stocks_avail WHERE Stocks_Code='$itemName'");
                $quantity = $availableQuantity - $stockQuantity;
                if ($quantity > 0) {
                    $db->execute("UPDATE stocks_avail SET Quantity=$quantity WHERE Stocks_Code='$itemName'");
                } else {
                    echo "Sorry available quantity not available.Please raise purchase stock for updation ......";
                }
            } else {
                echo "<script>alert('Stock not available ..............................');</script>";
            }
            $salesStockId = $db->maxOfAll("Stocks_Sales_Id", "stocks_sales");
            // $salesStockId = $db->queryUniqueValue("SELECT Stocks_Sales_Id FROM stocks_sales WHERE Stocks_Sales_Code='$stockSalesCode'");
            echo "<script>console.log('Stock sales id ..............................$salesStockId');</script>";
            $queryDetails = "insert into Stocks_Sales_Details(Stocks_Sales_Id,Reed,Pick,Warp,Wept,Stocks_Quantity,Selling_Price,Amount) values($salesStockId,'$reed','$pick','$warp','$wept','$stockQuantity',$sellingPrice,$totalPrice)";
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
<title>Add Stock</title>
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
<script type="text/javascript">
$(document).ready( function() {

	 $(function(){
		 //all onload actions you want
		 var selectedCountry = $("#tbl_posts tr .changeStatus option:selected").val();
		 alert(selectedCountry);
		 var $row = $("#tbl_posts tr .changeStatus option:selected").closest("tr");  
	 		var $text = $row.attr("id");
	 		console.log('row id is '+$text);    
	        $.ajax({
	            type:'POST',
	            url:'getdata.php',
	            dataType: "json",
	            data:{option_value:selectedCountry},
	            success:function(data){
	                if(data.status == 'ok'){
	                	console.log("User 23223 found..."+data.result.Stocks_Reed);
	             	   $row.find('input[name="Reed"]').val(data.result.Stocks_Reed);
	             	  $row.find('input[name="Pick"]').val(data.result.Stocks_Pick);
	             	 $row.find('input[name="Warp"]').val(data.result.Stocks_Warp);
	             	$row.find('input[name="Wept"]').val(data.result.Stocks_Wept);
	             	$row.find('input[name="Width"]').val(data.result.Stocks_Width);
	             	$row.find('input[name="SellingPrice"]').val(parseFloat(data.result.Selling_Price));	                    
	                }else{
	                    $('.user-content').slideUp();
	                    console.log("User not found...");
	                } 
	            }
	        });
	 });
	 
  $("#tbl_posts").on( 'change','tr .changeStatus', function() {
	  alert('am changeing ');
	  var $row = $(this).closest("tr");  
		var $text = $row.attr("id");

		var trid = $(this).closest('tr').attr('id'); // table row ID 
	   	alert(trid);
	   	var selectedCountry = $("#tbl_posts tr .changeStatus option:selected").val();
		 alert(selectedCountry);
	    $.ajax({
            type:'POST',
            url:'getdata.php',
            dataType: "json",
            data:{option_value:selectedCountry},
            success:function(data){
                if(data.status == 'ok'){
                	console.log("User 23223 found..."+data.result.Stocks_Reed);
             	   $row.find('input[name="Reed"]').val(data.result.Stocks_Reed);
             	  $row.find('input[name="Pick"]').val(data.result.Stocks_Pick);
             	 $row.find('input[name="Warp"]').val(data.result.Stocks_Warp);
             	$row.find('input[name="Wept"]').val(data.result.Stocks_Wept);
             	$row.find('input[name="Width"]').val(data.result.Stocks_Width);
             	$row.find('input[name="SellingPrice"]').val(parseFloat(data.result.Selling_Price).toFixed(2));
                
                    
                }else{
                    $('.user-content').slideUp();
                    console.log("User not found...");
                } 
            }
        });
	   	
  });

  $("#tbl_posts").on( 'change keyup paste','tr .quantity', function() {
		//alert($("input[name='Quantity']").val());

		 var $row = $(this).closest("tr"); 
		 //var trid = $(this).closest('tr').attr('id'); // table row ID 
		   //	alert(trid); 
		 var sellingPrice = $row.find('input[name="SellingPrice"]').val();
		/// alert('sp is '+sellingPrice);
		var qty =$row.find("input[name='Quantity']").val();
		 //alert(qty);
		 $row.find('input[name="total"]').val(parseFloat(sellingPrice*qty).toFixed(2));


		 //var rowCount = $("#tbl_posts tr").not("thead tr").length.length;
		 //var texto = $('table tr:nth-child(1) td:nth-child(2)').text()
		 
	});

  $(document).on('blur',  '.quantity',function () {
	  var maxTotal=0;
	  $('#tbl_posts #tbl_posts_body tr').each(function() {
	  var cells =  $(this).find("td");
      for (var i = 0; i < cells.length; i++) {
          //data.push(cells[i].innerHTML);
          if(i==9){
        	  maxTotal += parseFloat(cells[i].children[0].value) || 0.00;
          alert("i="+i+",value ="+cells[i].children[0].value);
          }
          
      }
      alert('maxTotal is'+maxTotal);

      document.getElementById('grandtotal').value = parseFloat(maxTotal).toFixed(2);
	  });
      
  });
        //  alert('blur working ');
        //  var maxTotal=0;
 		// var table = $("#tbl_posts #tbl_posts_body");

 		//var output = '';
 		//$('#tbl_posts #tbl_posts_body tr td:nth-child(4)').each(function() {
 		//    output += $(this).html();
 		//    alert('o/p --> '+output);
 		//});


 		//$('#tbl_posts tr').each(function() {
  	       /*var columns = $(this).find('td');
  	      columns.each(function() {
  		       var box = $(this).text();
  		       alert("rr   "+$(this).val());
  		       
  		});*/

  	//	var tdscol = $(this).find('td');
  	//	 alert("Your data is tdscol.length : " +tdscol.length);
  	///	for (var i = 0; i < tdscol.length; i++) {
      //     	var td = tdscol[i];
           //	alert(td.innerText);
           // alert("Your data is: " +td);
     //   }
  	    /* var tableData = $(this).children("td").map(function() {
  	        return $(this).text();
  	    }).get(); */

  	    //alert("Your data is: " + $.trim(tableData[0]) + " , " + $.trim(tableData[1]) + " , " + $.trim(tableData[2]));
 	//	});
  		 
 		    /* table.find('tr').each(function (i) {
 		        var $tds = $(this).find('td'),
 		            productId = $tds.eq(0).text(),
 		            product = $tds.eq(2).text(),
 		            Quantity = $tds.eq(8).text(),
 		           total = $tds.eq(9).text();
 		        // do something with productId, product, Quantity
 		        alert('Row ' + (i + 1) + ':\nproductId: ' + productId
 		              + '\n product: ' + product
 		             + '\nQuantity: ' + Quantity);
 		    }); */
  //});
	  
});
  </script>

<script type="text/javascript">


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
function total_amount() {
	

    
   var disAmt = document.getElementById('discount_amount').value;
   if(disAmt===""){
    document.getElementById('total').value = parseFloat(document.getElementById('price').value * document.getElementById('qty').value);
    //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);
   }else{
	  var total = parseFloat(document.getElementById('price').value * document.getElementById('qty').value);
	  var discountTotal = total - disAmt;
	  document.getElementById('total').value = parseFloat(discountTotal);
   }
}


	
function grand_total() {
   // console.log("grandtotal --");
    if (document.getElementById('total').value === "") {
        console.log("value is ." + document.getElementById('total').value);
    } else {
        document.getElementById('grandtotal').value = parseFloat(document.getElementById('total').value).toFixed(2);
        document.getElementById('payableamount').value = parseFloat(document.getElementById('total').value);
    }
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
	//console.log("------------------------------------------------------------");	 
	 var discountChecked  = document.getElementById("discountCheck");
	 console.log("discountChecked.checked is "+discountChecked.checked);
	  if(discountChecked.checked){
		  //console.log("am here ........................");
		  var txtDiscountPer = document.getElementById("discount_per");		  
		  var per=  document.getElementById('discount_per').value;
		  //console.log("am here 22222........................"+per);
		  if (per === "") {
		  }else{
			  //console.log("am here 22222........................");			  
				var total = document.getElementById('total').value;
				console.log("total is "+total);
				if(total > 0){
					var disAmt = total * ( per / 100); 
					if(disAmt > 0 && disAmt <= total){
						document.getElementById('discount_amount').value = disAmt;
					}
				}
		  }
		  total_amount();
	  }
}

function sales_report_pdf_fn() {
    window.open("sales_pdf_report.php?=" + $('').val(),"myNewWinsr", "width=300,height=500,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
}


function print1() {
	   window.open("sales_print.php?start_date=", "myNewWinsr", "width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes");
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
						<h2 class="page-title">Add Sales</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Sales</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
											<div class="col-md-6">
												<div class="form-group">										
						
											<?php
        $max = $db->maxOfAll("Stocks_Sales_Id", "stocks_sales");
        $max = $max + 1;
        $autoid = "SL" . $max . "";
        ?>
											
												<label class="col-sm-3 control-label">Sales Code </label>
													<div class="col-sm-8">
														<input readonly="readonly" type="text"
															value="<?php echo $autoid; ?>" name="salescode"
															class="form-control" required="required">
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">Sale Date</label>
													<div class="col-sm-8">

														<input type="text" name="salesdate" id="test2"
															value="<?php echo date('d-m-Y');?>" class="form-control"
															required="required">

													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-3 control-label">Bill No</label>
													<div class="col-sm-8">

														<input readonly="readonly" type="text" name="billNo"
															id="billno" value="<?php echo $autoid = "BLNO" . $max;?>"
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
            while ($row = $db->fetchNextObject()) {
                ?>
												<option value=<?php echo $row->Customer_Id; ?>><?php echo $row->Customer_Name; ?></option>
												<?php  } ?>
												</select>
													</div>
												</div>
											</div>

											<div class="form-group">
												<a class="btn btn-primary pull-right add-record"
													data-added="0"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add
													Row</a>
											</div>

											<fieldset class="row2">

												<table class="table table-bordered" id="tbl_posts">
													<thead>
														<tr>
															<th>#</th>
															<th>Stock Name</th>
															<th>Reed</th>
															<th>Pick</th>
															<th>Warp</th>
															<th>Wept</th>
															<th>Width</th>
															<th>Price / meter</th>
															<th>Quantity</th>
															<th>Total</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody id="tbl_posts_body">
														<tr id="rec-1">
															<td><input type="checkbox" required="required" name="chk" /></td>
															<!-- td><span class="sn">1</span>.</td-->
															<td><select name="stockcode" class="changeStatus">
							<?php
    
    $sql = "SELECT * FROM stocks";
    $result = mysql_query($sql);
    while ($rowdropdown = mysql_fetch_array($result)) {
        ?>
																	
																	<option
																		value='<?php echo $rowdropdown['Stocks_Id']; ?>'> <?php echo $rowdropdown['Stocks_Name'];}?></option>

															</select></td>
															<td><input type="text" required="required" name="Reed"
																id="Reed" onkeypress="return numbersonly(event);" /></td>
															<td><input type="text" required="required" name="Pick"
																id="Pick" onkeypress="return numbersonly(event);" /></td>
															<td><input type="text" required="required" name="Warp"
																id="Warp" onkeypress="return numbersonly(event);" /></td>
															<td><input type="text" required="required" name="Wept"
																id="Wept" onkeypress="return numbersonly(event);" /></td>
															<td><input type="text" required="required" name="Width"
																id="Width" onkeypress="return numbersonly(event);" /></td>
															<td><input type="text" required="required"
																class="sellingprice" id="price" name="SellingPrice"
																onkeypress="return numbersonly(event);" /></td>
															<td><input type="text" required="required"
																class="quantity" id="qty" name="Quantity"
																onkeyup="total_amount();grand_total();"
																onkeypress="return numbersonly(event)" /></td>
															<td><input name="total" type="text" id="total"
																maxlength="200" class="total" /></td>
															<td><a class="btn btn-xs delete-record" data-id="1"><i
																	class="glyphicon glyphicon-trash"></i></a></td>
														</tr>

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
																	value="<?php echo "";?>"
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
																	name="grandtotal">
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
																<!-- input type="text"
																	onkeypress="return numbersonly(event);"
																	onkeyup="balance_amount();" class="form-control"
																	id="payment" name="payment"-->
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
																	id="test2" value="<?php echo date('d-m-Y');?>">
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

												<input class="btn btn-primary" type="submit" name="submit"
													value="Save"> <input class="btn btn-primary" type="submit"
													name="submit" value="Print" onClick='print1();'>
											</div>
											<div class="col-sm-8 col-sm-offset-2"></div>
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

	<div style="display: none;">
		<table id="sample_table">
			<tr id="">
				<!-- td><span class="sn"></span></td-->
				<td><input type="checkbox" required="required" name="chk[]" /></td>
				<td><select name="stockcode" class="changeStatus">
							<?php
    
    $sql = "SELECT * FROM stocks";
    $result = mysql_query($sql);
    while ($rowdropdown = mysql_fetch_array($result)) {
        ?>
																	
																	<option
							value='<?php echo $rowdropdown['Stocks_Id']; ?>'> <?php echo $rowdropdown['Stocks_Name'];}?></option>

				</select></td>
				<td><input type="text" required="required" name="Reed" id="Reed"
					onkeypress="return numbersonly(event);" /></td>
				<td><input type="text" required="required" name="Pick" id="Pick"
					onkeypress="return numbersonly(event);" /></td>
				<td><input type="text" required="required" name="Warp" id="Warp"
					onkeypress="return numbersonly(event);" /></td>
				<td><input type="text" required="required" name="Wept" id="Wept"
					onkeypress="return numbersonly(event);" /></td>
				<td><input type="text" required="required" name="Width" id="Width"
					onkeypress="return numbersonly(event);" /></td>
				<td><input type="text" required="required" class="sellingprice"
					id="price" name="SellingPrice"
					onkeypress="return numbersonly(event);" /></td>
				<td><input type="text" required="required" class="quantity" id="qty"
					name="Quantity" onkeyup="total_amount();grand_total();"
					onkeypress="return numbersonly(event)" /></td>
				<td><input name="total" type="text" id="total" maxlength="200"
					readonly="readonly" class="total" /></td>
				<td><a class="btn btn-xs delete-record" data-id="0"><i
						class="glyphicon glyphicon-trash"></i></a></td>
			</tr>
		</table>
	</div>
	<!-- div style="display: none;">
		<table id="sample_table">
			<tr id="">
				<td align="center"><input type="checkbox" required="required"
					name="chk" /></td>
				<td><select class="form-control" name="stockcode" id="wgtmsr">
				<!--?php
    $sql = "SELECT * FROM stocks";
    $result = mysql_query($sql);
    while ($rowdropdown = mysql_fetch_array($result)) {
        ?><option value='<!--?php echo $rowdropdown['Stocks_Id']; ?>'> <!--?php echo $rowdropdown['Stocks_Name'];}?></option>
				</select></td>
				<td><input type="text" width="20px;" required="required"
					class="round default-width-input " name="Reed"
					onkeypress="return numbersonly(event);" value=""></td>
				<td width="50"><input type="text" required="required"
					class="round default-width-input " name="Pick"
					onkeypress="return numbersonly(event);" value=""></td>
				<td width="50"><input type="text" required="required"
					class="round default-width-input " name="Warp"
					onkeypress="return numbersonly(event);" value=""></td>
				<td width="50"><input type="text" required="required"
					class="round default-width-input " name="Wept"
					onkeypress="return numbersonly(event);" value=""></td>
				<td width="50"><input type="text" required="required"
					class="round default-width-input " name="Width"
					onkeypress="return numbersonly(event);" value=""></td>
				<td><input type="text" required="required"
					class="round default-width-input " id="price" name="SellingPrice"
					onkeypress="return numbersonly(event);" value=""></td>
				<td><input type="text" required="required"
					class="round default-width-input " id="qty" name="Quantity"
					onkeyup="total_amount();grand_total();"
					onkeypress="return numbersonly(event)"></td>
				<td><input name="total" type="text" id="total" maxlength="200"
					readonly="readonly" class="round default-width-input " /></td>
				<td><a class="btn btn-xs delete-record" data-id="0"><i
						class="glyphicon glyphicon-trash"></i></a></td>
			</tr>
		</table>
	</div-->
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

	
<?php include("includes/footer.php");?>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function(){
    //$('#header').load('../header-ads.html');
    //$('#footer').load('../footer-ads.html');
     jQuery(document).delegate('a.add-record', 'click', function(e) {
     e.preventDefault();    
     var content = jQuery('#sample_table tr'),
     size = jQuery('#tbl_posts >tbody >tr').length + 1,
     element = null,    
     element = content.clone();
     element.attr('id', 'rec-'+size);
     element.find('.delete-record').attr('data-id', size);
     element.appendTo('#tbl_posts_body');
     element.find('.sn').html(size);
   });
    jQuery(document).delegate('a.delete-record', 'click', function(e) {
     e.preventDefault();    
     var didConfirm = confirm("Are you sure You want to delete");
     if (didConfirm == true) {
      var id = jQuery(this).attr('data-id');
      var targetDiv = jQuery(this).attr('targetDiv');
      jQuery('#rec-' + id).remove();
      
    //regnerate index number on table
    $('#tbl_posts_body tr').each(function(index){
		$(this).find('span.sn').html(index+1);
    });
    return true;
  } else {
    return false;
  }
});
  });
</script>