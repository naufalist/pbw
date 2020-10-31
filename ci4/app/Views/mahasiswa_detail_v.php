<?= $this->extend('layouts/app_v'); ?>

<?= $this->section('content'); ?>
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section>
        <div class="container">
            <h2>Info Mahasiswa</h2>

            <div class="row justify-content-center">
                <div class="col-md-6">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">
                                <img src="<?= base_url('assets/img/mahasiswa/'.$dataMahasiswa['foto']); ?>" class="img-responsive" width="200" height="200" alt="">
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">NIM</th>
                            <td><?= $dataMahasiswa['nim']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?= ucwords($dataMahasiswa['nama']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $dataMahasiswa['jenis_kelamin']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat, Tgl Lahir</th>
                            <td><?= ucwords($dataMahasiswa['tempat_lahir']); ?>, <?= $dataMahasiswa['tanggal_lahir']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>
                            <td><?= ucwords($dataMahasiswa['alamat']); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Agama</th>
                            <td><?= $dataAgama; ?></td>
                        </tr>
                        <?php if (!empty($dataHobi)) : ?>
                        <tr>
                            <th scope="row">Hobi</th>
                            <td>
                                <ol class="pl-3">
                                <?php foreach ($dataHobi as $kodeHobi) : ?>
                                    <li><?= $kodeHobi['hobi']; ?></li>
                                <?php endforeach; ?>
                                </ol>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="2">
                            <a href="<?= site_url('Mahasiswa') ?>" class="btn btn-outline-primary btn-block">Kembali ke Mahasiswa</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
    </section>



    <section class="row">
        <div class="container">
            <!-- <h2>Home</h2> -->
        </div>
    </section>

<?= $this->endSection(); ?>
