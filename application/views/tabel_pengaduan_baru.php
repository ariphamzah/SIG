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
        Tabel Pengaduan Baru
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('Dashboard/baru')?>">Tabel Pengaduan Baru</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-table" aria-hidden="true"></i> Pengaduan Baru</h3>
            </div>
            
            <div class="box-body">

              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
                </div>
               
              <?php $this->session->unset_userdata('msg_berhasil'); //untuk menghapus flashdata ?>

              <?php } if (validation_errors()) { ?>
                <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                </div>
              <?php } ?>

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