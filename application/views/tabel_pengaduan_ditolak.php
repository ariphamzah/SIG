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
        Tabel Pengaduan Ditolak
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('Dashboard/ditolak')?>">Tabel Pengaduan Ditolak</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-table" aria-hidden="true"></i> Pengaduan Ditolak</h3>
            </div>
            
            <div class="box-body">

              <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jalan</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Jenis Kerusakan</th>
                  <th>Tingkat Kerusakan</th>
                </tr>
                </thead>
                <?php if(!empty($list_data)){ ?>
                <?php $no = 1;?>
                <?php foreach($list_data as $dd): ?>
                <tbody>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$dd->nama_jalan?></td>
                    <td><?=$dd->latitude?></td>
                    <td><?=$dd->longitude?></td>
                    <td><?=$dd->jenis_kerusakan?></td>
                    <td><?=$dd->tingkat_kerusakan?></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach;?>
              <?php }else { ?>
                    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
              <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Jenis Kerusakan</th>
                    <th>Tingkat Kerusakan</th>
                  </tr>
                </tfoot>
              </table>
              </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>