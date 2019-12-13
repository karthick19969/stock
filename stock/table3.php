<?php
session_start();
if(isset($_POST) && count($_POST)){
    $action  = $_POST['action'];
    $fname   = $_POST['fname'];
    $lname   = $_POST['lname'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $item_id = $_POST['item_id'];
    
    if($action == "save"){
        // Add code to save data into mysql
        echo json_encode(
            array(
                "success" => "1",
                "row_id"  => time(),
                "fname"   => htmlentities($fname),
                "lname"   => htmlentities($lname),
                "email"   => htmlentities($email),
                "phone"   => htmlentities($phone),
            )
            );
    }
    else if($action == "delete"){
        // Add code to remove record from database
        echo json_encode(
            array(
                "success" => "1",
                "item_id"  => $item_id
            )
            );
    }
}else{
    echo json_encode(
        array(
            "success" => "0",
            "item_id"  => "No POST data set"
                )
        );
}
?>

<html>
<head>
<link rel="stylesheet" href="css/table.css">
<script type="text/javascript" src="js/table.js"/>
</head>
<body>
	<input id="add_new" type="button" value="Add Record" />
	<table class="table-list" border="0" width="70%" cellspacing="0"
		cellpadding="0">
		<tbody>
			<tr>
				<th width="20%">First Name</th>
				<th width="20%">Last Name</th>
				<th width="40%">Email</th>
				<th width="20%">Phone Number</th>
				<th width="20%">Delete</th>
			</tr>
			<tr>
				<td>jquery</td>
				<td>ajax</td>
				<td>jquery@ajax.com</td>
				<td>242525</td>
				<td><a id="1" class="del" href="#">Delete</a></td>
			</tr>
			<tr>
				<td>php</td>
				<td>mysql</td>
				<td>php@mysql.com</td>
				<td>242525</td>
				<td><a id="2" class="del" href="#">Delete</a></td>
			</tr>
			<tr>
				<td>html</td>
				<td>css</td>
				<td>html@css.com</td>
				<td>242525</td>
				<td><a id="3" class="del" href="#">Delete</a></td>
			</tr>
			<tr>
				<td>wordpress</td>
				<td>plugins</td>
				<td>wordpress@plugins.com</td>
				<td>242525</td>
				<td><a id="4" class="del" href="#">Delete</a></td>
			</tr>
		</tbody>
	</table>
</body>

</html>