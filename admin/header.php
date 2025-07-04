<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard Admin - Toko Bincy Jaya Abadi </title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <style>
  /* -- Tetap warna NAVBAR atas oranye -- */
  .skin-custom .main-header {
    background-color: #f8593b !important;
  }
  .skin-custom .main-header .logo {
    background-color: #e74c3c !important;
    color: #ffffff !important;
  }
  .skin-custom .main-header .navbar {
    background-color: #f8593b !important;
  }
  .skin-custom .main-header .sidebar-toggle,
  .skin-custom .main-header .navbar-custom-menu > .nav > li > a {
    color: #ffffff !important;
  }
  .skin-custom .main-header .navbar-custom-menu > .nav > li > a:hover {
    background-color: #f1462c !important;
  }

  /* -- Kembalikan warna SIDEBAR seperti skin-blue -- */
  .skin-custom .main-sidebar {
    background-color: #222d32 !important;
  }

  .skin-custom .main-sidebar .user-panel > .info,
  .skin-custom .sidebar a {
    color: #b8c7ce !important;
  }

  .skin-custom .sidebar-menu > li > a {
    border-left: 3px solid transparent;
  }

  .skin-custom .sidebar-menu > li:hover > a,
  .skin-custom .sidebar-menu > li.active > a {
    color: #ffffff !important;
    background: #1e282c !important;
    border-left-color: #f8593b !important;
  }

  .skin-custom .sidebar-menu .treeview-menu > li > a {
    color: #8aa4af !important;
  }

  .skin-custom .sidebar-menu .treeview-menu > li.active > a,
  .skin-custom .sidebar-menu .treeview-menu > li > a:hover {
    color: #ffffff !important;
  }
  .skin-custom .main-footer {
    background-color: #263238 !important; /* warna seperti footer customer */
    color: #fff !important;
    border-top: none;
  }

  .skin-custom .main-footer a {
    color: #f1f1f1 !important;
  }
</style>

  <?php 
  include '../koneksi.php';
  session_start();
  if($_SESSION['status'] != "login"){
    header("location:../login.php?alert=belum_login");
  }
  ?>

</head>
<body class="hold-transition skin-custom sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <span class="logo-mini"><b>BINCY</b>KU </span>
        <span class="logo-lg"><b>BINCY</b>KU</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php 
                $id_admin = $_SESSION['id'];
                $profil = mysqli_query($koneksi,"select * from admin where admin_id='$id_admin'");
                $profil = mysqli_fetch_assoc($profil);
                if($profil['admin_foto'] == ""){ 
                  ?>
                  <img src="../gambar/sistem/user.png" class="user-image">
                <?php }else{ ?>
                  <img src="../gambar/user/<?php echo $profil['admin_foto'] ?>" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - Admin</span>
              </a>
            </li>
            <li>
              <a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php 
            $id = $_SESSION['id'];
            $profil = mysqli_query($koneksi,"select * from admin where admin_id='$id'");
            $profil = mysqli_fetch_assoc($profil);
            if($profil['admin_foto'] == ""){ 
              ?>
              <img src="../gambar/sistem/user.png" class="img-circle">
            <?php }else{ ?>
              <img src="../gambar/user/<?php echo $profil['admin_foto'] ?>" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li> 
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
          </li>

          <li>
            <a href="kategori.php">
              <i class="fa fa-folder"></i> <span>DATA KATEGORI</span>
            </a>
          </li>

          <li>
            <a href="produk.php">
              <i class="fa fa-gift"></i> <span>DATA PRODUK</span>
            </a>
          </li>

          <li>
            <a href="customer.php">
              <i class="fa fa-users"></i> <span>DATA CUSTOMER</span>
            </a>
          </li>

           <li>
            <a href="transaksi.php">
              <i class="fa fa-retweet"></i> <span>TRANSAKSI / PESANAN</span>
            </a>
          </li>

          <li>
            <a href="laporan.php">
              <i class="fa fa-file"></i> <span>LAPORAN PENJUALAN</span>
            </a>
          </li> 

          <li>
            <a href="admin.php">
              <i class="fa fa-user"></i> <span>DATA ADMIN</span>
            </a>
          </li>

          <li>
            <a href="gantipassword.php">
              <i class="fa fa-lock"></i> <span>GANTI PASSWORD</span>
            </a>
          </li>

          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
            </a>
          </li>
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
