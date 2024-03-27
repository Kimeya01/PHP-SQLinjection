<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>หน้าผู้ดูแลระบบ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        a {
            color: #4caf50;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px; 
            display: inline-block; 
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; 
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 75px;
            max-height: 75px;
            text-align: center; 
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>
        <?php
            echo '<a href="javascript:window.history.back()">🔙ย้อนกลับ</a>'; 
            
        ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
        <input type="hidden" name="ID" value="<?php echo isset($_GET['ID']) ? $_GET['ID'] : ''; ?>">
        <input type="text" name="search" placeholder="ค้นหาตาม Username" value="<?php echo isset($strKeyword) ? $strKeyword : ''; ?>">
        <input type="submit" value="ค้นหา">
    </form>
   

    <?php
   
    $conn = mysqli_connect("localhost", "root", "", "workdb");
    $conn->query("SET NAMES UTF8");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    session_start(); 

   // $level = isset($_GET['position']) ? $_GET['position'] : ''; 


    $level = isset($_GET['level']) ? $_GET['level'] : 'a'; //ส่งไปสำหรับเลื่อนยศได้
    


    if (isset($_GET['search'])) {
        $strKeyword = $_GET['search'];
    } else {
        $strKeyword = null;
    }
       

    if ($strKeyword == null) {
        $sql = "SELECT * FROM work";
        
    } else {
        $sql = "SELECT * FROM work WHERE username LIKE '%" . $strKeyword . "%'";
    }

    $rs = $conn->query($sql);

    echo "<table border='1' cellpadding='10' width=80%>";
    echo "<tr> 
        <th>ID</th> 
        <th>First Name</th> 
        <th>Last Name</th> 
        <th>Username</th> 
        <th>Password</th> 
        <th>UserLevel</th>
        <th>Image</th>
        <th></th> 
        </tr>";
    while ($row = $rs->fetch_assoc()) {
        $ID = $row['ID'];
        if ($row['position'] == "a") {
            $role = '🟡Admin';
        }
        if ($row['position'] == "m") {
            $role = '🟢Normal User';
        }

        echo "<tr>";
        echo '<td>' . $ID . '</td>';
        echo '<td>' . $row['fristname'] . '</td>';
        echo '<td>' . $row['lastname'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['password'] . '</td>';
        echo '<td>' . $role . '</td>';
        echo '<td>' . '<img src="' . $row['imagePath'] . '" width="50">' . '</td>';

        echo '<td><a href="viewuserid.php?ID=' . $ID . '&level=' . $level . '">📃View user</a> ';
        echo '<a href="editForm.php?ID=' . $ID . '&level=' . $level . '">🖋️Edit</a> ';
        echo '<a href="delete.php?ID=' . $ID . '&level=' . $level . '">⛔Delete</a></td>';
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($conn);
    ?>
    
    
</body>
</html>
