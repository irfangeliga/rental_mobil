<?php
session_start(); 
$_SESSION['user'] = NULL;
    require_once 'utility.php';

    $error  = "";
    if(isset($_POST['submit'])) 
    {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $_SESSION['user'] = $email;
        $_SESSION['pass'] = $pass;

        $link = "getUserId&email=". urlencode($email) . "&password=" . urlencode($pass);
        $data = getApp($link);
        if($data && $data->status == '1') 
        {
            echo("<script>alert('berhasil')</script>");	
            $s_email    = $data->data[0]->email;
            $s_pass     = $data->data[0]->password;
            $status     = $data->data[0]->status;
            $_SESSION['user'] = $s_email;
            $_SESSION['pass'] = $s_pass;
            $_SESSION['status'] = $status;

            if($status == 1){
                echo("<script>location.href = 'admin/index.php?url=read';</script>");	

            }else{
                echo("<script>location.href = 'pages/car.php';</script>");	
            }
        } else {
            $error = "Password / Username invalid";	

        }
    }    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-light">
   <div class="container">
   <?php
    if(!empty($error)){
        echo "<div class='alert alert-primary' role='alert'>";
        echo $error;
        echo "</div>";
    }
   ?>
    <div class="row text-white justify-content-center" style="margin-top:30px;">
        <div class="col-4">
            <form class="shadow bg-dark border border-light p-3 rounded" action="" method="POST">
                <div >
                    <p class="text-uppercase text-center fs-4 text-warning">Login</p>
                    <hr>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" >
                    
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-sm" name="password" id="password" >
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>