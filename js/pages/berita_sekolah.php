<?php 
  include "../koneksi/koneksi.php";
  
    // Ini sintaks untuk query data siswa 
  

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
<link href="../css/style3.css" rel="stylesheet">
    <style>
.post {
  margin-bottom: 20px;
  background: #fff;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}
.post .title {
  margin: 0;
  padding: 10px;
  padding-left: 16px;
  background: #f5f5f5;
  border-left: 4px solid #079DBD;
}
.post .konten {
  padding: 20px;
}
.post .info {
  padding: 20px;
  background: #f5f5f5;
  font-style: italic;
  font-size: 14px;
}

    </style>

  </head>
    
  <body ><div class="navdewe" style="color:white">
      <nav class="navbar navbar-inverse navbar-fixed-top" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="logo"> <a href='../index.html'><img src="../images/logo2.png" class="img-responsive" alt="Responsive images"></a></div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
      <form class="navbar-form navbar-left">
        <div class="input-group">         
  <div class="input-group-btn">
    <select class="form-control">
  <option>Nama Sekolah</option>
  <option>Tnggal Berita</option>
  <option>Isi berita</option>
</select>
    <!-- Button and dropdown menu -->  
 
 <input type="text" class="form-control" aria-label="..." placeholder="Cari berdasarkan ...">
<a class="btn btn-default" href="#" role="button" style="border-radius: 0px 5px 5px 0px">
      <span class="glyphicon  glyphicon glyphicon-search" aria-hidden="true"></span>
      </a>
  </div>
            
</div>
      </form>
  <ul class="nav navbar-nav navbar-right" >
      <li><a href="beranda_siswa2.php" >Siswa</a></li>
        <li><a href="beranda_perusahaan2.php" >Perusahaan</a></li>
        <li  class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Berita <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="berita_sekolah.php">Sekolah</a></li>
            <li><a href="berita_perusahaan.php">Perusahaan</a></li>    
          </ul>
        </li>
       <li class="active"><a href="sekolah_dasbor.php" >Dasbor    <span class="sr-only">(current)</span></a></li>
      <li ><a href="logout.php" >   Keluar</a></li>
    </ul>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
      </div>
<!--atas-->
  
<div class="kotak-bawah">
      <div class="container">
          
             <!--isi yang diubah-->

<div class="row">
    
  <div class="col-md-12 " style="background:#f2f4f7;padding-left:15%;padding-right:15%;">
      <br>
    
    <?php 
      $kueri = mysqli_query($koneksi, "SELECT * FROM berita_sekolah, sekolah where berita_sekolah.npsnyo=sekolah.npsnyo ") or die (mysqli_erorr());
      while ($data = mysqli_fetch_assoc($kueri)) {
        echo "
         <div class='thumbnail' style='width:97%;padding:10px;margin: 10px; overflow:hidden;'>
        <img src='../images/".$data['logonyo_sekolah']."' alt='...' style='text-align:left;float:left;max-width:50px;margin:10px;padding:9px;'>

       
        <h1>".$data['judulnyo']."</h1><hr>

        

   
  
      <p>
        ".$data['dalemannyo']."
      </p>  
      
      <hr>
      <span><i>".$data['tanggalnyo']."</i></span> &mdash; <span><a href='#'>".$data['namo_sekolah']."</a></span>
    
    </div> 


        ";
      }

     ?>
  

    </div>
  

<nav aria-label="..." style="float:center;text-align:center">
  <ul class="pagination">
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
      <li><a href="#">2 <span class="sr-only"></span></a></li>
      <li><a href="#">3 <span class="sr-only"></span></a></li>
      <li><a href="#">4<span class="sr-only"></span></a></li>
      <li><a href="#">5 <span class="sr-only"></span></a></li>
      
<li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
      </li>
  </ul>
</nav> 
              <!--isi yang diubah-->
         
      </div>          
</div>
 
       
 
      
<footer style="color:black">
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
                Email      :<a href="#"> ehubsmk@gmail.com<br></a>
                Facebook   :<a href="#"> fb.me/ehub.SMK</a></p>
          </div>
          </div>
      </div></footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>