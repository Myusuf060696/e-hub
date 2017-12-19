<?php 
include "../koneksi/koneksi.php";
session_start();
if(!isset($_SESSION['admin']))
{
    header("Location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin E-Hub SMK </title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/style7.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery.dataTables.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">E-hub SMK</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Admin</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> Admin<b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                 <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <li>
                        <a href="dasbor.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dasbor</a>
                    </li>
                    <li>
                        <a href="dasbor_sekolah.php" ><i class="fa fa-university fa-fw"></i> Sekolah</a>
                    </li>
                    <li>
                        <a href="dasbor_siswa.php" ><i class="fa fa-graduation-cap fa-fw"></i> Siswa</a>
                    </li>
                    <li>
                        <a href="dasbor_perusahaan.php" ><i class="fa fa-building fa-fw"></i> Perusahaan</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Berita<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="dasbor_berita_sekolah.php">Sekolah</a>
                            </li>
                            <li>
                                <a href="dasbor_berita_perusahaan.php">Perusahaan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="dasbor_lamaran.php" ><i class="fa fa-envelope-o fa-fw"></i> Lamaran</a>
                    </li>
                    <li>
                        <a href="dasbor_undangan.php" ><i class="fa fa-envelope-o fa-fw"></i> Undangan</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Berita Sekolah</h1>

            </div>
                <div class="row">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <!-- Table -->
                  <table id="contoh" class="table" >
                   <thead>
                     <th>No.</th>
                     <th>Judul</th>
                     <th>Tanggal</th>
                     <th>Penerbit</th>
                     <th>Action</th>
                   </thead>
                    <tbody>
                    <?php 
                          $sql = mysqli_query($koneksi, "SELECT * FROM berita_sekolah,sekolah where berita_sekolah.npsnyo=sekolah.npsnyo ");

                          if(mysqli_num_rows($sql)==0)
                          {
                            echo "Tidak ada Prestasi ";
                          }
                          else
                          {
                            $no=1;
                            while($row=mysqli_fetch_assoc($sql))
                            {
                              echo "<tr>
                              <td>".$no.".</td>
                              <td>".$row['judulnyo']."</td>
                              <td>".$row['tanggalnyo']."</td>
                              <td>".$row['namo_sekolah']."</td>
                              <td><a href='siswa_dasbor_undang.php?aksi=delete&id=".$row['ciri_beritanyo']." onclick='return confirm(\'Yakin\')'><button type='button' class='btn btn-default' aria-label='Left Align'>
            <span class='glyphicon   glyphicon-trash' aria-hidden='true'></span>
          </button></a></td>
                              </tr>
                              ";

                              $no++;
                            }
                          }
                         ?>
                </tbody>

                 
          
  </table>
                      </div>

                            
                 </div>                
             <!-- ... Your content goes here ... -->

        </div>
    </div>

</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
 <script src="../js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#contoh').dataTable();
      });
      </script>

</body>
</html>
