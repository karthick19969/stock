<?php
session_start();
require_once ("includes/dbconnection.php");
include_once ("includes/stockdb.php");
include ('includes/config.php');
$db = new DB(DB_NAME, DB_SERVER, DB_USER, DB_PASS); //
$myusername=$_POST["email"];
$mypassword=$_POST["password"];
$tbl_name = "users"; // Table name
$searchuser = "SELECT * FROM $tbl_name WHERE User_Email='$myusername' and Password='$mypassword'";
$result= mysql_query($searchuser);
echo "<script>alert('id is $result');</script>";
$id=$_POST["email"];
/* $ret = "select * from users where User_Email=?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $id);
$stmt->execute(); // ok
$result = $stmt->get_result();
$count = mysql_num_rows($result); */
$count = mysql_num_rows($result); 
if ($result) {
    // Register $myusername, $mypassword and redirect to file "dashboard.php"
    $row = mysql_fetch_row($result);
    
    echo $row[0]; // 42
    echo $row[1]; // the email value
    echo "<script>alert('ut is  $row[0] ');</script>";
    $_SESSION['userid'] = $row[0];
    $_SESSION['userfirstname'] = $row[1];
    $_SESSION['useremail'] = $row[6];
    $_SESSION['role'] = $row[9];
    echo $row[1]; // the email value
    $role=  $_SESSION['role'];
    echo "<script>alert($role );</script>";
    
    
    $loginTime = date('d-m-Y H:i:s');
    $selected_date = strtotime($loginTime);
    $mysqldate = date('Y-m-d H:i:s', $selected_date);
    $due = $mysqldate;
    // Get the client ip address
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    /* echo 'Your IP address (using $_SERVER[\'REMOTE_ADDR\']) is ' . $ipaddress . '<br />';
    echo 'Your IP address (using $_SERVER[\'REMOTE_ADDR\']) is ' . $ipaddress . '<br />';
    echo 'Your IP address (using get_client_ip_env function) is ' . $db->get_client_ip_env() . '<br />';
    echo 'Your IP address (using get_client_ip_server function) is ' . $db->get_client_ip_server() . '<br />';
     */
    $query = "insert into UserAudit(User_Id,User_First_Name,Login_Time,User_IP_Address) values($row[0],'$row[1]','$due','$ipaddress')";
    $msg = mysql_query($query);
    
    
    header("location:dashboard.php");
}else {
    header("location:index.php");
}
?>
<html>

<body>

 Hello <?php echo $_POST["email"]; ?>!<br>
 Your mail is <?php echo $_POST["password"]; ?>.
<?php echo $count; ?>
 </body>
</html>
