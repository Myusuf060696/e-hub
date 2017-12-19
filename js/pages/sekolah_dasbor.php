<?php 
include "../koneksi/koneksi.php";
   session_start();
  if(!isset($_SESSION['sekolah']))
  {
    header("Location: ../index.php");
  }
  $npsnyo = $_SESSION['sekolah'];

  // Ini sintaks untuk query data siswa 
  $kueri = mysqli_query($koneksi, "SELECT * FROM sekolah WHERE npsnyo='$npsnyo' ");
  $data = mysqli_fetch_assoc($kueri);
  $namasekolah = $data['namo_sekolah'];
  $foto = $data['logonyo_sekolah'];

  $npsnyo = $data['npsnyo'];
  $namo_sekolah = $data['namo_sekolah'];
  $alamatnyo_sekolah = $data['alamatnyo_sekolah'];
  $websitenyo = $data['websitenyo'];
  $emailnyo_sekolah = $data['emailnyo_sekolah'];
  $nomer_hp_sekolah = $data['nomer_hp_sekolah'];
  $katorahasio_sekolah = $data['katorahasio_sekolah'];




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
    <link href="../css/style2.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
                  /* The Modal (background) */
          .modal {
              display: none; /* Hidden by default */
              position: fixed; /* Stay in place */
              z-index: 9999; /* Sit on top */
              padding-top: 100px; /* Location of the box */
              left: 0;
              top: 0;
              width: 100%; /* Full width */
              height: 100%; /* Full height */
              overflow: auto; /* Enable scroll if needed */
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          }

          /* Modal Content */
          .modal-content {
              background-color: #fefefe;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 40%;
          }

          /* The Close Button */
          .close {
              color: #aaaaaa;
              float: right;
              font-size: 28px;
              font-weight: bold;
          }

          .close:hover,
          .close:focus {
              color: #000;
              text-decoration: none;
              cursor: pointer;
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
      <div class="logo"> <a href='../index.html'><img src="../images/logo2.png" class="img-responsive" alt="Responsive image"></a></div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!--<form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>-->
  <ul class="nav navbar-nav navbar-right" >
      <li><a href="beranda_siswa2.php" >Siswa</a></li>
        <li><a href="beranda_perusahaan2.php" >Perusahaan</a></li>
        <li class="dropdown">
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
      <div class="container-fluid">
          
             <!--isi yang diubah-->

               <div class="row">
    <div class="col-md-3">
        <div class="kiri">
            <div class="list-group-item active"><h4>Dasboard Sekolah</h4>
            </div>
        </div>
        <div class="kiri">
           
            <img src="../images/<?php echo $foto; ?>" alt="<?php echo $foto; ?>" class="img-thumbnail" style="width:100%">
            <!-- Ini Untuk Ganti Profil Gan -->
            <button id="myBtn" type="button" class="btn btn-default btn-sm" style=";margin-left:9%;" aria-label="Left Align">    <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span> Sunting foto</button>
                   
              <!-- The Modal -->
              <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                <h3>Ganti Foto Profil</h3>
                  <span class="close">&times;</span>
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="fotonyo">
                    <input type="submit" name="upload">
                  </form>
                

                </div>
                <!-- End Modal -->
                  <?php 
                  if(isset($_POST['upload'])){
                    $namafoto = $_FILES["fotonyo"]["name"];
                    $file_basename = substr($namafoto, 0, strripos($namafoto, '.')); // get file extention
                    $file_ext = substr($namafoto, strripos($namafoto, '.')); // get file name
                    $filesize = $_FILES["fotonyo"]["size"];
                    $allowed_file_types = array('.png','.jpg','.JPG','.jpeg');  

                    if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
                    { 
                      // Rename file
                      $newnamafoto = "$npsnyo"."_"."$namafoto" ;
                      // . $file_ext
                      if (file_exists("../images/" . $newnamafoto))
                      {
                        // file already exists error
                        $pesanfoto =  "You have already uploaded this file.";
                        $up = mysqli_query($koneksi, "UPDATE sekolah SET logonyo_sekolah='$newnamafoto' WHERE npsnyo='$npsnyo'");
                        echo " <meta http-equiv=\"refresh\" content=\"0\" /> ";
                      }
                      else
                      {   
                        move_uploaded_file($_FILES["fotonyo"]["tmp_name"], "../images/" . $newnamafoto);
                        $up = mysqli_query($koneksi, "UPDATE siswa SET logonyo_sekolah='$newnamafoto' WHERE npsnyo='$npsnyo'");
                        echo "</script>alert('Berhasil');</script>";  
                        echo " <meta http-equiv=\"refresh\" content=\"0\" /> ";
                        
                      }
                      }
                      elseif (empty($file_basename))
                      { 
                        // file selection error
                        $pesanfoto =  "Please select a file to upload.";
                      } 
                      elseif ($filesize > 200000)
                      { 
                        // file size error
                        $pesanfoto =  "The file you are trying to upload is too large.";
                      }
                      else
                      {
                        // file type error
                        $pesanfoto =  "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
                        unlink($_FILES["fotonyo"]["tmp_name"]);
                      } 
                      }

                      ?>

              </div>
           
        </div>
        <div class="kiri" >
            <div class="list-group">
      <a href="sekolah_detail.php" class="list-group-item">Profil Detail</a>
      <a href="sekolah_dasbor.php" class="list-group-item active">Edit profil sekolah</a>
      <a href="sekolah_dasbor_input.php" class="list-group-item">Daftarkan siswa</a>
      <a href="sekolah_dasbor_siswa.php" class="list-group-item">Semua siswa</a>
      <a href="sekolah_dasbor_post.php" class="list-group-item">Posting berita</a>
      <a href="sekolah_dasbor_berita.php" class="list-group-item">Semua berita</a>
</div>
      
        </div>
        
    </div>
   <div class="col-md-6">
                    <div class="kanan" >
 <div class="isi">
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Profil Sekolah</div>
  <?php
    
        if(isset($_POST['update']))
          {
              $namo_sekolah = $_POST['namo_sekolah'];
              $alamatnyo_sekolah = $_POST['alamatnyo_sekolah'];
              $websitenyo = $_POST['websitenyo'];
              $emailnyo_sekolah = $_POST['emailnyo_sekolah'];
              $nomer_hp_sekolah = $_POST['nomer_hp_sekolah'];

              $update = mysqli_query($koneksi, "UPDATE sekolah SET namo_sekolah='$namo_sekolah', alamatnyo_sekolah='$alamatnyo_sekolah', websitenyo='$websitenyo',emailnyo_sekolah='$emailnyo_sekolah',nomer_hp_sekolah='$nomer_hp_sekolah' WHERE npsnyo='$npsnyo'") or die (mysqli_error());

              if($update)
              {
                echo "<script>alert('Update Profil Berhasil');history.go(-1);</script>";
              }
              else{
                echo "<script>alert('Gagal Update Profil!');history.go(-1);</script>";
              }            
          }

       ?>
  <div class="panel-body">
              <!-- Table -->
              <form action="" method="post">
                 <div class="form-group">
                   <label for="npsnyo">NPSN</label>
                   <input type="text" class="form-control" id="NPSN" placeholder="Nomor Pokok Perusahaan" required name="npsnyo" value="<?php echo $npsnyo; ?>" disabled >
                </div>

                  <div class="form-group">
                    <label for="namo_sekolah">Nama Sekolah</label>
                    <input type="text" class="form-control" id="namo_sekolah" placeholder="Nama Sekolah" required name="namo_sekolah" value="<?php echo $namo_sekolah; ?>">
                  </div>
                     

                  <div class="form-group">
                    <label for="alamatnyo_sekolah">Alamat Sekolah</label>
                    <textarea class="form-control" id="alamatnyo_sekolah" placeholder="<?php echo $alamatnyo_sekolah; ?>" name="alamatnyo_sekolah"  ></textarea>
                  </div>

          
                  <div class="form-group">
                    <label for="websitenyo">Website</label>
                    <input type="text" class="form-control" id="websitenyo" placeholder="Website Sekolah" name="websitenyo" value="<?php echo $websitenyo; ?>">
                  </div>

                  <div class="form-group">
                    <label for="emailnyo_sekolah">Email </label>
                    <input type="email" class="form-control" id="emailnyo_sekolah" placeholder="Email Sekolah" name="emailnyo_sekolah" value="<?php echo $emailnyo_sekolah; ?>">
                  </div>

                  <div class="form-group">
                    <label for="nomer_hp_sekolah">No Telp.</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Telp" name="nomer_hp_sekolah" value="<?php echo $nomer_hp_sekolah; ?>">
                  </div>

                  

                  <div class="form-group">
                    <label for="katorahasio_sekolah">Password</label>
                    <input type="text" class="form-control" id="katorahasio_sekolah" placeholder="Password" name="katorahasio_sekolah" value="<?php echo $katorahasio_sekolah; ?>" disabled>
                  </div>
                  <br>
                   <button type="submit" class="btn btn-default" name="update">Update</button>
              </form>
            </div>
</div>
     
    <div class="panel panel-default" >
    <?php 
        $pesan = " ";
        if(isset($_POST['ganti']))
        {
          $passlama = $_POST['passlama'];
          $passbaru1 = $_POST['passbaru1'];
          $passbaru2 = $_POST['passbaru2'];
          $cek = mysqli_query($koneksi, "SELECT * FROM sekolah WHERE npsnyo='$npsnyo' AND katorahasio_sekolah='$passlama'");
            if(mysqli_num_rows($cek)==0)
            {
              echo "<script>alert('Password Yang Lama Salah');history.go(-1);</script>";
            }
          else{
            if($passbaru1==$passbaru2)
            {
              $pass=$passbaru1;
              $update = mysqli_query($koneksi, "UPDATE sekolah SET katorahasio_sekolah='$pass' WHERE npsnyo='$npsnyo'");

              if($update)
              {
                echo "<script>alert('Password Berhasil Dirubah');history.go(-1);</script>";
              }
              else
              {
                echo "<script>alert('Password Gagal Dirubah Maafkan Kami, Silahkan Hubungi Contact Person');history.go(-1);</script>";
              }
            }
            else{
              echo "<script>alert('Konfirmasi Password Tidak Sesuai');history.go(-1);</script>";
            }
          }

        }

         ?>
        <div class="panel-heading">Ganti Password</div>
  <div class="panel-body">
      <form style="width:60%" method="post">
    <div class="form-group" ><required>
    <label for="exampleInputPassword1">Password lama</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="passlama">
  </required></div>
        <div class="form-group">
    <label for="exampleInputPassword1">Password Baru</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="passbaru1">
  </div>
        <div class="form-group">
    <label for="exampleInputPassword1">Konfirmasi Password Baru</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="passbaru2">
  </div>
      <button type="submit" class="btn btn-default" name="ganti">Submit</button>
      <?php 
        echo $pesan;
       ?>
       </form>                 
                        </div>   
                        </div>
      </div>
        </div>
       
                   </div>  
                   

</div>          
              
        
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
                Email	     :<a href="#"> ehubsmk@gmail.com<br></a>
                Facebook	 :<a href="#"> fb.me/ehub.SMK</a></p>
          </div>
          </div>
      </div></footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

    <script>
      // Get the modal
      var modal = document.getElementById('myModal');

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function() {
          modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
          modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }
      </script>
  </body>
</html>