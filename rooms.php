<?php
//  echo '<pre>';
//  print_r($_GET);
//  exit;

 $roomname = base64_decode($_GET['roomname']);

 include 'db_connect.php';

 $sql = "SELECT * FROM rooms WHERE roomname ='$roomname' ";
 $result =mysqli_query($conn, $sql);
 if($result) {
    if(mysqli_num_rows($result) == 0) {
        $msg = "Room Alerday exist please chooes new one";
        echo '<script language="javascript">';
        echo 'alert("'.$msg.'");';
        echo 'window.location="http://localhost/chatAppPHP/index.php";';
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  /* max-width: 800px; */
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 20px;
  margin: 20px 0;
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
</head>
<body>
<header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">ApniBaatBinaDare.com</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">About</a>
        <a class="nav-link" href="#">Contact</a>
      </nav>
    </div>
  </header>
<br>
<br>
<h2 class="offset-4">Chat Room Name - <?php echo $roomname ?></h2>
<br>
<div class="col-sm-3"></div>
<div class="container">
    <div class="scroln">

       
    </div>
    <br><br>
    
    
    <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="MSG"><br>
    <button class="btn btn-success" name="submitbtn" id="submitbtn" > SEND</button>
  </div>

  <footer class="mt-auto text-white-50">
    <p><a href="https://twitter.com/mdo" class="text-dark">@MCL</a>.</p>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">

    setInterval(getmsgFun, 300);

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
