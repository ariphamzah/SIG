<?php
	$nama_jalan = '';
	$latitude1 = '';
	$longitude1 = '';
  $latitude2 = '';
	$longitude2 = '';
	$jenis_kerusakan = '';
	$tingkat_kerusakan = '';
	$flag = 0;
  $link = base_url('dashboard/proses_pengaduan_baru');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>

  <!-- PETA -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
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
      <nav class="navbar navbar-static-top" style="margin-left:0">

        <div class="pull-right" style="margin:10px">
            <a href="<?= base_url('Auth/login'); ?>" class="btn btn-default">
                <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In
            </a>
        </div>

      </nav>

    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left:0">
      
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Form Pengaduan Baru
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?=base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Form Pengaduan Baru</li>
        </ol>
      </section>
      

      <!-- Main content -->
      <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="container">
            <!-- general form elements -->
            <div class="box box-primary" style="width:94%;">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i><?= ($flag == 0 )?' Tambah':' Edit' ?> Form Pengaduan Baru</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <div class="container">
                <form action="<?= $link ?>" role="form" method="post">

                 <?php if (validation_errors()) { ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                    </div>
                  <?php } ?>

                  <div class="box-body">
                    <div class="form-group">
                      <label for="nama_jalan" style="margin-right:101px;">Nama Jalan</label>
                      <input type="text" name="nama_jalan" style="width:60%;display:inline;" class="form-control responsive" placeholder="Nama Jalan" value="<?= $nama_jalan ?>">
                    </div>
                    <div>
                    <label for="lokasi" style="margin-right:101px;margin-bottom:18px;">Lokasi</label>
                      <div id="map" style="width:76%;height:380px;margin-bottom:20px;"></div>
                      
                      <!-- Input untuk koordinat lokasi 1 -->
                      <input type="text" id="lat1" name="latitude1" value="<?= $latitude1 ?>" placeholder="Latitude 1">
                      <input type="text" id="lng1" name="longitude1" value="<?= $longitude1 ?>" placeholder="Longitude 1">
  
                      <!-- Input untuk koordinat lokasi 2 -->
                      <input type="text" id="lat2" name="latitude2" value="<?= $latitude2 ?>" placeholder="Latitude 2">
                      <input type="text" id="lng2" name="longitude2" value="<?= $longitude2 ?>" placeholder="Longitude 2">
                    </div>
                    <div class="form-group" style="margin-top:20px">
                      <label for="jenis_kerusakan" style="margin-right:74px;">Jenis Kerusakan</label>
                      <select class="form-control responsive" name="jenis_kerusakan" style="width:60%;display:inline;">
                        <option value="" selected="">-- Pilih --</option>
                        <option value="Jalan Berlubang" <?= $jenis_kerusakan=='Jalan Berlubang'?'selected':''; ?>>Jalan Berlubang</option>
                        <option value="Jalan Retak" <?= $jenis_kerusakan=='Jalan Retak'?'selected':''; ?>>Jalan Retak</option>
                        <option value="Jalan Miring" <?= $jenis_kerusakan=='Jalan Miring'?'selected':''; ?>>Jalan Miring</option>
                        <option value="Lainnya" <?= $jenis_kerusakan=='Lainnya'?'selected':''; ?>>Lainnya</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tingkat_kerusakan" style="margin-right:60px;">Tingkat Kerusakan</label>
                      <select class="form-control responsive" name="tingkat_kerusakan" style="width:60%;display:inline;">
                        <option value="" selected="">-- Pilih --</option>
                        <option value="Rendah" <?= $tingkat_kerusakan=='Rendah'?'selected':''; ?>>Rendah</option>
                        <option value="Sedang" <?= $tingkat_kerusakan=='Sedang'?'selected':''; ?>>Sedang</option>
                        <option value="Tinggi" <?= $tingkat_kerusakan=='Tinggi'?'selected':''; ?>>Tinggi</option>
                      </select>
                    </div>
                    <center>
                    <div class="form-group" style=" margin-top:50px; margin-bottom:50px;">
                      <button type="reset" class="btn btn-basic" name="btn_reset" style="width:95px; margin-right:20px; responsive"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                      <button type="submit" style="width:95px; responsive" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
                    </div>
                    </center>
                    <!-- /.box-body -->
                    <div class="box-footer" style="width: 90%;">
                      <a type="button" class="btn btn-default" style="margin-right:1px; responsive" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                    </div>
                  <!-- </div> -->
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>

      
    </div>
  </div>

  <footer class="main-footer" style="margin-left:0">
    <div class="pull-right hidden-xs">
      <b>Sistem Informasi Geografis</b>
    </div>
    <strong>Copyright &copy; <?= date('Y') ?></strong>
  </footer>

  <!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>

<!-- page script -->
<script>
  // Inisialisasi peta
  var map = L.map('map').setView([-6.921843, 107.606935], 14);

  // Tambahkan tile layer (peta dasar)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 19
  }).addTo(map);

  // Variabel global untuk dua marker
  var marker1 = null;
  var marker2 = null;
  var markerCount = 0; // Menghitung marker yang dipilih

  // Fungsi untuk menaruh marker
  function taruhMarker(posisiTitik) {
    markerCount++;

    if (markerCount === 1) {
      // Jika marker pertama belum ada, tambahkan marker 1
      if (marker1) {
        marker1.setLatLng(posisiTitik);
      } else {
        marker1 = L.marker(posisiTitik).addTo(map);
      }
      document.getElementById("lat1").value = posisiTitik.lat;
      document.getElementById("lng1").value = posisiTitik.lng;

    } else if (markerCount === 2) {
      // Jika marker kedua belum ada, tambahkan marker 2
      if (marker2) {
        marker2.setLatLng(posisiTitik);
      } else {
        marker2 = L.marker(posisiTitik).addTo(map);
      }
      document.getElementById("lat2").value = posisiTitik.lat;
      document.getElementById("lng2").value = posisiTitik.lng;

      // Reset counter jika dua marker sudah ditaruh
      markerCount = 0;
    }
  }

  // Event listener untuk klik pada peta
  map.on('click', function(e) {
    taruhMarker(e.latlng);
  });
</script>

</body>

</html>