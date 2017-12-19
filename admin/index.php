<?php 
include "../koneksi/koneksi.php";

session_start();

if(isset($_POST['login']))
{
  
  $namonyo = $_POST['namonyo'];
  $katorahasio = $_POST['katorahasio'];

  //query untuk mendapatkan record dari NISN 
  $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE namonyo='$namonyo'");
  if(!$cek)
  {
    echo "Gagal";
  }
  $data = mysqli_fetch_assoc($cek);
  $katorahasios = $data['katorahasio'];
  $namonyos = $data['namonyo'];

  //cek kesesuain password 
  if($katorahasio==$katorahasios && $namonyo==$namonyos)
  {
    // echo "Berhasil Login";
    $_SESSION['admin'] = $data['namonyo'];
    echo "<script>alert('Login Berhasil');history.go(-1);</script>";
    header("Location: dasbor.php");
  }else
  {
    echo "<script>alert('Gagal Login!');history.go(-1);</script>";
  }


}



 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>E-hub SMK</title>

    <!-- Bootstrap -->
    
    <link href="../css/bootstrap.min.css" rel="stylesheet">
       <link href="../css/style6.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
   
  <body >
    
        <div class="container">
            <div class="row">
 
                <div class="col-md-6 col-md-offset-3">
                    
                    <div class="login">
                        <img src="../images/logo.png" class="img-responsive" alt="Responsive image">
                        <div class="isi">
                        <form class="form-horizontal" method="post">
                          <div class="form-group">
                            
                            <div class="col-sm-10">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Email" required name="namonyo">
                            </div>
                          </div>
                          <div class="form-group">
                            
                            <div class="col-sm-10">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                              <input type="password" class="form-control" id="inputPassword3" placeholder="Password" required name="katorahasio">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> Selalu Masuk
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary btn-sm" name="login">Masuk</button>
                            </div>
                          </div>
                        </form>
                        </div>    

	               </div>
                </div>
   
            </div>
        </div> 
     
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>