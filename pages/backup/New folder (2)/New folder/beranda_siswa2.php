<?php 
  include "../koneksi/koneksi.php";
  
  session_start();

   if(isset($_SESSION['siswa']))
    {
      header("Location: ../index.php");
    }
    $npsnyo = $_SESSION['sekolah'];
    // Ini sintaks untuk query data siswa 
    $kueri = mysqli_query($koneksi, "SELECT * FROM sekolah WHERE npsnyo='$npsnyo' ");
    $data = mysqli_fetch_assoc($kueri);
    $namasekolah = $data['namo_sekolah'];
    $foto = $data['fotonyo_sekolah'];
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
    <link href="../css/style3.css" rel="stylesheet">
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
      <div class="logo"> <a href='index.php'><img src="../images/logo2.png" class="img-responsive" alt="Responsive images"></a></div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
        <!-- Pencarian -->
      <form class="navbar-form navbar-left">
        <div class="input-group">         
            <div class="input-group-btn">
                    <select class="form-control">
                        <option>Sekolah</option>
                        <option>Jurusan</option>
                        <option>Nlai</option>
                        <option>Kota</option>
                        <option>Prestasi</option>
                  </select>
              <input type="text" class="form-control" aria-label="..." placeholder="Cari berdasarkan ...">
              <a class="btn btn-default" href="#" role="button" style="padding: 6px;"><span class="glyphicon  glyphicon glyphicon-search" aria-hidden="true"></span></a>
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
      <div class="container-fluid">
          
             <!--isi yang diubah-->

<div class="row">
    
  <div class="col-xs-12 col-md-12" style="background:#f2f4f7">
    
    <br>
     <div class="alert alert-info">
    Daftar <strong>SISWA</strong> yang telah terdaftar dalam Web <strong>E-Hub SMK</strong>
    </div>


    <?php 

    $batas = 24;
    $pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
     
    if ( empty( $pg ) ) {
    $posisi = 0;
    $pg = 1;
    } else {
    $posisi = ( $pg - 1 ) * $batas;
    }

        $sql = mysqli_query($koneksi,"SELECT * FROM siswa, jurusan,sekolah where siswa.ciri_jurusannyo=jurusan.ciri_jurusannyo and siswa.npsnyo=sekolah.npsnyo limit $posisi, $batas ");
        // SELECT nisnnyo , AVG(nilainyo) as rata_rata FROM nilai GROUP BY nisnnyo 
        if(mysqli_num_rows($sql)==0)
        {
          echo "Tidak Ada Data";
        }
        else{
          $no = 1;
          while ($row = mysqli_fetch_assoc($sql)) {
            echo "
            <div class='thumbnail'>
            <div class='frame-image'>
            <img src='../images/".$row['fotonyo']."'  alt='...'>
            </div>
            <div class='caption'>
              <h4><b>".$row['namonyo']."</b></h4>
              <a href=''><p><b>".$row['namo_jurusannyo']."</b></p></a>
              <a href=''><p>".$row['namo_sekolah']."</p></a>
              <a href=''><p>".$row['tahunlulus']."</p></a>

              <div class='alert alert-info' role='alert'><p>Nilai Rerata UN : <b>".$row['rerata_nilai']."</b></p></div>
              <p><a href='#'' class='btn btn-primary btn-xs' role='button' id='myBtn'><span class='glyphicon glyphicon-eye-open' aria-hidden='true' ></span> Detail</a> </p>
              </div>
            </div>




            ";

          }

        }

        //hitung jumlah data
    $jml_data = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa"));
    //Jumlah halaman
    $JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas

    //Navigasi ke sebelumnya
    if ( $pg > 1 ) {
    $link = $pg-1;
    $prev = "<a href='?pg=$link'>Sebelumnya </a>";
    } else {
    $prev = "Sebelumnya ";
    }
     
    //Navigasi nomor
    $nmr = '';
    for ( $i = 1; $i<= $JmlHalaman; $i++ ){
     
    if ( $i == $pg ) {
    $nmr .= $i . " ";
    } else {
    $nmr .= "<a href='?pg=$i'>$i</a> ";
    }
    }
     
    //Navigasi ke selanjutnya
    if ( $pg < $JmlHalaman ) {
    $link = $pg + 1;
    $next = " <a href='?pg=$link'>Selanjutnya</a>";
    } else {
    $next = " Selanjutnya";
    }

     ?>
     
          
      
 
    
      
    </div>

       <br>
       <div style="text-align: center;"><?php echo $prev . $nmr . $next; ?></div>
       <br><br><br>
 

     

    </div>

<!-- <nav aria-label="..." style="float:center;text-align:center">
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
</nav>  -->
              <!--isi yang diubah-->
         
          
      </div>          
</div>
 
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
        <P>Muhammad Mustajib</P>
        <P>NISN : 554658465</P>
        <P>SMK Syubbanul wathon</P>
           
            </td><td>
            <P>Tahun Lulus  : 2015</P> 
        <P>Jurusan          : Multimedia</P> 
            <p>Tgl lahir    : 14 Nopember 1996</p>
            <p>Gender       : Laki-laki</p>
           <p>Agamar        : islam</p>
            <p>Alamat       : desa tegowanuh kaloran</p> 
           <p>No.Telp       : 54574856459</p>  
           <p>Email         : muhammad@gamil.com</p>
         <td style="padding:10px">
             <h5><b>Nilai</b></h5>
            <p>Bahasa Indonesia     : 90</p>  
            <p>Bahasa Inggris       : 90</p>     
            <p>Bahasa Matematika    : 90</p> 
            <p>Kompetensi           : 90</p> 
            <p>Rerata               : 90</p>  
                <h5><b>Prestasi</b></h5>
            <table class="table">
                 <tr>
                <td>1</td>
                 <td>Lomba LKS lukis</td>
                 </tr>
                 <tr>
                <td>2</td>
                 <td>Lomba Panjat Pinang</td>
                 </tr>
             </table>
        </td>
            </tr></table>
      
        
        
  
    </div>
    <div class="modal-footer">
      <h3></h3>
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
    </script> 
      
 <!-- The Modal -->
<div id="myModal2" class="modal2">

  <!-- Modal content -->
  <div class="modal2-content"><form>
    <div class="modal2-header">
      <span class="close2">×</span>
      <h2>Kirim Undangan</h2>
    </div>
    <div class="modal2-body">
          
    <div class="form-group">
    <label for="exampleInputEmail1">Nama Perusahaan</label>
    <input type="text" class="form-control" id="" placeholder="" required>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Email Perusahaan</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
  </div>
        <div class="form-group">
    <label for="exampleInputEmail1">Email Siswa</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
  </div>
        <label for="alamat">Isi Undangan</label>
    <textarea class="form-control" rows="3" id="" placeholder="" required></textarea>
  <br>
    </div>
    <div class="modal2-footer">
      <h3><button  type="submit" class="btn btn-default btn-md"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim</button> </h3>
    </div></form>
  </div>

</div>
<script>
// Get the modal
var modal2 = document.getElementById('myModal2');

// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event2) {
    if (event2.target == modal2) {
        modal2.style.display = "none";
    }
}
    </script>     
      

      
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
  </body>
</html>