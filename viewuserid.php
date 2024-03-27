<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>หน้าผู้ใช้ระบบ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        form {
            background-color: #fff;
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            color: #4caf50;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }.borderedImageContainer {
            width: 125px;
            height: 125px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            margin: 0 auto 20px;
        }
        .borderedImageContainer img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
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
        $level = $_GET['level'];
        
        $sql="SELECT * FROM work Where ID='".$ID."'";
        
        $result = mysqli_query($conn,$sql);
        $data = mysqli_fetch_array($result);

        $_SESSION["Userlevel"] = $data["position"];
        $_SESSION["UserID"] = $data["ID"];
        $_SESSION["Username"] = $data["username"];
        $_SESSION["Userpassword"] = $data["password"];
        $_SESSION["UserFirstname"] = $data["fristname"];
        $_SESSION["UserLastname"] = $data["lastname"];
        $_SESSION["UserImage"] = $data["imagePath"];
            if($_SESSION["Userlevel"]=="a"){ $role = '🟡Admin';}
            if($_SESSION["Userlevel"]=="m"){ $role = '🟢Normal User';}
        echo $level;//test
        echo '<form>';
        echo '<h2>ข้อมูลผู้ใช้ </h2><br /><br />';
        if ($_SESSION["UserImage"] != null) {
            echo '<div class="borderedImageContainer">';
            echo '<img src="' . $_SESSION["UserImage"] . '" alt="ผิดพลาดทางเทคนิค">';
            echo '</div>';
        } else {
            echo '<p class="borderedImageContainer">ไม่มีรูปโปรไฟล์</p>';
        }
        echo ' : ' . $_SESSION["UserImage"] . '<br><br>';
        echo '<b>(ดึงมาจาก Database)</b><br /><br />';
        echo '<b>User ID &nbsp;&nbsp; : </b> &nbsp;&nbsp;',($_SESSION['UserID']),'<br /><br />';
        echo '<b>User level &nbsp;&nbsp; : </b> &nbsp;&nbsp;',$role,'<br /><br />';
        echo '<b>Username &nbsp;&nbsp; : </b> &nbsp;&nbsp;',($_SESSION['Username']),'<br /><br />';
        echo '<b>Password &nbsp;&nbsp; : </b> &nbsp;&nbsp;',($_SESSION['Userpassword']),'<br /><br />';
        echo '<b>Firstname &nbsp;&nbsp; : </b> &nbsp;&nbsp;' ,($_SESSION['UserFirstname']),'<br /><br />';
        echo '<b>Lastname &nbsp;&nbsp; : </b> &nbsp;&nbsp;',($_SESSION['UserLastname']),'<br /><br /><br />';
        echo '<a href="editForm.php?ID='.$ID.'&level='.$level.'">📜🖋️แก้ไขข้อมูลผู้ใช้ </a> <br /><br />';
        echo '<a href="javascript:window.history.back()">🔙กลับคืน</a>';
        echo '</form>';
    


      mysqli_close($conn);
    ?>
</body>
</html>