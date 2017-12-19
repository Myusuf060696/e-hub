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
  $foto = $data['fotonyo_sekolah'];
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>Document</title>
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <style>
      *{
        font-size: 10px;
      }
    </style>
 </head>
 <body>
   <table class="table" id="contoh">
   <thead>
   <tr>
      <th>No.</th>
       <th>NISN</th>
      <th>Nama</th>
       <th>Jenis Kelamin</th>
       <th>Tgl Lahir</th>
       <th>Alamat</th>
       <th>Email</th>
       <th>No.telp</th>
       <th>Jurusan</th>
       <th>Prestasi</th>
       <th>Prestasi</th>
       <th>Prestasi</th>
       <th>Prestasi</th>
    </tr>
    </thead>
    <tbody>
      <?php 
        $sql = mysqli_query($koneksi,"SELECT * FROM siswa, jurusan where siswa.ciri_jurusannyo=jurusan.ciri_jurusannyo ORDER BY nisnnyo ASC");
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
            <td>".$row['tanggal_lahirnyo']."</td>
            <td>".$row['agamanyo']."</td>
            <td>".$row['alamatnyo']."</td>
            <td>".$row['emailnyo']."</td>
            <td>".$row['nohpnyo']."</td>
            <td>".$row['namo_jurusannyo']."</td>
            <td>".$row['tahunlulus']."</td>
            <td>".$row['katorahasio']."</td>
            <td>
            <a href='index.php?aksi=delete&nisn=".$row['nisnnyo']."' onclick='return confirm(\"Yakin\")'>HapusSiswa - </a>
            <a href='profilsiswa.php?nisn=".$row['nisnnyo']."'>ProfilSiswa - </a>
            <a href='edit.php?nisn=".$row['nisnnyo']."'>EditSiswa - </a>
            <a href='editpassword.php?nisn=".$row['nisnnyo']."'>Editpassword - </a>
            <a href='fotoprofilsiswa.php?nisn=".$row['nisnnyo']."'>EditfotoProfil</a>

            </td>
            ";
            $no++;
          }

        }


         ?>
         </tbody>
  </table>

  

  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#contoh').dataTable();
      });
    </script>
 </body>
 </html>

 