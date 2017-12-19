<?php 
  include "../koneksi/koneksi.php";
  include "../koneksi/random.php";
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
 ?>
 <!-- Fungsi Menghapus -->
      <?php
      if(isset($_GET['aksi']) == 'delete'){
        $id = $_GET['id'];
        $cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisnnyo='$id'");
        if(mysqli_num_rows($cek) == 0){
          echo "<script>alert('Data Tidak Ditemukan');history.go(-1);</script>";
        }else{
          $delete = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisnnyo='$id'");
          if($delete){
            echo "<script>alert('Data Berhasil di Hapus');history.go(-1);</script>";
          }else{
             echo "<script>alert('Data Tidak Berhasil di Hapus');history.go(-1);</script>";
          }
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
  
  <link href="../css/style2.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/jquery.dataTables.css">
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
    
  <body >
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
      <a href="sekolah_dasbor.php" class="list-group-item ">Edit profil sekolah</a>
      <a href="sekolah_dasbor_input.php" class="list-group-item">Daftarkan siswa</a>
      <a href="sekolah_dasbor_siswa.php" class="list-group-item active">Semua siswa</a>
      <a href="sekolah_dasbor_post.php" class="list-group-item">Posting berita</a>
      <a href="sekolah_dasbor_berita.php" class="list-group-item">Semua berita</a>
</div>
      
        </div>
        
    </div>
   <div class="col-md-9">
<div class="kanan" >
 <div class="row">
  <div class="col-lg-4">
    <!-- <div class="input-group" style="margin:5px">
      <input type="text" class="form-control" placeholder="Cari Siswa">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Cari</button>
      </span>
    </div> -->
     
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->                       
<div class="panel panel-default"> 
  <!-- Default panel contents -->
  <div class="panel-heading">Semua Siswa</div>

  <!-- Table -->
  <div style="padding: 10px;">
  <table class="table" id="contoh" >
   <thead>
   <tr>
      <th>No.</th>
       <th>NISN</th>
      <th>Nama</th>
       <th>Jenis Kelamin</th>
       <th>No.telp</th>
       <th>Jurusan</th>
       <th>Password</th>
       <th>Setting</th>
    </tr>
    </thead>
    <tbody>
      <?php 
        $sql = mysqli_query($koneksi,"SELECT * FROM siswa, jurusan where siswa.ciri_jurusannyo=jurusan.ciri_jurusannyo and npsnyo='$npsnyo' ORDER BY nisnnyo ASC");
        if(mysqli_num_rows($sql)==0)
        {
          echo "Tidak Ada Data";
        }
        else{
          $no = 1;
          while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
            <td>".$no."</td>
            <td>".$row['nisnnyo']."</td>
            <td>".$row['namonyo']."</td>
            <td>".$row['lanang_betino']."</td>
            <td>".$row['nohpnyo']."</td>
            <td>".$row['namo_jurusannyo']."</td>
            <td>".$row['katorahasio']."</td>
            <td><a href='sekolah_dasbor_siswa.php?aksi=delete&id=".$row['nisnnyo']."'><button type='button' class='btn btn-default' aria-label='Left Align'>
            <span class='glyphicon   glyphicon-trash' aria-hidden='true'></span>
          </button></a></td>
            ";
            $no++;
          }

        }


         ?>
         </tbody>
  </table>
  </div>

           <!--  <a href='index.php?aksi=delete&nisn=".$row['nisnnyo']."' onclick='return confirm(\"Yakin\")'>HapusSiswa - </a>
            <a href='profilsiswa.php?nisn=".$row['nisnnyo']."'>ProfilSiswa - </a>
            <a href='edit.php?nisn=".$row['nisnnyo']."'>EditSiswa - </a>
            <a href='editpassword.php?nisn=".$row['nisnnyo']."'>Editpassword - </a>
            <a href='fotoprofilsiswa.php?nisn=".$row['nisnnyo']."'>EditfotoProfil</a> -->
<!--   
       <button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
</button> -->
</div>
       
                   </div>  
                   

</div>          
              
        
              <!--isi yang diubah-->
         
          
          </div>    </div>      

 <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content"><form>
    <div class="modal-header">
      <span class="close">×</span>
      <h2>Detail Siswa</h2>
    </div>
    <div class="modal-body">
        
        <table><tr ><td style="padding:10px"><img style="width:200px" src="../images/user.png" alt="..." class="img-thumbnail">
        <input type="number" class="form-control" id="NPSN" placeholder="Nomor Induk Siswa Nasional" value="587582585" required>
        <input type="text" class="form-control" id="" placeholder="Nama Siswa" value="Muhammad Mustajib" required></td>
            
            <td><label for="exampleInputFile">Tgl Lahir</label>
                <input type="date" class="form-control" id="" placeholder="Tgl Lahir" value="14 nopember 1996">
                <label for="exampleInputFile">Alamat</label>
        <input type="text" class="form-control" id="" placeholder="Alamat" value="Temanggung">
         <label for="exampleInputFile">Jurusan</label>       
        <label for="">Jurusan</label>     
    <select class="form-control" required>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
                <label for="exampleInputFile">Email</label>
        <input type="email" class="form-control" id="" placeholder="Email" value="musttajibz14@gamil.com">
         <label for="exampleInputFile">Password</label>       
        <input type="text" class="form-control" id="" placeholder="Password" value="d2efgdjfgu" required>
            </td>
            <td style="padding:10px">
                <h5><b>Nilai Siswa</b></h5>
            <label for="exampleInputFile">Bahasa Indonesia</label>       
        <input type="nilai" class="form-control" id="" placeholder="Nilai" value="79" required>
            <label for="exampleInputFile">Matematika</label>       
        <input type="text" class="form-control" id="" placeholder="" value="70" required>
            <label for="exampleInputFile">Bahasa Inggris</label>       
        <input type="text" class="form-control" id="" placeholder="" value="80" required>
            <label for="exampleInputFile">Keahlian</label>       
        <input type="text" class="form-control" id="" placeholder="" value="90" required></td>
            </tr></table>
      
        
        
  
    </div>
    <div class="modal-footer">
      <h3><button  type="submit" class="btn btn-primary btn-md">Update</button> </h3>
    </div></form>
  </div>

</div>

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
    </script>  </div>   
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
    <script src="../js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#contoh').dataTable();
      });
    </script>
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