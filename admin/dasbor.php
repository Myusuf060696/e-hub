<?php 
include "../koneksi/koneksi.php";
session_start();
if(!isset($_SESSION['admin']))
{
    header("Location:../index.php");
}

$querysekolah = mysqli_query($koneksi,"SELECT * FROM sekolah");
$countsekolah = mysqli_num_rows($querysekolah);

$querysiswa = mysqli_query($koneksi,"SELECT * FROM siswa");
$countsiswa = mysqli_num_rows($querysiswa);

$queryperusahaan = mysqli_query($koneksi,"SELECT * FROM perusahaan");
$countperusahaan = mysqli_num_rows($queryperusahaan);

$queryberita_sekolah = mysqli_query($koneksi,"SELECT * FROM berita_sekolah");
$countberita_sekolah = mysqli_num_rows($queryberita_sekolah);

$queryberita_perusahaan = mysqli_query($koneksi,"SELECT * FROM berita_perusahaan");
$countberita_perusahaan = mysqli_num_rows($queryberita_perusahaan);

$querylamaran = mysqli_query($koneksi,"SELECT * FROM lamaran");
$countlamaran = mysqli_num_rows($querylamaran);

$queryundangan = mysqli_query($koneksi,"SELECT * FROM undangan");
$countundangan = mysqli_num_rows($queryundangan);



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
                    <h1 class="page-header">Dasbor</h1>

            </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-university fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countsekolah ?></div>
                                        <div>Sekolah terdaftar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_sekolah.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-graduation-cap  fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countsiswa; ?></div>
                                        <div>Siswa terdaftar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_siswa.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa fa-building fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countperusahaan; ?></div>
                                        <div>Perusahaan terdaftar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_perusahaan.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-newspaper-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countberita_sekolah; ?></div>
                                        <div>Berita Sekolah</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_berita_sekolah.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-newspaper-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countberita_perusahaan; ?></div>
                                        <div>Berita Perusahaan</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_berita_perusahaan.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countlamaran; ?></div>
                                        <div>Lamaran Masuk</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_lamaran.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $countundangan; ?></div>
                                        <div>Undangan Masuk</div>
                                    </div>
                                </div>
                            </div>
                            <a href="dasbor_undangan.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Detail</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>                      
                </div>

                            <!-- /.panel-body -->
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

</body>
</html>
