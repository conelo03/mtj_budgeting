<?php $this->load->view('template/header');?>
<?php $this->load->view('template/sidebar');?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Master User</a></div>
        <div class="breadcrumb-item"><a href="#">Profil User</a></div>
        <div class="breadcrumb-item">Update User</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="<?= base_url('setting'); ?>" method="post"  enctype="multipart/form-data">
              <div class="card-header">
                <h4>Edit Profile</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" name="nip" class="form-control" value="<?= set_value('nip', $pegawai['nip']); ?>" disabled>
                  <?= form_error('nip', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?= set_value('nama', $pegawai['nama']); ?>" required="">
                  <?= form_error('nama', '<span class="text-danger small">', '</span>'); ?>
                </div>
                
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" name="jabatan" class="form-control" value="<?= set_value('jabatan', $pegawai['jabatan']); ?>" required="">
                  <?= form_error('jabatan', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat', $pegawai['alamat']); ?>" required="">
                  <?= form_error('alamat', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir', $pegawai['tempat_lahir']); ?>" required="">
                  <?= form_error('tempat_lahir', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir', $pegawai['tanggal_lahir']); ?>" required="">
                  <?= form_error('tanggal_lahir', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label class="d-block">Jenis Kelamin</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" id="exampleRadios3" <?= set_value('jenis_kelamin', $pegawai['jenis_kelamin']) == 'Laki-laki' ? 'checked' : '' ; ?> >
                    <label class="form-check-label" for="exampleRadios3">
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" id="exampleRadios4" <?= set_value('jenis_kelamin', $pegawai['jenis_kelamin']) == 'Perempuan' ? 'checked' : '' ; ?> >
                    <label class="form-check-label" for="exampleRadios4">
                      Perempuan
                    </label>
                  </div>
                </div>
                <?= form_error('jenis_kelamin', '<span class="text-danger small">', '</span>'); ?>
                
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?= set_value('username', $pegawai['username']); ?>" required="">
                  <?= form_error('username', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" value="<?= set_value('password'); ?>" >
                  <?= form_error('password', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" name="password2" class="form-control" value="<?= set_value('password2'); ?>" >
                  <?= form_error('password2', '<span class="text-danger small">', '</span>'); ?>
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <input type="hidden" name="foto_old" class="form-control" value="<?= $pegawai['foto']; ?>" required="">
                  <input type="file" name="foto" class="form-control" value="<?= set_value('foto'); ?>" >
                  <?= form_error('foto', '<span class="text-danger small">', '</span>'); ?>
                </div>
              </div>
              <div class="card-footer text-right">
                <a href="<?= base_url('profile');?>" class="btn btn-light"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button type="reset" class="btn btn-danger"><i class="fa fa-sync"></i> Reset</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('template/footer');?>