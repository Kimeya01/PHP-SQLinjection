<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload Profile Image</title>
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
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        input[type="submit"] {
            margin-top: 15px;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #4caf50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Upload Profile Image</h2>
    
    <form action="uploading.php" method="post" enctype="multipart/form-data">
        <label>Choose Profile Image:</label>
        <?php 
        $ID = $_GET['ID'];
        session_start(); 
        $conn = mysqli_connect("localhost", "root", "", "workdb");
        $conn->query("SET NAMES UTF8");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql="SELECT * FROM work WHERE ID ='".$ID."'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);  
        $username = $row["username"];
        echo '<br><br>';  
        echo '<br>Your ID: ',$row["ID"];
        echo '<br>User: ',$row["username"];
        echo '<br>Name: ',$row["fristname"],' ',$row["lastname"];
        echo '<br><br>';  
    ?>
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <br>
        <input type="file" name="image" required>
        <br><br>
        <input type="submit" value="Upload Image" name="submit">
        <a href="javascript:window.history.back()">Back</a>
    </form>
</body>
</html>
