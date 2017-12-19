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
  // BEDA SESI 
  // INI UNTUK INPUT SISWA
  $pesanfoto =" ";
  $pesan = " ";
  if(isset($_POST['submit'])){

		$nisnnyo = $_POST['nisnnyo'];
		$namonyo = $_POST['namonyo'];
		$lanang_betino = $_POST['lanang_betino'];
		$tanggal_lahirnyo = $_POST['tanggal_lahirnyo'];
		$agamanyo = $_POST['agamanyo'];
		$alamatnyo = $_POST['alamatnyo'];
		$emailnyo = $_POST['emailnyo'];
		$nohpnyo = $_POST['nohpnyo'];
		$ciri_jurusannyo=$_POST['ciri_jurusannyo'];
		$tahunlulus = $_POST['tahunlulus'];
		$matematika = $_POST['matematika'];
		$b_indo = $_POST['b_indo'];
		$b_inggris = $_POST['b_inggris'];
		$kompten = $_POST['kompten'];
    $rerata_nilai = ($b_indo + $b_inggris + $kompten + $matematika )/4;
		
		
          $namafoto = $_FILES["fotonyo"]["name"];
          $file_basename = substr($namafoto, 0, strripos($namafoto, '.')); // get file extention
          $file_ext = substr($namafoto, strripos($namafoto, '.')); // get file name
          $filesize = $_FILES["fotonyo"]["size"];
          $allowed_file_types = array('.png','.jpg','.JPG','.jpeg');  

          if (in_array($file_ext,$allowed_file_types) && ($filesize < 2000000))
          { 
            // Rename file
            $newnamafoto = "$nisnnyo"."_"."$namafoto" ;
            // . $file_ext
            if (file_exists("../images/" . $newnamafoto))
            {
              // file already exists error
              $pesanfoto =  "You have already uploaded this file.";
            }
            else
            {   
              move_uploaded_file($_FILES["fotonyo"]["tmp_name"], "../images/" . $newnamafoto);
              
            }
            }
            elseif (empty($file_basename))
            { 
              
               $pesan =  " <div class='alert alert-danger'> <strong>Please, Upload Fotonya</strong></div>" ;
            } 
            elseif ($filesize > 200000)
            { 
            
              $pesanfoto =  "The file you are trying to upload is too large.";
            }
            else
            {
           
              $pesanfoto =  "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
              unlink($_FILES["fotonyo"]["tmp_name"]);
            }


		$cek = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nisnnyo='$nisnnyo'" );
		if(mysqli_num_rows($cek)==0){
			$insertsatu = mysqli_query($koneksi, "INSERT INTO siswa (nisnnyo, namonyo, lanang_betino, tanggal_lahirnyo, agamanyo, alamatnyo, emailnyo, nohpnyo, ciri_jurusannyo, tahunlulus, katorahasio,fotonyo,npsnyo,rerata_nilai) values('$nisnnyo','$namonyo','$lanang_betino','$tanggal_lahirnyo','$agamanyo','$alamatnyo','$emailnyo','$nohpnyo','$ciri_jurusannyo','$tahunlulus','$password','$newnamafoto','$npsnyo','$rerata_nilai')" ) or die (mysqli_error());
			if($insertsatu){
				$insertdua = mysqli_query($koneksi, "INSERT INTO nilai (nilainyo,ciri_mapelnyo,nisnnyo) values 
					('$matematika','matematika','$nisnnyo'),
					('$b_indo','bahasa_indo','$nisnnyo'),
					('$b_inggris','bahasa_inggris','$nisnnyo'),
					('$kompten','komp_keahlian','$nisnnyo')") or die (mysqli_error());
				if($insertdua){
					$pesan =  " <div class='alert alert-success'> <strong>Pendaftaran Berhasil!</strong> Password Siswa :  <b>$password </b> </div>" ;
          
				}
			}
		}else{
      $pesan =  " <div class='alert alert-danger'> <strong>NISN Sudah Terdaftar</strong></div>" ;
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

<!--atas-->
  
<div class="kotak-bawah">
      <div class="container-fluid">
             <!--isi yang diubah-->
               <div class="row">
                  <div class="col-md-3">
                      <div class="kiri"><div class="list-group-item active"><h4>Dasboard Sekolah</h4></div></div>
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
                            <a href="sekolah_dasbor_input.php" class="list-group-item active">Daftarkan siswa</a>
                            <a href="sekolah_dasbor_siswa.php" class="list-group-item">Semua siswa</a>
                            <a href="sekolah_dasbor_post.php" class="list-group-item">Posting berita</a>
                            <a href="sekolah_dasbor_berita.php" class="list-group-item">Semua berita</a>

                          </div>
                      </div>
                  </div>

   <div class="col-md-9">
        <div class="kanan"style="max-width: 750px;" >


    <div class="isi">
    <div class="panel panel-default" >
       <!-- Default panel contents -->
      <div class="panel-heading"><h4><b>INPUT DATA SISWA</b></h4></div>
      	<?php echo $pesan; ?>
      	<div class="panel-body">

      	<!-- Start Form Ndan -->
         <form method="post" enctype="multipart/form-data">
				<div class="form-group">
				   <label for="NPSN">NISN</label>
				   <input type="number" class="form-control" id="NPSN" placeholder="Nomor Induk Siswa Nasional" required name="nisnnyo">
				</div>
			    <div class="form-group">
				    <label for="nama">Nama Siswa</label>
				    <input type="text" class="form-control" id="nama_sekolah" placeholder="Nama siswa" required name="namonyo">
			  	</div>
             
             	<label for="nama">Jenis Kelamin</label>
				<div class="radio">
					  <label><input type="radio" name="lanang_betino" id="optionsRadios1" value="Laki-laki" checked>Laki-laki</label>
				</div>
				<div class="radio">
				  <label><input type="radio" name="lanang_betino" id="optionsRadios2" value="Perempuan">Perempuan</label>
				</div>
	             <div class="form-group">
	                <label for="nama">Tgl lahir</label>
	    			<input type="date" class="form-control" id="" placeholder="tanggal lahir" name="tanggal_lahirnyo" required>
	  			</div>
	      		<div class="form-group">
				    <label for="nama">Agama</label>
            <select name="agamanyo" id="" class="form-control" required>
              <option value="Islam">Pilih Agama</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Budha">Budha</option>
              <option value="Hindu">Hindu</option>
            </select>
				    
	  			</div>
	    		<div class="form-group">
				    <label for="alamat">Alamat Siswa</label>
				    <textarea class="form-control" id="Alamat" placeholder="Alamat Siswa" name="alamatnyo" required></textarea>
	  			</div>
    			<label for="">Jurusan</label>     
		    	<select class="form-control" name="ciri_jurusannyo">
					<?php
						$j=mysqli_query($koneksi,"select * from jurusan");
						while($k=mysqli_fetch_array($j)){
						echo "<option value='$k[ciri_jurusannyo]'>$k[namo_jurusannyo]</option>";
						}
					?>
		    	</select>

             	<div class="form-group">
				    <label for="">No.HP</label>
				    <input type="number" class="form-control" id="notelp" placeholder="No.telp" name="nohpnyo">
  				</div>
	    		<div class="form-group">
				    <label for="exampleInputEmail1">Email Siswa</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="emailnyo">
	  			</div>
	  			<div class="form-group">
				    <label for="exampleInputEmail1">Tahun Lulus</label>
				    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Tahun Lulus" name="tahunlulus">
	  			</div>
			  <div class="form-group">
			    <label for="exampleInputFile">Upload Foto</label>
			    <input type="file" id="exampleInputFile" name="fotonyo">
			    <p class="help-block">Ukuran maksimal gambar 1mb </p>
			    <?php echo $pesanfoto; ?>
			  </div>
  	
  	<!-- End Panel -->
     </div>
     </div>

         <div class="panel panel-default">
			  <!-- Default panel contents -->
			  <div class="panel-heading" ><h4><b>INPUT NILAI SISWA</b></h4></div>
			  <div class="panel-body">
				
					<div class="form-group">
					    <label for="matematika">Matematika</label>
					    <input type="number" class="form-control" id="matematika" placeholder="Nilai Matematika" required name="matematika">
				  	</div>	
				  	<div class="form-group">
					    <label for="b_indo">Bahasa Indonesia</label>
					    <input type="number" class="form-control" id="b_indo" placeholder="Nilai Bahasa Indonesia" required name="b_indo">
				  	</div>
				  	<div class="form-group">
					    <label for="b_inggris">Bahasa Inggris</label>
					    <input type="number" class="form-control" id="b_inggris" placeholder="Nilai Bahasa Inggris" required name="b_inggris">
				  	</div>
				  	<div class="form-group">
					    <label for="kompten">Kompetensi Keahlian</label>
					    <input type="number" class="form-control" id="kompten" placeholder="Nilai Kompetensi Keahlian" required name="kompten">
				  	</div>
					
			 
			 </div>
		</div>

		<button  type="submit" class="btn btn-primary btn-small" name="submit">Kirim</button>

   	</form>
   		</div>
</div>
</div>
</div>
</div>  
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
      
      </div>
      </div>
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