<?php
 include 'db_connect.php';
 $usermsg = $_POST['text'];
 $room = base64_decode($_POST['room']);
 $ip = $_POST['ip'];

 $sql = "INSERT INTO msgs SET msg = '$usermsg', room = '$room', ip = '$ip', stime = CURRENT_TIMESTAMP ";
 $result = mysqli_query($conn, $sql);
     mysqli_close($conn);




?>