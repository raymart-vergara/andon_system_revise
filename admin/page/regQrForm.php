<?php
	include '../processor/conn.php';
	$datenow =  date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register QR</title>
    <link rel="icon" type="image/png" href="../../img/ANDON ICON.png">
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.min.css">
	<style>
	   body{
           font-family:arial;
       }
    select,input,button,tr{
      font-family: arial;
    }
    select{
        border-radius:20px;
    }
   .btn-large{
        border-radius:30px;
    }
    </style>
</head>
<body>
    <div class="container row">
        <div class="col s12">
        <h5 class="center">Register QR Application Form</h5>
        <!-- ID NMBER -->
            <div class="input-field col l12 m12 s12">
                <input type="text" id="id_number"><label for="">Operator ID Number</label>
            </div>
        <!-- NAME -->
            <div class="input-field col l6 m6 s12">
                <input type="text" id="fname"><label for="">First Name</label>
            </div>
            <div class="input-field col l6 m6 s12">
                <input type="text" id="lname"><label for="">Last Name</label>
            </div>
        <!-- LINE -->
            <div class="input-field col l6 m6 s12">
                <select name="" id="carmaker" class="browser-default z-depth-4">
                    <option value="" selected disabled>--SELECT CAR MODEL--</option>
                    <?php
                        $q = "SELECT carMaker FROM tblcarmaker";
                        $stmt = $conn->prepare($q);
                        $stmt->execute();
                        foreach($stmt->fetchALL() as $x){
                            if($x['carMaker'] == 'IT' || $x['carMaker'] == 'EQD' || $x['carMaker'] == 'PE')continue;
                    ?>
                        <option value="<?=$x['carMaker']?>"><?=$x['carMaker']?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>

            <div class="input-field col l6 m6 s12">
                <select name="" id="category" class="browser-default z-depth-4">
                    <option value="" selected disabled>--SELECT PROCESS--</option>
                    <option value="Initial">Initial</option>
                    <option value="Final">Final</option>
                </select>
            </div>

            <div class="input-field col s12">
                <select name="" id="account" class="browser-default z-depth-5">
                    <option value="">--SELECT ACCOUNT TYPE--</option>
                    <option value="Operator Account">Operator Account</option>
                    <option value="Event Account">Event Account</option>
                </select>
            </div>
            
            <div class="input-field col l6 m6 s12">
                <button class="btn-large red col s12" onclick="send_request()">Send request</button>
            </div>
            <div class="input-field col l6 m6 s12">
            <button class="btn-large green col s12" onclick="location.reload()">cancel</button>
            </div>
        </div>
    </div>

<script type="text/javascript" src="../materialize/jquery/jqueryLib.js"></script>
<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../../sweetalert/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../../sweetalert/sweetalert2.all.js"></script>
<script>
const send_request =()=>{
    var operator_id = document.getElementById('id_number').value;
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var car_model = document.getElementById('carmaker').value;
    var categ = document.getElementById('category').value;
    var type = document.getElementById('account').value;
    if(operator_id == ''){
        M.toast({html:'Please enter your ID number!',classes:'red rounded'});
    }else if(fname == ''){
        M.toast({html:'Please enter your First Name!',classes:'red rounded'});
    }else if(lname == ''){
        M.toast({html:'Please enter your Last Name!',classes:'red rounded'});
    }else if(car_model == ''){
        M.toast({html:'Please select your designated car model!',classes:'red rounded'});
    }else if(categ == ''){
        M.toast({html:'Please select your designated process category!',classes:'red rounded'});
    }else if(type == ''){
        M.toast({html:'Please select your account type!',classes:'red rounded'});
    }else{
        $.ajax({
            url: '../processor/request_qr.php',
            type: 'POST',
            cache: false,
            data:{
                method: 'request',
                operator_id:operator_id,
                fname:fname,
                lname:lname,
                car_model:car_model,
                categ:categ,
                type:type
            },success:function(response){
                // swal('Notification',response,'info');
                console.log(response);
                if(response == 'exist'){
                    swal('Alert','You already have sent request, please avoid multiple request!','info');
                }else if(response == 'save'){
                    swal('Sent!','You successfully sent a request!','success').then((value)=>{
                        location.reload();
                    });
                }else{
                    swal('Failed!','An error has occur, please try again!','error');
                }
            }
        });
    }
}



// IDLE -------------------------
var idleTime = 0;
$(document).ready(function(){
  var idleInterval = setInterval(timerIncrement,60000); //PER 1 MINUTE
  $(this).mousemove(function(e){
    idleTime = 0;
  });

  $(this).keypress(function(e){
    idleTime = 0;
  });

  $(this).mousedown(function(e){
    idleTime = 0;
  });

  $(this).click(function(e){
    idleTime = 0;
  });

  $(this).keydown(function(e){
    idleTime = 0;
  });

  $(this).scroll(function(e){
    idleTime = 0;
  });
});
function timerIncrement(){
  idleTime = idleTime + 1;
  console.log(idleTime);
  if(idleTime > 1){
    window.close();
  }
}

window.onload=function(){function e(e){return e.stopPropagation?e.stopPropagation():window.event&&(window.event.cancelBubble=!0),e.preventDefault(),!1}document.addEventListener("contextmenu",function(e){e.preventDefault()},!1),document.addEventListener("keydown",function(t){t.ctrlKey&&t.shiftKey&&73==t.keyCode&&e(t),t.ctrlKey&&t.shiftKey&&74==t.keyCode&&e(t),83==t.keyCode&&(navigator.platform.match("Mac")?t.metaKey:t.ctrlKey)&&e(t),t.ctrlKey&&85==t.keyCode&&e(t),123==event.keyCode&&e(t)},!1)};
</script>
</body>
</html>