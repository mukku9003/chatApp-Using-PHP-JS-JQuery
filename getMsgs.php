<?php

include 'db_connect.php';
$room = base64_decode($_POST['room']);


$sql = "SELECT msg, stime, ip FROM msgs WHERE room = '$room' ";
$res = "";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $sty = "background-color: #a93030;text-align:left;font-size:12px;color:#fff;";
        if($row['ip'] == $_SERVER['REMOTE_ADDR']) {
            $sty = "background-color: #4aaf4a;text-align:right;font-size:12px;color:#fff;";
        }

        $dates = date('d-M-y', strtotime($row['stime']));
        $time = date('H:i A', strtotime($row['stime']));


        $res = $res . '<div class="container" style="'.$sty.'">';
        $res = $res . $row['ip'];
        $res = $res . " Says: <p>".$row['msg'];
        $res = $res . '</p> <span class=""> '.$dates.'  '.$time."</span></div>";
    }
}

echo $res;


?>