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
        Tabel Pengaduan Proses
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Tables</li>
        <li class="active"><a href="<?=base_url('Dashboard/proses')?>">Tabel Pengaduan Proses</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-table" aria-hidden="true"></i> Pengaduan Proses</h3>
            </div>
            
            <div class="box-body">

              <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jalan</th>
                  <th>Latitude 1</th>
                  <th>Longitude 1</th>
                  <th>Latitude 2</th>
                  <th>Longitude 2</th>
                  <th>Jenis Kerusakan</th>
                  <th>Tingkat Kerusakan</th>
                  <th>Selesai</th>
                  <th>Cancel</th>
                </tr>
                </thead>
                <?php if(!empty($list_data)){ ?>
                <?php $no = 1;?>
                <?php foreach($list_data as $dd): ?>
                <tbody>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$dd->nama_jalan?></td>
                    <td><?=$dd->latitude1?></td>
                    <td><?=$dd->longitude1?></td>
                    <td><?=$dd->latitude2?></td>
                    <td><?=$dd->longitude2?></td>
                    <td><?=$dd->jenis_kerusakan?></td>
                    <td><?=$dd->tingkat_kerusakan?></td>
                    <td><a type="button" class="btn btn-success"  href="<?=base_url('Dashboard/edit_user/'.$dd->id)?>" name="btn_update" style="margin:auto;"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td><a type="button" class="btn btn-danger btn-delete"  href="<?=base_url('Dashboard/proses_delete_user/'.$dd->id)?>" name="btn_delete" style="margin:auto;" onclick="return confirm('Are you sure?')"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
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
                    <th>Latitude 1</th>
                    <th>Longitude 1</th>
                    <th>Latitude 2</th>
                    <th>Longitude 2</th>
                    <th>Jenis Kerusakan</th>
                    <th>Tingkat Kerusakan</th>
                    <th>Selesai</th>
                    <th>Cancel</th>
                  </tr>
                </tfoot>
              </table>
              </div>
              <div>
              <?php
                  // Koneksi ke database
                  $host = 'localhost';
                  $dbname = 'sig';
                  $username = 'root';
                  $password = '';

                  try {
                      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                      // Query untuk mengambil data koordinat dan kategori
                      $stmt = $pdo->prepare("SELECT latitude1, longitude1, latitude2, longitude2, kategori FROM kerusakan_jalan WHERE Kategori = :kategori");
                      $stmt->execute(['kategori' => 'Diproses']);
                      $coordinates = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  } catch (PDOException $e) {
                      echo "Koneksi gagal: " . $e->getMessage();
                      die();
                  }
              ?>

              <span>PETA</span>
              <!-- MAP -->
              <div id="map" style="height: 500px;"></div>
              <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
              <script>
                  // Inisialisasi peta
                  var map = L.map('map').setView([-6.921843, 107.606935], 14);

                  // Tambahkan layer tile ke peta
                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                  }).addTo(map);

                  // Data koordinat dari PHP
                  var coordinates = <?php echo json_encode($coordinates); ?>;

                  // Fungsi untuk menentukan warna marker sesuai kategori
                  function getMarkerColor(category) {
                      switch (category) {
                          case 'Diajukan': return 'blue';
                          case 'Selesai': return 'green';
                          case 'Diproses': return 'orange';
                          case 'Ditolak': return 'red';
                          default: return 'gray';
                      }
                  }

                  // Tambahkan marker dan garis ke peta
                  coordinates.forEach(function(coord) {
                      var lat1 = parseFloat(coord.latitude1);
                      var lng1 = parseFloat(coord.longitude1);
                      var lat2 = parseFloat(coord.latitude2);
                      var lng2 = parseFloat(coord.longitude2);

                      // Periksa apakah kedua koordinat valid
                      if (!isNaN(lat1) && !isNaN(lng1) && !isNaN(lat2) && !isNaN(lng2)) {
                          var point1 = [lat1, lng1];
                          var point2 = [lat2, lng2];

                          // Tambahkan marker pertama
                          var color = getMarkerColor(coord.kategori);
                          var customIcon = L.icon({
                              iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,
                              shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png',
                              iconSize: [25, 41],
                              iconAnchor: [12, 41],
                              popupAnchor: [1, -34],
                              shadowSize: [41, 41]
                          });

                          L.marker(point1, { icon: customIcon })
                              .addTo(map)
                              .bindPopup(`Kategori: ${coord.kategori}`);

                          // Tambahkan marker kedua
                          L.marker(point2, { icon: customIcon })
                              .addTo(map)
                              .bindPopup(`Kategori: ${coord.kategori}`);

                          // Tambahkan garis antara point1 dan point2
                          L.polyline([point1, point2], { color: 'blue', weight: 3 }).addTo(map);
                      }
                  });
              </script>
          </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>