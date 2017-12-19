<?php 

include "../koneksi/koneksi.php";
session_start();
$pesan = " ";
if(isset($_POST['submit']))
{
  
  $nisn = $_POST['nisn'];
  $password = $_POST['password'];

  //query untuk mendapatkan record dari NISN 
  $cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisnnyo='$nisn'");
  if(!$cek)
  {
    $pesan = "<div class='alert alert-danger'><strong>Password Salah, Silahkan Coba Lagi</strong></div>";
  }
  $data = mysqli_fetch_assoc($cek);
  $passwordnya = $data['katorahasio'];
  $nisnnya = $data['nisnnyo'];

  //cek kesesuain password 
  if($password==$passwordnya && $nisn==$nisnnya)
  {
    // echo "Berhasil Login";
    $_SESSION['siswa'] = $data['nisnnyo'];
    header("Location: siswa_detail.php");
  }else{
    $pesan = "<div class='alert alert-danger'><strong>Password Salah, Silahkan Coba Lagi</strong></div>";
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
    <link href="../css/style.css" rel="stylesheet">
  <body >
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        
        <div class="row">
        <div class="info">    
     <a href="#"><button type="button" class="btn btn-default btn-sm">
  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Petunjuk Teknis
         </button></a>
            </div>
        </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--atas-->
      <div class="container">
        <div class="row">
  
  
          <div class="logo"> <a href='index.html'><img src="../images/logo.png" class="img-responsive" alt="Responsive images"></a></div>
                    
        </div>
          </div>   
<div class="kotak-bawah">
      <div class="container">
          
             <!--isi yang diubah-->

     <ol class="breadcrumb">
  <li><a href="../index.html">Home</a></li>
  <li><a href="si.masuk.html">Siswa</a></li>
  <li class="active">Masuk</li>
</ol>             
         
          
               <div class="row">
  <div class="col-md-5 col-md-offset-3">
  <?php echo $pesan; ?>
   <h4><b>LOGIN SISWA</b></h4>

<p>Login ke halaman dashboard siswa dengan NISN dan Password dari sekolah </p>
   <form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NISN</label>
    <div class="col-sm-10">
      <input type="" class="form-control" id="nisn" placeholder="Nomor Induk Siswa Nasional" name="nisn">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Ingat Saya
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="submit">Masuk</button>
    </div>
  </div>
</form>
  </div>
</div>          
              
              
              
              
              
              
              <!--isi yang diubah-->
         
          
      </div>          
</div><footer style="color:black">
      <div class="kotak-footer">
      <div class="container">
          <div class="row">
          </div>
            <div class="col-md-4"><h5>Bantuan</h5>
               <ul>
                    <a href="#"><li>FAQ</li></a>
                    <a href="#"><li>Unduh Petunjuk Teknis</li></a>
                    <a href="#"><li>Hubungi kami</li></a>
                </ul>   
          </div>
            <div class="col-md-4"><h5>Facebook</h5></div>
            <div class="col-md-4"><h5>Kontak</h5><p>
          Condong Catur, Depok, Sleman, Yogyakarta<br>
                No.Telephon  :<a href="#"> 08783537353<br></a>
                Email	     :<a href="#"> ehubsmk@gmail.com<br></a>
                Facebook	 :<a href="#"> fb.me/ehub.SMK</a></p>
          </div>
          </div>
      </div></footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>



