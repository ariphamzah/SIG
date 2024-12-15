<?php
	$nama_jalan = '';
	$latitude = '';
	$longitude = '';
	$jenis_kerusakan = '';
	$tingkat_kerusakan = '';
	$flag = 0;
  $link = base_url('dashboard/proses_pengaduan_baru');

	if(isset($masuk)){
		foreach($masuk as $d){
      $nama_jalan = $d->nama_jalan;
      $latitude = $d->latitude;
      $longitude = $d->longitude;
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
                    <div class="form-group">
                      <label for="latitude" style="margin-right:122px;">Latitude</label>
                      <input type="text" name="latitude" style="width:60%;display:inline;" class="form-control responsive" id="Latitude" placeholder="Latitude" value="<?= $latitude ?>">
                    </div>
                    <div class="form-group">
                      <label for="longitude" style="margin-right:112px;">Longitude</label>
                      <input type="text" name="longitude" style="width:60%;display:inline;" class="form-control responsive" id="Longitude" placeholder="Longitude" value="<?= $longitude ?>">
                    </div>
                    <div class="form-group">
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