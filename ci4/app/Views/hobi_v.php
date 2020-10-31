<?= $this->extend('layouts/app_v'); ?>

<?= $this->section('content'); ?>
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section>
        <div class="container">
            <h2>Hobi</h2>

            <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong><?= session()->getFlashdata('pesan'); ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            
            <p>
                <a href="<?php echo site_url('Hobi/add') ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </p>
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Hobi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php $i = 1; ?>
                <?php foreach($dataHobi as $row) : ?>

                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['hobi'] ?></td>
                        <td>
                            <a href="<?php echo site_url('Hobi/edit/'.$row['kode_hobi']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Ubah</a>

                            <form action="<?php echo site_url('Hobi/'.$row['kode_hobi']); ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">Delete</button>
                            </form>

                        </td>
                    </tr>

                <?php 
                
                    endforeach;

                    if (empty($dataHobi)) {
                ?>

                <tr>
                    <td colspan="3" class="text-center">Tidak ada data.</td>
                </tr>

                <?php } ?>
                
                </tbody>
            </table>
        </div>
    </section>

    <section class="row">
        <div class="container">
            <!-- <h2>Home</h2> -->
        </div>
    </section>

<?= $this->endSection(); ?>
