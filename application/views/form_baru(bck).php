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

	if(isset($masuk)){
		foreach($masuk as $d){
      $nama_jalan = $d->nama_jalan;
      $latitude1 = $d->latitude1;
      $longitude1 = $d->longitude1;
      $latitude2 = $d->latitude2;
      $longitude2 = $d->longitude2;
      $jenis_kerusakan = $d->jenis_kerusakan;
      $tingkat_kerusakan = $d->tingkat_kerusakan;
      $flag=1;
      $link=base_url('dashboard/proses_pengaduan_baru_edit');
    }
	}
?>

<div class="wrapper">

  <header class="main-header">
    <?= $main_header ?>
  </header>

  <aside class="main-sidebar">
    <?= $sidebar ?>
  </aside>

  <div class="content-wrapper">
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
                      <a type="button" class="btn btn-info" style="margin-right:29% display:inline; responsive" href="<?= base_url('Dashboard/baru') ?>" name="btn_listbarang"><i class="fa fa-table" aria-hidden="true"></i> Lihat Tabel Pengaduan</a>
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