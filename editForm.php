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
        input[type="password"],
        input[type="file"] {
            width: calc(100% - 22px); /* ปรับขนาด input เพื่อให้พอดีกับขอบเขตของ form */
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
        }
        .borderedImageContainer {
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
        .uploadLink {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .uploadLink a {
            color: #4caf50;
            text-decoration: none;
        }
        .uploadLink a:hover {
            text-decoration: underline;
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

        $sqlqe="SELECT * FROM work Where ID='".$ID."'";
        $result = mysqli_query($conn,$sqlqe);
        $data = mysqli_fetch_array($result);

        $_SESSION["Userlevel"] = $data["position"];
        $_SESSION["ID"] = $data["ID"];
        $_SESSION["Username"] = $data["username"];
        $_SESSION["Userpassword"] = $data["password"];
        $_SESSION["UserFirstname"] = $data["fristname"];
        $_SESSION["UserLastname"] = $data["lastname"];
        $_SESSION["UserImage"] = $data["imagePath"];
        
        if($_SESSION["Userlevel"]=="a"){ 
            $role = 'Admin';
        } elseif ($_SESSION["Userlevel"]=="m") { 
            $role = 'Normal User';
        }

        echo '<form action="updatePF.php" method="get" enctype="multipart/form-data">'; 
        echo '<h2>แก้ไขข้อมูลผู้ใช้</h2><br />';
        if ($_SESSION["UserImage"] != null) {
            echo '<div class="borderedImageContainer">';
            echo '<img src="' . $_SESSION["UserImage"] . '" alt="ผิดพลาดทางเทคนิค">';
            echo '</div>';
        } else {
            echo '<p class="borderedImageContainer">ไม่มีรูปโปรไฟล์</p>';
        }
        echo '<p class="uploadLink"><a href="uploadimage.php?ID='.$ID.'">🏞️อัพโหลดรูปภาพใหม่</a></p>';
        echo ' : ' . $_SESSION["UserImage"] . '<br><br>';
        echo '<input type="hidden" name="ID" value="' . $_SESSION['ID'] . '">';

        if ($level == 'a') {
            if($_SESSION["Userlevel"]=='a'){
                echo '<b>User level &nbsp;&nbsp; : </b> &nbsp;&nbsp;';
                echo '<select name="newUserlevel">';
                echo '<option value="a" selected>🟡Admin</option>';
                echo '<option value="m">🟢Normal User</option>';
                echo '</select><br /><br />';
            } elseif ($_SESSION["Userlevel"]=='m') {
                echo '<b>User level &nbsp;&nbsp; : </b> &nbsp;&nbsp;';
                echo '<select name="newUserlevel">';
                echo '<option value="m" selected>🟢Normal User</option>';
                echo '<option value="a">🟡Admin</option>';
                echo '</select><br /><br />';
            }
        } else {
            echo '<b>User level &nbsp;&nbsp; : </b> &nbsp;&nbsp;',$role,'<br /><br />';
            echo '<input type="hidden" name="newUserlevel" value="m"> ';
        }

        echo '<b>Username &nbsp;&nbsp; : </b> &nbsp;&nbsp;<input type="text" name="newUsername" value="' . $_SESSION['Username'] . '" ><br />';
        echo '<b>Password &nbsp;&nbsp; : </b> &nbsp;&nbsp;<input type="text" name="newUserpassword" value="' . $_SESSION['Userpassword'] . '" ><br />';
        echo '<b>Firstname &nbsp;&nbsp; : </b> &nbsp;&nbsp;<input type="text" name="newUserfirstname" value="' . $_SESSION['UserFirstname'] . '" ><br />';
        echo '<b>Lastname &nbsp;&nbsp; : </b> &nbsp;&nbsp;<input type="text" name="newUserlastname" value="' . $_SESSION['UserLastname'] . '" ><br />';
        
        echo '<button type="submit">บันทึก</button><br /><br />';
        echo '<a href="javascript:window.history.back()">ย้อนกลับ</a>';
        echo '</form>';

        mysqli_close($conn);
    ?>
</body>
</html>
