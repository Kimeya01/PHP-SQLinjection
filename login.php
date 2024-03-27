<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    
</head>
<body>
    <?php
      $conn = mysqli_connect("localhost", "root", "", "workdb");
      $conn->query("SET NAMES UTF8");
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
      session_start(); 
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql="SELECT * FROM work Where username='".$username."' and password='".$password."' ";
      $result = mysqli_query($conn,$sql);

      if ($row = mysqli_fetch_array($result)) {
          
          $_SESSION["Userlevel"] = $row["position"];

            if($_SESSION["Userlevel"]=="a"){ 
              Header("Location: adminpage.php?username=$username&password=$password");
            }

            if ($_SESSION["Userlevel"]=="m"){  
              Header("Location: userpage.php?username=$username&password=$password");
            }

        }else{
            echo "<script>";
            echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
            echo "window.history.back()";
            echo "</script>";
        }

      mysqli_close($conn);
    ?>
    

</body>

</html>