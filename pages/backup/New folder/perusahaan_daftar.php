<script type="text/javascript" src="../js/ajax_kota.js"></script>
<!-- Asset untuk plugin form kota otomatis -->

<?php 
include "../koneksi/koneksi.php";
include "../koneksi/random.php";
 ?>
<!-- Koding untuk ambil nama kotanya coyyyy -->
<?php 
  $pesan = " ";
  $pesanlogo = " ";
   $pesanfoto = " ";

 ?>
 <?php 
  if(isset($_POST['kirim']))
  {
    $nipernyo = $_POST['nipernyo'];
    $namonyo = $_POST['namonyo'];
    $cirinyo = $_POST['cirinyo'];
    $alamatnyo = $_POST['alamatnyo'];
    $websitenyo = $_POST['websitenyo'];
    $emailnyo = $_POST['emailnyo'];
    $nomer_hp = $_POST['nomer_hp'];
    $rinciannyo = $_POST['rinciannyo'];
    $kota = $_POST['kota'];
   
    ?>
    <?php 
      
          $namalogo = $_FILES["logo"]["name"];
          $file_basename = substr($namalogo, 0, strripos($namalogo, '.')); // get file extention
          $file_ext = substr($namalogo, strripos($namalogo, '.')); // get file name
          $filesize = $_FILES["logo"]["size"];
          $allowed_file_types = array('.png','.jpg','.JPG','.jpeg');  

          if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
          { 
            // Rename file
            $newnamalogo = "$nipernyo"."_"."$namalogo" ;
            // . $file_ext
            if (file_exists("../images/" . $newnamalogo))
            {
              // file already exists error
              $pesanlogo =  "You have already uploaded this file.";
            }
            else
            {   
              move_uploaded_file($_FILES["logo"]["tmp_name"], "../images/" . $newnamalogo);
                
            }
            }
            elseif (empty($file_basename))
            { 
              // file selection error
              $pesanlogo =  "Please select a file to upload.";
            } 
            elseif ($filesize > 200000)
            { 
              // file size error
              $pesanlogo =  "The file you are trying to upload is too large.";
            }
            else
            {
              // file type error
              $pesanlogo =  "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
              unlink($_FILES["logo"]["tmp_name"]);
            }
      ?>
        

       

  <?php  
    $cek = mysqli_query($koneksi,"SELECT * FROM perusahaan WHERE nipernyo='$nipernyo'");
    if(mysqli_num_rows($cek)==0)
    {
      $insert = mysqli_query($koneksi, "INSERT INTO perusahaan (nipernyo, namonyo, cirinyo, alamatnyo, websitenyo, emailnyo , nomer_hp,rinciannyo, katorahasio, logonyo,  kotanyo) values ('$nipernyo','$namonyo','$cirinyo','$alamatnyo','$websitenyo','$emailnyo','$nomer_hp','$rinciannyo','$password','$newnamalogo','$kota')") or die (mysqli_error());
      if($insert)
      {
        $pesan = "<div class='alert alert-success'><strong>Pendaftaran Berhasil!</strong> Password Perusahaan : $password, Silahkan 
        <a href='perusahaan_masuk.php' class='alert-link'> Klik Disini untuk Login </a></div>";
      }
    }
    else
    {
      $pesan = " <div class='alert alert-danger'><strong>NIPER SUDAH TERDAFTAR</strong> </div>";
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
    <link href="../css/style.css" rel="stylesheet">
  </head>
    
<body>
<!-- Mulai di Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="row">
          <div class="info"><a href="#"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>Petunjuk Teknis</button></a>
          </div>
        </div>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
<!--atas-->




      <div class="container">
        <div class="row">
  
  
          <div class="logo"> <a href='index.php'><img src="../images/logo.png" class="img-responsive" alt="Responsive images"></a></div>
                    
        </div>
          </div>   
<div class="kotak-bawah">
      <div class="container">
          
             <!--isi yang diubah-->

     <ol class="breadcrumb">
        <li><a href="../index.php">Home</a></li>
        <li><a href="perusahaan_pilihan.php">Perusahaan</a></li>
        <li class="active">Daftar</li>
    </ol>             
  <h4><?php echo $pesan; ?></h4>
  <h4><b>Formulir Pendaftaran Perusahaan</b></h4>
  <br>

     <p> Lengkapi data Perusahaan yang ingin Anda daftarkan</p>   
     <div class="row">
<form method="post" enctype="multipart/form-data">
  <div class="col-md-6">

    <div class="form-group">
      <label for="NIPER">NIPER</label>
      <input type="text" class="form-control" id="NIPER" placeholder="Nomor Induk Perusahaan" required name="nipernyo">
    </div>
    <div class="form-group">
      <label for="namonyo">Nama Perusahaan</label>
      <input type="text" class="form-control" id="nama_sekolah" placeholder="Nama Perusahaan" required name="namonyo">
    </div>
    <div class="form-group">
      <label for="cirinyo">Kategori</label>
      <select name="cirinyo" id="" class="form-control" >
        <option value="">Kategori Perusahaan</option>
        <option value="Ekstraktif">Ekstraktif</option>
        <option value="Agraris">Agraris </option>
        <option value="Industri ">Industri </option>
        <option value="Niaga">Niaga</option>
        <option value="Jasa">Jasa</option>
      </select>
    </div>
    <div class="form-group">
      <label for="alamatnyo">Alamat Perusahaan</label>
      <textarea class="form-control" rows="3" id="alamatnyo" placeholder="Alamat Perusahaan" required name="alamatnyo"></textarea>
    </div>
    <div class="form-group">
      <label for="websitenyo">Website Perusahaan</label>
      <input type="text" class="form-control" id="nama_sekolah" placeholder="websitenyo" required name="websitenyo">
    </div>
      <div class="form-group">
        <label for="emailnyo">Email Perusahaan</label>
        <input type="email" class="form-control" id="emailnyo" placeholder="Email" required name="emailnyo">
      </div>
      <div class="form-group">
          <label for="nomer_hp">No.telp Perusahaan </label>
          <input type="number" class="form-control" id="nomer_hp" placeholder="No.telp" required name="nomer_hp">
      </div>
      <div class="form-group">
          <label for="rinciannyo">Deskripsi Perusahaan</label>
          <textarea class="form-control" name="rinciannyo" id="" cols="30" rows="10" placeholder="Deskripsi Perusahaan" required ></textarea>
      </div>

    <div class="form-group">
       <label for="kota">Kota</label>
       <select class="form-control" name="kota" id="kota" onchange="ajaxkec(this.value)">
          <option value="">Pilih Kota</option>
          <option value="Yogyakarta">Yogyakarta</option>
          <option value="Palembang">Palembang</option>
          <option value="Magelang">Magelang</option>
          <option value="Banjar Negara">Banjar Negara</option>
          <option value="Sekayu">Sekayu</option>
      </select>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Upload Logo</label>
        <input type="file" id="exampleInputFile" name="logo">
        <p class="help-block">Ukuran maksimal gambar 1mb </p>
        <?php echo $pesanlogo ; ?>
      </div>
    
      <button type="submit" class="btn btn-default" name="kirim">Daftar</button>
   

     


    <!-- end form kiri -->
    </div>


 
</form>
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