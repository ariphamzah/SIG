<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>

  <!-- PETA -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <style>
      #map {
        height: 600px;
        width: 100%;
      }
   </style>
  <!-- END PETA -->

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?= base_url('Dashboard') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SIG</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Sistem Informasi Geografis</b></span>
        </a>

      <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="pull-right" style="margin:10px">
            <a href="<?= base_url('admin/sigout'); ?>" class="btn btn-default"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign in</a>
        </div>  
    </nav>

    </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- search form -->
         

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active">
            <a href="<?= base_url('Dashboard') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                </span>
            </a>
            </li>
            <li class="header">PENGADUAN</li>

            <li>
            <a href="<?= base_url('Dashboard/form_baru') ?>">
                <i class="fa fa-edit"></i> <span>Form Pengaduan Baru</span>
                <span class="pull-right-container">
                </span>
            </a>
            </li>

            <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Tabel Pengaduan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?= base_url('Dashboard/baru') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Baru</a></li>
                <li><a href="<?= base_url('Dashboard/proses') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Proses</a></li>
                <li><a href="<?= base_url('Dashboard/selesai') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Selesai</a></li>
                <li><a href="<?= base_url('Dashboard/ditolak') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Ditolak</a></li> 
            </ul>
          </li>
            <li class="treeview">
                <a href="<?= base_url('Dashboard/report') ?>">
                <i class="fa fa-edit"></i> <span>Report</span>
                <span class="pull-right-container"></span>
                </a>                                           
            </li>
            <li>
            <li class="header">LABELS</li>
            <li>
            <a href="<?php echo base_url('Dashboard/profile') ?>">
                <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
            </li>
          <li>
            <a href="<?php echo base_url('Dashboard/users') ?>">
              <i class="fa fa-fw fa-users" aria-hidden="true"></i> <span>Users</span></a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div style="margin-bottom:40px">
            <center>
              <h4><b>Sistem Informasi Geografis Kerusakan Jalan</b></h4>
            </center>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <?php if (!empty($pengaduan_baru)) { ?>
                  <?php foreach ($pengaduan_baru as $d) { ?>
                    <h3><?= $d->total ?></h3>
                  <?php } ?>
                <?php } else { ?>
                  <h3>0</h3>
                <?php } ?>
                <p>Pengaduan Baru</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('Dashboard/baru') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
              <?php if (!empty($pengaduan_selesai)) { ?>
                  <?php foreach ($pengaduan_selesai as $d) { ?>
                    <h3><?= $d->total ?></h3>
                  <?php } ?>
                <?php } else { ?>
                  <h3>0</h3>
                <?php } ?>
                <p>Pengaduan Selesai</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('Dashboard/selesai') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <?php if (!empty($pengaduan_proses)) { ?>
                  <?php foreach ($pengaduan_proses as $d) { ?>
                    <h3><?= $d->total ?></h3>
                  <?php } ?>
                <?php } else { ?>
                  <h3>0</h3>
                <?php } ?>
                <p>Pengaduan Proses</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('Dashboard/proses') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
              <?php if (!empty($pengaduan_ditolak)) { ?>
                  <?php foreach ($pengaduan_ditolak as $d) { ?>
                    <h3><?= $d->total ?></h3>
                  <?php } ?>
                <?php } else { ?>
                  <h3>0</h3>
                <?php } ?>
                <p>Pengaduan Ditolak</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('Dashboard/ditolak') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>


        <div >
          <?php
              // Koneksi ke database
              $host = 'localhost';
              $dbname = 'sig';
              $username = 'root';
              $password = '';

              try {
                  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  // Query untuk mengambil data koordinat
                  $stmt = $pdo->prepare("SELECT latitude, longitude FROM kerusakan_jalan");
                  $stmt->execute();
                  $coordinates = $stmt->fetchAll(PDO::FETCH_ASSOC);

              } catch (PDOException $e) {
                  echo "Koneksi gagal: " . $e->getMessage();
                  die();
              }
          ?>

          <span>PETA</span>
            <!-- MAP -->
              <div id="map"></div>
              <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
               <script>
              // Inisialisasi peta
              var map = L.map('map').setView([-6.921843, 107.606935], 14);

              // Tambahkan layer tile ke peta
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);

              // Data koordinat dari PHP (ambil sebagai JSON)
              var coordinates = <?php echo json_encode($coordinates); ?>;

              // Tambahkan marker dan polyline untuk outline
              var latlngs = [];
              coordinates.forEach(function(coord) {
                  var latlng = [parseFloat(coord.latitude), parseFloat(coord.longitude)];
                  latlngs.push(latlng);
                  L.marker(latlng).addTo(map);
              });

        // Tambahkan outline dengan polyline
        // var outline = L.polyline(latlngs, { color: 'blue', weight: 10 }).addTo(map);

        // Atur agar peta menyesuaikan dengan outline
        map.fitBounds(outline.getBounds());
    </script>
          </div>
      </section>
    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Sistem Informasi Geografis</b>
      </div>
      <strong>Copyright &copy; <?= date('Y') ?></strong>
    </footer>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url() ?>assets/web_admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url() ?>assets/web_admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>
</body>

</html>