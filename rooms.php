<?php
//  echo '<pre>';
//  print_r($_GET);
//  exit;

 $roomname = $_GET['roomname'];

 include 'db_connect.php';

 $sql = "SELECT * FROM rooms WHERE roomname ='$roomname' ";
 $result =mysqli_query($conn, $sql);
 if($result) {
    if(mysqli_num_rows($result) == 0) {
        $msg = "Room Alerday exist please chooes new one";
        echo '<script language="javascript">';
        echo 'alert("'.$msg.'");';
        echo 'window.location="http://localhost/HTML/index.php";';
        echo '</script>';
    }
 } else {
     echo "error : ". mysqli_error($conn);
 }


 



?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.scroln{
    height: 350px;
    overflow-y: scroll;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<h2>Chat Messages - <?php echo $roomname ?></h2>

<div class="container">
    <div class="scroln">

       
    </div>
</div>



<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="MSG"><br>
<button class="btn btn-success" name="submitbtn" id="submitbtn" > SEND</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">

    setInterval(getmsgFun, 1000);

        function getmsgFun(){
            $.post('getMsgs.php', {room: '<?php echo $roomname; ?>'},
                function(data, status) {
                    // console.log(data);
                    document.getElementsByClassName('scroln')[0].innerHTML = data;
                }
            ) 
        }



    var input = document.getElementById('usermsg');
    input.addEventListener('keyup', function(event){
        event.preventDefault();

        if(event.keyCode == 13) {
            document.getElementById('submitbtn').click();
        }

    })

    $('#submitbtn').click(function(){
        var usermsg = $('#usermsg').val();
        $.post('postdata.php', {text: usermsg, room: '<?php echo $roomname; ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>',
        function(data, status) {
            document.getElementsByClassName('scroln')[0].innerHTML = "Wait.....";
            $('#usermsg').val('');
            return false;
        }
        
        
        });
        
    })

</script>
</body>
</html>
