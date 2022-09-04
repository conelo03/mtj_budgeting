  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav mr-auto">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('assets/img/profile/user.png'); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?= $this->session->userdata('userName') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Edit Account
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" data-confirm="Logout|Are You sure you want to Log out?" data-confirm-yes="document.location.href='<?= base_url('logout'); ?>';"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">Budgeting</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"></a>
          </div>
          <?php
            $judul = explode(' ', $title);
          ?>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="<?= $title == 'Dashboard' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('dashboard');?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>  
  
            <li class="menu-header">Data Master</li>      
            <li class="<?= $title == 'Data User' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('user');?>"><i class="fas fa-users"></i> <span>Data User</span></a></li> 
            <li class="<?= $title == 'Data Client' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('client');?>"><i class="fas fa-users"></i> <span>Data Client</span></a></li>
            <li class="<?= $title == 'Data Project Group' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('project-group');?>"><i class="fas fa-building"></i> <span>Data Project Group</span></a></li> 
            <li class="<?= $title == 'Data Project' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('project');?>"><i class="fas fa-building"></i> <span>Data Project</span></a></li> 
            
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <button class="btn btn-danger btn-lg btn-block btn-icon-split" data-confirm="Logout|Anda yakin ingin keluar?" data-confirm-yes="document.location.href='<?= base_url('logout'); ?>';"><i class="fa fa-sign-out-alt"></i> Logout</button>
          </div>
        </aside>
      </div>
      