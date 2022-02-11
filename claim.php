<?php

$room = $_POST['room'];

if(strlen($room) > 20 or strlen($room) < 2 ){
    $msg = "Please chooes name between 2 to 20 characters";
    echo '<script language="javascript">';
    echo 'alert("'.$msg.'");';
    echo 'window.location="http://localhost/chatAppPHP/index.php";';
    echo '</script>';
}elseif(!ctype_alnum($room)){
    $msg = "Please chooes name alpha characters";
    echo '<script language="javascript">';
    echo 'alert("'.$msg.'");';
    echo 'window.location="http://localhost/chatAppPHP/index.php";';

    echo '</script>';
} else{
    include 'db_connect.php';
}

$sql = "SELECT * FROM rooms WHERE roomname = '$room' ";

$result = mysqli_query($conn, $sql);

if($result){
    if(mysqli_num_rows($result)){
        $msg = "Room Alerday exist please chooes new one";
        echo '<script language="javascript">';
        echo 'alert("'.$msg.'");';
        echo 'window.location="http://localhost/chatAppPHP/index.php";';

        echo '</script>';
    } else {
        $sql1 = "INSERT INTO rooms SET roomname = '$room', `time` = CURRENT_TIMESTAMP ";
        if(mysqli_query($conn, $sql1)) {
           $room = base64_encode($room);
        //    echo $room;
        //    exit;
            $msg = "Your room ready chat start";
            echo '<script language="javascript">';
            echo 'alert("'.$msg.'");';
            echo 'window.location="http://localhost/chatAppPHP/rooms.php?roomname='.$room .'";';
    
            echo '</script>';
        }

    }
}


?>