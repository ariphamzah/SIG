<!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- search form -->
         

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
            <a href="<?= base_url('Dashboard') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                </span>
            </a>
            </li>
            <li class="header">PENGADUAN</li>

            <li class="treeview <?= ($nav != '1')?($nav != '9')?'':'active':'active' ?>" href="<?= site_url('Welcome') ?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?= ($nav == '1')?'active':'' ?>"><a href="<?= base_url('Dashboard/form_baru') ?>"><i class="fa fa-circle-o"></i> Form Pengaduan Baru</a></li>
                <li class="<?= ($nav == '9')?'active':'' ?>"><a href="<?= base_url('Dashboard/form_user') ?>"><i class="fa fa-circle-o"></i> Form User</a></li>
              </ul>
            </li>

            <li class="treeview <?= ($nav != '2')?($nav != '3')?($nav != '4')?($nav != '5')?'':'active':'active':'active':'active' ?>" href="<?= site_url('Welcome') ?>">
            <a href="#">
                <i class="fa fa-table"></i> <span>Tabel Pengaduan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?= ($nav == '2')?'active':'' ?>"><a href="<?= base_url('Dashboard/baru') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Baru</a></li>
                <li class="<?= ($nav == '3')?'active':'' ?>"><a href="<?= base_url('Dashboard/proses') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Proses</a></li>
                <li class="<?= ($nav == '4')?'active':'' ?>"><a href="<?= base_url('Dashboard/selesai') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Selesai</a></li>
                <li class="<?= ($nav == '5')?'active':'' ?>"><a href="<?= base_url('Dashboard/ditolak') ?>"><i class="fa fa-circle-o"></i> Tabel Pengaduan Ditolak</a></li> 
            </ul>
          </li>
          <li class="<?= ($nav == '6')?'active':'' ?>">
                <a href="<?= base_url('Dashboard/report') ?>">
                <i class="fa fa-edit"></i> <span>Report</span>
                <span class="pull-right-container"></span>
                </a>                                           
          </li>
          <li>
            <li class="header">LABELS</li>
          <li class="<?= ($nav == '7')?'active':'' ?>">
            <a href="<?php echo base_url('Dashboard/profile') ?>">
                <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
          </li>
          <li class="<?= ($nav == '8')?'active':'' ?>">
            <a href="<?php echo base_url('Dashboard/users') ?>">
              <i class="fa fa-fw fa-users" aria-hidden="true"></i> <span>Users</span></a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>