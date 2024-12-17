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
        <?php if (!empty($this->session->userdata('name'))) { ?>
            <div class="pull-right" style="margin:10px">
                <a href="<?= base_url('Auth/sigout'); ?>" class="btn btn-default">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out
                </a>
            </div>
        <?php } else { ?>
            <div class="pull-right" style="margin:10px">
                <a href="<?= base_url('Auth/login'); ?>" class="btn btn-default">
                    <i class="fa fa-sign-in" aria-hidden="true"></i> Sign In
                </a>
            </div>
        <?php } ?>
    </nav>

    </header>