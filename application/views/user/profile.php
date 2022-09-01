<?php $this->load->view('template/header');?>
<?php $this->load->view('template/sidebar');?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master Pegawai</a></div>
        <div class="breadcrumb-item"><a href="#">Profil Pegawai</a></div>
        <div class="breadcrumb-item">Update Pegawai</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="<?= base_url('setting'); ?>" method="post"  enctype="multipart/form-data">
              <div class="card-header">
                <h4 style="color: #3abaf4;">Informasi Pribadi</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <img src="<?= base_url('assets/img/profile/'.$pegawai['foto']) ?>" class="rounded" style="max-width: 200px">
                  </div>
                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-md-4"><h6>Nama</h6></div>
                      <div class="col-md-8"><h6>: <?= $pegawai['nama'] ?></h6></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><h6>NIP</h6></div>
                      <div class="col-md-8"><h6>: <?= $pegawai['nip'] ?></h6></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><h6>Jabatan</h6></div>
                      <div class="col-md-8"><h6>: <?= $pegawai['jabatan'] ?></h6></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><h6>Alamat</h6></div>
                      <div class="col-md-8"><h6>: <?= $pegawai['alamat'] ?></h6></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><h6>Tempat, tanggal lahir</h6></div>
                      <div class="col-md-8"><h6>: <?= $pegawai['tempat_lahir'] ?>, <?= $pegawai['tanggal_lahir'] ?></h6></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><h6>Jenis Kelamin</h6></div>
                      <div class="col-md-8"><h6>: <?= $pegawai['jenis_kelamin'] ?></h6></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><h6>Akses</h6></div>
                      <div class="col-md-8">: 
                        <?php
                          $roles = explode(',', $pegawai['role']);
                          foreach ($roles as $r) { ?>
                            <button type="button" class="btn btn-light"><?= $r ?></button>
                        <?php  }
                        ?>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="card-footer text-right">
                <a href="<?= base_url('setting');?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('template/footer');?>