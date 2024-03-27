<?php 
      $conn = mysqli_connect("localhost", "root", "", "workdb");
      $conn->query("SET NAMES UTF8");
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
      session_start(); 
      $sql="SELECT * FROM work Where username='".$username."' ";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);           
      //$row["position"];
?>