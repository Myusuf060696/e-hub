<?php 
  include "../koneksi/koneksi.php";

  session_start();
  if(!isset($_SESSION['siswa']))
  {
    header("Location: ../index.php");
  }
  $nisn = $_SESSION['siswa'];

  // Ini sintaks untuk query data siswa 
  $kueri = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisnnyo='$nisn'");
  $data = mysqli_fetch_assoc($kueri);
  $namasiswa = $data['namonyo'];
  $foto = $data['fotonyo'];
  $emailnyo = $data['emailnyo'];
  $tgl = date('l, d-m-Y');



 ?>


<?php 
  require 'phpmailer/PHPMailerAutoload.php';
  if(isset($_POST['lamar']))
  {
    $namasiswas = $_POST['namonyo'];
    $emailnyos = $_POST['emailnyo'];
    $isi = $_POST['isinyo'];
    $emailtujuan = $_POST['emailtujuan'];

    $query = mysqli_query($koneksi,"SELECT nipernyo FROM perusahaan where emailnyo='$emailtujuan'");
    $cekemail=mysqli_fetch_assoc($query);
    $nipernyoperusahaan = $cekemail['nipernyo'];
    

      $insert = mysqli_query($koneksi, "INSERT  INTO lamaran (ciri_lamarannyo, dalemannyo, tanggalnyo, nisnnyo, emaitujuannyo, emailpengirimnyo,nipernyo) values 
      (NULL,'$isi','$tgl','$nisn','$emailtujuan','$emailnyos','$nipernyoperusahaan')") or die (mysqli_error());
    
    


    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->SMTPAuth = true;
    $mail->Username = "muhammadyusuf931@gmail.com";
    $mail->Password = "malangke06";
    $mail->setFrom($emailnyos, $namasiswas);
    $mail->addAddress($emailtujuan, 'Uncup');
    $mail->Subject = "LAMARAN";
    $mail->msgHTML($isi);
    if (!$mail->send()) {
        echo "<script>alert('Email Gagal Dikirim');history.go(-1);</script>";
    } else {
        echo "<script>alert('Email Terkirim');history.go(-1);</script>";

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
      <div class="logo"> <a href='../index.html'><img src="../images/logo2.png" class="img-responsive" alt="Responsive images"></a></div>
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
        <li><a href="b.perusahaan.html" >Perusahaan</a></li>
       <li class="active"><a href="#" >Dasbor    <span class="sr-only">(current)</span></a></li>
      <li ><a href="logout.php" >Keluar</a></li>
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
            <div class="list-group-item active"><h4>Dasbor Siswa</h4>
            </div>
        </div>
        <div class="kiri">
           
            <img src="../images/<?php echo $foto; ?>" alt="..." class="img-thumbnail" style="width:80%;margin-left:9%;">
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
                      $newnamafoto = "$nisn"."_"."$namafoto" ;
                      // . $file_ext
                      if (file_exists("../images/" . $newnamafoto))
                      {
                        // file already exists error
                        $pesanfoto =  "You have already uploaded this file.";
                        $up = mysqli_query($koneksi, "UPDATE siswa SET fotonyo='$newnamafoto' WHERE nisnnyo='$nisn'");
                        echo " <meta http-equiv=\"refresh\" content=\"0\" /> ";
                      }
                      else
                      {   
                        move_uploaded_file($_FILES["fotonyo"]["tmp_name"], "../images/" . $newnamafoto);
                        $up = mysqli_query($koneksi, "UPDATE siswa SET fotonyo='$newnamafoto' WHERE nisnnyo='$nisn'");
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
                        <a href="siswa_detail.php" class="list-group-item">Detail Profil</a>
                        <a href="siswa_edit_profil.php" class="list-group-item ">
                        Edit profil 
                        </a>
                        <a href="siswa_prestasi.php" class="list-group-item ">Tambah Prestasi</a>
                        <a href="siswa_dasbor_lamar.php" class="list-group-item active">Kirim lamaran</a>
                        <a href="siswa_dasbor_undang.php" class="list-group-item">undangan</a>
</div>
      
        </div>
        
    </div>
   <div class="col-md-9">
                    <div class="kanan" >
 <div class="isi">
     
    <div class="panel panel-default" >
        <div class="panel-heading">Kirim Lamaran</div>
  <div class="panel-body">
      <form style="width:80%"  method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama </label>
              <input  type="text" class="form-control" id="" placeholder="" required value="<?php echo $namasiswa; ?>" name="namonyo" >
            </div>

            <div class="form-group">
            <label for="exampleInputEmail1">Email </label>
            <input  type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required value="<?php echo $emailnyo; ?>" name="emailnyo" >
           </div>

        <div class="form-group">
    <label for="exampleInputEmail1">Email Perusahaan</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required name="emailtujuan">
  </div>
        <label for="alamat">Isi Lamaran</label>
    <textarea class="form-control" rows="6" id="" placeholder="" required name="isinyo"></textarea>
  <br>
          
             <h3><button name="lamar" type="submit" class="btn btn-default btn-md"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>  Kirim</button> </h3>


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