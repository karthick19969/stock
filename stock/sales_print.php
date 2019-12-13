<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
include ('includes/config.php');
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); 
$role=  $_SESSION['role'];
echo "<script>alert($role );</script>";

if ($role != 1) { // if session variable "username" does not exist.
   header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
} else {
    
    error_reporting(E_ALL ^ E_NOTICE);
    
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sale Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<style type="text/css" media="print">
.hide {
	display: none
}
</style>
<script type="text/javascript">
function printpage() {
document.getElementById('printButton').style.visibility="hidden";
window.print();
document.getElementById('printButton').style.visibility="visible";  
}
</script>
<body>
<?php 
$customerId=0;
    $max = $db->maxOfAll("Stocks_Sales_Id", "stocks_sales");    
    $result1 = $db->query("SELECT * FROM stocks_sales where  Stocks_Sales_Id = '$max' ");
    while ($line1 = mysql_fetch_array($result1)) {
        $sales_Code = $line1['Stocks_Sales_Code'];
        $transaction_id = $line1['Stocks_Transactions_Id'];
        
        
        
    }
    // $max=$max+1;
    // $autoid="SD".$max."";
    ?>
         
<input name="print" type="button" value="Print" id="printButton"
		onClick="printpage()">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<div align="left">
                      <?php
    
$line4 = $db->queryUniqueObject("SELECT * FROM Company ");
    ?>
                  <strong><?php echo $line4->Company_Name; ?></strong><br />
                  <?php echo $line4->Company_Address; ?><br /> Phone<strong>:<?php echo $line4->Company_Contact_Nos; ?></strong>
					<br />
                  <?php ?>
              </div>

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

					<tr>
						<td height="30" align="center"><strong>Sale Report</strong></td>
					</tr>

				</table>
			</td>
		
		
		<tr>
			<td width="45"><hr></td>
		</tr>
		<tr>
			<td height="20" align="left">
          			  <?php
          			  $result = $db->query("SELECT * FROM stocks_transactions where  Stocks_Sales_Code = '$sales_Code' and Stocks_Transactions_Type='Sell'");
    $line = mysql_fetch_array($result);
    $line['date'];
    ?>
<table>
<tr>
					<td align="left"> Date <?php echo $line['Transaction_Date'];?></td>
					<td>&nbsp;</td>
					<?php  
					 //echo $line['Stocks_Customer'];
					$resultCustomer = $db->query("SELECT * FROM customer where Customer_Id = ".$line['Stocks_Customer']);
					$lineCustomer = mysql_fetch_array($resultCustomer);
					?>
					<td align="center"><strong>Customer: </strong><?php echo $lineCustomer['Customer_Name'] ?></td>
				
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td> <strong>SaleID: </strong><?php echo $max; ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"> <strong> BillNumber </strong><?php echo $line['Receipt_Bill_Number'] ?></td>
					</tr>
				</table> <!--<table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="45"><strong>From</strong></td>
                <td width="393">&nbsp;<?php  //echo $_GET['from_purchase_date']; ?></td>
                <td width="41"><strong>To</strong></td>
                <td width="116">&nbsp;<?php // echo $_GET['to_purchase_date']; ?></td>
              </tr>
          </table>-->
			</td>
		</tr>
		<tr>
			<td width="45"><hr></td>
		</tr>
		<tr>
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>

						<td><strong>S.No </strong></td>
						<td><strong>Product</strong></td>
						<td><strong>Quantity</strong></td>
						<td><strong>Unit Price</strong></td>
						<td><strong>Sub Total</strong></td>

					</tr>
					<tr>
						
					</tr>
			  <?php
			  
    $result = $db->query("SELECT * FROM stocks_sales_details where Stocks_Sales_Id = $max ");
    $s = 1;
    while ($line = mysql_fetch_array($result)) {
        
        ?>
			
				<tr>


						<td><?php echo $s ?></td>

						<td><?php $stockName=$line['Stock_Name'];
						$stockNameResult = $db->query("SELECT * FROM stocks where Stocks_Id= $stockName");
						while ($stockNameR = mysql_fetch_array($stockNameResult)) {
						    echo $stockNameR['Stocks_Name'];
						}
						?></td>
						<td><?php echo $line['Stocks_Quantity'] ?></td>
						<td><?php echo $line['Selling_Price'] ?></td>
						<td><?php echo $line['Amount'] ?></td>


					</tr>
			  
                
                
                
                

<?php
        $s = $s + 1;
    }
    ?>
              
              
          </table></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	</td>

	</tr>

	</table>
	<table>
		<tr>
			<td width="150"><strong>Total</strong></td>
			<td width="150">&nbsp;<?php echo  $age = $db->queryUniqueValue("SELECT Total FROM stocks_Transactions where Stocks_Transactions_Id = $transaction_id ");?></td>
		</tr>
		<tr>
			<td width="150"><strong>Discount </strong></td>
			<td width="150">&nbsp;<?php echo  $age = $db->queryUniqueValue("SELECT sum(Discount_amount) FROM stocks_sales where Stocks_Transactions_Id = $transaction_id ");?></td>
		</tr>
		<tr>
			<td><strong>Paid Amount</strong></td>
			<td>&nbsp;<?php echo  $age = $db->queryUniqueValue("SELECT Payment FROM stocks_Transactions where Stocks_Transactions_Id = $transaction_id ");?></td>
		</tr>

		<tr>
			<td width="150"><strong>Pending Payment </strong></td>
			<td width="150">&nbsp;<?php echo  $age = $db->queryUniqueValue("SELECT sum(Balance) FROM stocks_sales where Stocks_Transactions_Id = $transaction_id ");?></td>
		</tr>
	</table>
	</td>
	</tr>
	<tr>

		<td width="45"><hr></td>
	</tr>
	</table>
	<footer>

	<p align="center">
		<strong>ambikamills@gmail.com</strong> </br>
		
	</p>
	</footer>
</body>
</html>
<?php
}
?>