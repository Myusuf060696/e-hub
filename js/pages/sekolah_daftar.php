<!-- ACTION  -->
<!-- untuk form kota provinsi coy, ini assetnya -->
<?php 
//include "../koneksi/koneksi_lokasi.php";
?>
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
  if(isset($_POST['kirim']))
  {
      $kodeta = $_POST['kota'];
      $kodetas = substr($kodeta,0,2);
      $kodeprov= substr($kodeta,-2);
  
      $query = mysqli_query($koneksi, "SELECT * FROM lokasi WHERE  lokasi_propinsinyo=$kodeprov and lokasi_kabupatenkota=$kodetas and lokasi_kecamatannyo=0 and lokasi_kelurahannyo=0");
      while($data = mysqli_fetch_array($query)){
        $yainikotanya=  $data["lokasi_namo"]; 
      }
  }
 ?>
 <?php 
  if(isset($_POST['kirim']))
  {
    $npsn = $_POST['npsn'];
    $nama = $_POST['nama_sekolah'];
    $alamat = $_POST['alamat'];
    $website = $_POST['website'];
    $email = $_POST['email'];
    $telp = $_POST['no_hp'];
    $kota = $yainikotanya;
    $logo = $_FILES['logo']['name'];
    $foto = $_FILES['foto']['name'];
    ?>
    <?php 
      // $ekstensi_diperbolehkan = array('png','jpg','JPG','jpeg');
      // $namalogo = $_FILES['logo']['name'];
      // $x = explode('.', $namalogo);
      // $ekstensi = strtolower(end($x));
      // $ukuran = $_FILES['logo']['size'];
      // $file_tmp = $_FILES['logo']['tmp_name'];  
      //   if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      //       if($ukuran < 100044070){      
      //     move_uploaded_file($file_tmp, '../images/'.$namalogo);
      //       }else{
      //            $pesanlogo = 'UKURAN FILE LOGO TERLALU BESAR';
      //       }
      //   }else{
      //     $pesanlogo = 'EKSTENSI FILE LOGO YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
      //   }
          $namalogo = $_FILES["logo"]["name"];
          $file_basename = substr($namalogo, 0, strripos($namalogo, '.')); // get file extention
          $file_ext = substr($namalogo, strripos($namalogo, '.')); // get file name
          $filesize = $_FILES["logo"]["size"];
          $allowed_file_types = array('.png','.jpg','.JPG','.jpeg');  

          if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
          { 
            // Rename file
            $newnamalogo = "$npsn"."_"."$namalogo" ;
            // . $file_ext
            if (file_exists("../images/" . $newnamalogo))
            {
              // file already exists error
              $pesanlogo =  "";
            }
            else
            {   
              move_uploaded_file($_FILES["logo"]["tmp_name"], "../images/" . $newnamalogo);
              echo "File uploaded successfully.";   
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
    $cek = mysqli_query($koneksi,"SELECT * FROM sekolah WHERE npsnyo='$npsn'");
    if(mysqli_num_rows($cek)==0)
    {
      $insert = mysqli_query($koneksi, "INSERT INTO sekolah (npsnyo, namo_sekolah, alamatnyo_sekolah, emailnyo_sekolah, websitenyo,   nomer_hp_sekolah, katorahasio_sekolah, logonyo_sekolah,  kotanyo_sekolah) values ('$npsn','$nama','$alamat','$email','$website','$telp','$password','$newnamalogo','$kota')") or die (mysqli_error());
      if($insert)
      {
        $pesan = "<div class='alert alert-success'><strong>Pendaftaran Berhasil!</strong> Password Sekolah : <strong>$password</strong>, Silahkan 
        <a href='sekolah_masuk.php' class='alert-link'> Klik Disini untuk Login </a></div>";
        
      }
    }
    else
    {
      $pesan = " <div class='alert alert-danger'><strong>NPSN SUDAH TERDAFTAR</strong></div>";
     
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
    
  <body >

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="row">
          <div class="info">    
              <a href="#"><button type="button" class="btn btn-default btn-sm">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Petunjuk Teknis</button></a>
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
        <li><a href="sekolah_pilihan.php">Sekolah</a></li>
        <li class="active">Daftar</li>
    </ol>             
  <?php 
    echo $pesan;
    echo $pesanlogo;
    echo $pesanfoto;
   ?>
  <h4>Formulir Pendaftaran Sekolah</h4>
  <p> Lengkapi data Sekolah yang ingin Anda daftarkan</p>       
          
<div class="row">
<form method="post" enctype="multipart/form-data">
  <div class="col-md-4">

    <div class="form-group">
      <label for="NPSN">NPSN</label>
      <input type="text" class="form-control" id="NPSN" placeholder="Nomor Pokok Sekolah Nasional" required name="npsn">
    </div>
    <div class="form-group">
      <label for="nama">Nama Sekolah</label>
      <input type="text" class="form-control" id="nama_sekolah" placeholder="Nama sekolah" required name="nama_sekolah">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat Sekolah</label>
      <textarea class="form-control" rows="3" id="Alamat" placeholder="Alamat Sekolah" required name="alamat"></textarea>
    </div>
    <div class="form-group">
      <label for="nama">Website Sekolah</label>
      <input type="text" class="form-control" id="nama_sekolah" placeholder="Nama sekolah" required name="website">
    </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email Sekolah</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required name="email">
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">No.telp Sekolah </label>
          <input type="number" class="form-control" id="notelp" placeholder="No.telp" required name="no_hp">
      </div>
    <div class="form-group">
        <label for="exampleInputFile">Upload Logo</label>
        <input type="file" id="exampleInputFile" name="logo">
        <p class="help-block"> <i>Ukuran Maksimal Gambar 5Mb </i></p>
      </div>


     


    <!-- end form kiri -->
    </div>


    <div class="col-md-4"> 
      <div class="form-group">
       <label for="provinsi">Provinsi</label>
       <select class="form-control" name="prop" id="prop" onchange="ajaxkota(this.value)">
          <option value="">Pilih Provinsi</option>
          <?php 
          $queryProvinsi=mysqli_query($koneksi, "SELECT * FROM lokasi where lokasi_kabupatenkota=0 and lokasi_kecamatannyo=0 and lokasi_kelurahannyo=0 order by lokasi_namo");
          while ($dataProvinsi=mysqli_fetch_array($queryProvinsi)){
            echo '<option value="'.$dataProvinsi['lokasi_propinsinyo'].'">'.$dataProvinsi['lokasi_namo'].'</option>';
          }
          ?>
        <select>
    </div>
    <div class="form-group">
       <label for="kota">Kota</label>
       <select class="form-control" name="kota" id="kota" onchange="ajaxkec(this.value)">
          <option value="">Pilih Kota</option>
      </select>
    </div>
    <div class="form-group">
       <label for="kota">Pilih Kecamatan</label>
       <select class="form-control" name="kec" id="kec" onchange="ajaxkel(this.value)">
          <option value="">Pilih Kecamatan</option>
      </select>
    </div>
    <div class="form-group">
       <label for="kota">Pilih Kelurahan</label>
       <select class="form-control" name="kel" id="kel">
          <option value="">Pilih Kelurahan/Desa</option>
      </select>
    </div>
 <!--      <div class="form-group">
        <label for="exampleInputPassword1">Buat Sandi</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Konfirmasi Sandi</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
      </div> -->
      <button type="submit" class="btn btn-default" name="kirim">Daftar</button>
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