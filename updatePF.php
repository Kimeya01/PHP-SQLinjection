<html>
<head>
<title></title>
</head>
<body>
<?php
	
	$conn = mysqli_connect("localhost", "root", "", "workdb");
      $conn->query("SET NAMES UTF8");
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    session_start(); 
	$username = $_GET["newUsername"];
	$password = $_GET["newUserpassword"];
	$fristname = $_GET["newUserfirstname"];
	$lastname = $_GET["newUserlastname"];
	$position = $_GET["newUserlevel"];
	$ID = $_GET["ID"];
    
	$sqlup = "UPDATE work SET 
			username = '".$username."' ,
			password = '".$password."' ,
			fristname = '".$fristname."' ,
			lastname = '".$lastname."' ,
			position = '".$position."' 
			WHERE ID = '".$ID."' ";

    //admin' UNION UPDATE work SET password = '123',fristname = 'injection' ,lastname = 'injection' WHERE ID = '7' limit 1,1 -- -
	$update = mysqli_multi_query($conn,$sqlup);

	if($update) {
	 //echo "Record update successfully";
     echo "<script>";
     echo "alert(\" [บันทึกข้อมูลเรียบร้อย]\");"; 
     echo "window.history.back()";
     echo "</script>";
	}
    echo mysqli_error($conn);
	mysqli_close($conn);
?>
</body>
</html>