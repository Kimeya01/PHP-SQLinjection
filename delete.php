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
    $ID = $_GET['ID'];
    $sql = "DELETE FROM work Where ID='".$ID."'";
  
	$query = mysqli_query($conn,$sql);

	if($query) {
	 //echo "Record update successfully";
     echo "<script>";
     echo "alert(\" [ลบผู้ใช้เรียบร้อย]\");"; 
     echo "window.history.back()";
     echo "</script>";
	}
    echo mysqli_error($conn);
	mysqli_close($conn);
?>
</body>
</html>