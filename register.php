<?php
session_start(); 
    require_once 'utility.php';

    $error  = "";
    if(isset($_POST['submit'])) 
    {
        $nama       = $_POST['nama'];
        $alamat     = $_POST['alamat'];
        $email      = $_POST['email'];
        $pass       = $_POST['password'];
        $konfir       = $_POST['konfir'];
        $telepon    = $_POST['telepon'];
        $no_sim     = $_POST['sim'];
        $status     = 2;
        $id         = "";

        if($pass == $konfir){
            $link = "setUser&id=" . urlencode($id) . "&nama=" . $nama . "&alamat=" . $alamat . "&email=" . $email . "&pwd=" . $pass . "&telepon=" . $telepon . "&no_sim=" . $no_sim . "&status=" . $status . "&type=insert";
            $data = getAdmin($link);
            if($data && $data->status == 1) 
            {
                
                    $error = "Registrasi Berhasil";
                    echo("<script>location.href='login.php';alert('berhasil')</script>");	
            }else {
                    $error = "Registrasi Gagal";
            } 
        }else{
            $error = "Password Tidak Sama";
        }
    } 
    
    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-light">
   <div class="container">
    <br>
   <?php
    if(!empty($error)){
        echo "<div class='d-flex justify-content-center'>";
        echo "<div class='alert alert-primary w-50' role='alert'>";
        echo $error;
        echo "</div>";
        echo "</div>";
    }
   ?>
    <div class="row text-white justify-content-center" style="margin-top:30px;">
        <div class="col-6">
            <form class="shadow bg-dark border border-light p-3 rounded" action="" method="POST">
                <div >
                    <p class="text-uppercase text-center fs-4 text-warning">Registrasi</p>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-sm" >
                        </div>
                    
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control form-control-sm" >
                        </div>
                      
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm" >
                        </div>
                        <div class="mb-3">
                            <label for="sim" class="form-label">Nomor SIM</label>
                            <input type="text" name="sim" id="sim"  class="form-control form-control-sm" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea type="text" name="alamat" id="alamat"  class="form-control form-control-sm" ></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password" id="password" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="konfir" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control form-control-sm" name="konfir" id="konfir" >
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>