<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
include ('includes/config.php');
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //
$option_value = $_POST['option_value'];
//echo $option_value;
$data = array();
$sql="SELECT * FROM stocks_details where Stocks_Id=".$option_value;
//echo $sql;
$result = mysql_query($sql);
//$row = mysql_fetch_array($result);
$rows = mysql_num_rows($result);
//echo "There are " . $rows . " rows in my table.";

//$total = $row[0];
//echo "Total rows: " . $total;
$userData = array();
$userData = mysql_fetch_array($result);
while($row = mysql_fetch_array($result))
{
    //$userData[] = $row;
}

if(empty($userData)){
    $data['status'] = 'err';
    $data['result'] = '';
}else{
    $data['status'] = 'ok';
    $data['result'] = $userData;
}
/*
$query = $db->query($sql);
echo $query->num_rows;
if($query->num_rows > 0){
    $userData = $query->fetch_assoc();
    $data['status'] = 'ok';
    $data['result'] = $userData;
}else{
    $data['status'] = 'err';
    $data['result'] = '';
}
*/
//returns data as JSON format
echo json_encode($data);
?>