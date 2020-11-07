<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php if (session()->getFlashdata('alert')) : ?>
      <div class="alert alert-<?= session()->getFlashdata('alert')['tipe'] ?> alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <?= session()->getFlashdata('alert')['pesan'] ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="list-group">
        <a href="<?= site_url('/materi'); ?>" class="list-group-item list-group-item-action">Materi</a>
        <a href="<?= site_url('/latihan'); ?>" class="list-group-item list-group-item-action">Latihan</a>
        <a href="<?= site_url('/quiz'); ?>" class="list-group-item list-group-item-action">Quiz</a>
        <a href="<?= site_url('/peringkat'); ?>" class="list-group-item list-group-item-action">Peringkat</a>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-md-6">
      <a name="" id="" class="btn btn-outline-warning btn-block" href="#" role="button">Keluar</a>
    </div>
  </div>
</div>

<br><br>


<?= $this->endSection(); ?>