<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ลงทะเบียน</title>
</head>
<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "workdb");
    $conn->query("SET NAMES UTF8");
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $fristname = $_POST['fristname'];
    $lastname = $_POST['lastname'];
    $position = 'm' ;
    $imagePath = 'image/noprofile.jpg' ;

    //INSERT INTO `work`(`username`, `password`, `fristname`, `lastname`, `imagePath`, `position`) VALUES ('test2','pass2','lastname','lastname','noprofile.jpg','a')

    $sql = "INSERT INTO work (username, password, fristname, lastname,imagePath, position)
    VALUES ('".$username."', '".$password."', '".$fristname."', '".$lastname."','".$imagePath."', '".$position."')";

    //$sql="SELECT * FROM work Where username='".$username."' and password='".$password."' ";
    
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>ลงทะเบียนสำเร็จ</p><br><br>";
    } else {
        echo "<p style='color: red;'>ลงทะเบียนไม่สำเร็จ ชื่อผู้ใช้ : $username ซ้ำกับผู้ใช้ในระบบ</p><br><br>";
    }
        mysqli_close($conn);

        echo '<a href="login.html">ไปยังหน้าเข้าสู่ระบบ</a></td>';
    ?>
</body>

</html>