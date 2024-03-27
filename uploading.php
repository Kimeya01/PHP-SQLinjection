<?php
$username = $_POST['username']; 

if(isset($_POST["submit"])) { // ตรวจสอบว่ามีการส่งค่า submit มาหรือไม่
    if(!empty($_FILES["image"]["tmp_name"])) {
        
        $image_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); // รับนามสกุลของไฟล์ภาพ
        $image_name = $username . '.' . $image_extension;
        // กำหนดชื่อไฟล์ใหม่โดยใช้ $username และนามสกุลของไฟล์
        $target_file = "image/" . $image_name; // กำหนดตำแหน่งของไฟล์เป้าหมาย
        $uploadOk = 1; // ตั้งค่าตัวแปรสำหรับตรวจสอบการอัปโหลด
        echo '<a href="javascript:window.history.back()">ย้อนกลับ</a>';

        // ตรวจสอบว่าไฟล์เป็นภาพจริงหรือไม่
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . "."; 
            $uploadOk = 1;
        } else {
            echo "File is not an image."; // แสดงข้อความเมื่อไฟล์ไม่ใช่ภาพ
          // $uploadOk = 0;
        }

        // ตรวจสอบขนาดของไฟล์
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large."; 
            $uploadOk = 0;
        }

        // อนุญาตให้ใช้งานไฟล์ภาพบางชนิด
        $allowed_formats = array("jpg", "png", "jpeg", "gif");
        if(!in_array($image_extension, $allowed_formats)) {
            echo "only JPG, JPEG, PNG & GIF files are allowed."; // แสดงข้อความเมื่อนามสกุลของไฟล์ไม่ถูกต้อง
           // $uploadOk = 0;
        }

        // ตรวจสอบว่ามีข้อผิดพลาดในการอัปโหลดไฟล์หรือไม่
        if ($uploadOk == 0) {
            echo "มีข้อผิดพลาดในการอัปโหลด"; 
        } else {
            // ลบไฟล์เก่าที่ชื่อซ้ำ
            if(file_exists($target_file)) {
                unlink($target_file);
            }
            // อัปโหลดไฟล์
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                //echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded."; // แสดงข้อความเมื่ออัปโหลดไฟล์สำเร็จ
                $imagePath = $target_file; // กำหนดที่อยู่ของไฟล์ภาพที่อัปโหลดแล้ว

                // แสดงรูปภาพที่อัปโหลด
                echo '<img src="'.$imagePath.'" alt="Uploaded Image">';
                echo $imagePath;
            } else {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์"; 
            }
        }
    }else {
        echo "กรุณเลือกรูปภาพ";
    }
}
?>
<?php
	$conn = mysqli_connect("localhost", "root", "", "workdb");
      $conn->query("SET NAMES UTF8");
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    session_start(); 
    
	$sql = "UPDATE work SET 
			imagePath = '$imagePath' 
			WHERE username = '".$_POST["username"]."' ";

         
	$query = mysqli_query($conn,$sql);

	if($query) {
	 //echo "Record update successfully";
     echo "<script>";
     echo "alert(\" [บันทึกข้อมูลเรียบร้อย]\");"; 
     //echo "window.history.back()";
     echo "</script>";
	}
    echo mysqli_error($conn);
	mysqli_close($conn);
?>