<?= $this->extend('layouts/app_v'); ?>

<?= $this->section('content'); ?>
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section>
        <div class="container">
            <h2>Mahasiswa</h2>

            <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= session()->getFlashdata('pesan'); ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            
            <p>
                <a href="<?php echo site_url('Mahasiswa/add') ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </p>
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                <?php foreach($dataMahasiswa as $mhs) : ?>

                    <tr>
                        <td class="align-middle">
                            <img src="<?= base_url('assets/img/mahasiswa/'.$mhs['foto']); ?>" alt="" class="img-thumbnail img-responsive rounded-circle" width="70" height="70">
                        </td>
                        <td class="align-middle"><?= $mhs['nim'] ?></td>
                        <td class="align-middle"><?= $mhs['nama'] ?></td>
                        <td class="align-middle">
                            <a href="<?php echo site_url('Mahasiswa/'.$mhs['nim']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Detil</a>
                            <a href="<?php echo site_url('Mahasiswa/edit/'.$mhs['nim']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Ubah</a>
                            
                            <!-- <a href="<?php echo site_url('Mahasiswa/delete/'.$mhs['nim']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');"><i class="fa fa-trash"></i> Hapus</a> -->


                            <form action="<?php echo site_url('Mahasiswa/'.$mhs['nim']); ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus?');">Delete</button>
                            </form>

                        </td>
                    </tr>

                <?php 
                
                    endforeach;

                    if (empty($dataMahasiswa)) {
                ?>

                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
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
