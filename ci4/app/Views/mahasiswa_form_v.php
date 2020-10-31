<?= $this->extend('layouts/app_v'); ?>

<?= $this->section('content'); ?>
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section class="my-4">
        <div class="container">
            <h2>Mahasiswa</h2>

            <form method="post" action="<?= site_url('Mahasiswa/save'); ?>" enctype="multipart/form-data" autocomplete="off">
            <?= csrf_field(); ?>

            <?php if ($title == "Ubah Mahasiswa") : ?>
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="nimTemp" value="<?= $mahasiswa['nim'] ?>">
                <input type="hidden" name="fotoTemp" value="<?= $mahasiswa['foto']; ?>">
            <?php endif; ?>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIM<small class="text-danger font-weight-bold">*</small></label>
                    <div class="col-sm-10">
                        <input type="text" name="nim" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : ''; ?>" style="text-transform: uppercase;" placeholder="J3XXXXXXX" value="<?= (isset($mahasiswa['nim'])) ? $mahasiswa['nim'] : old('nim') ?>" <?= ($title == "Ubah Mahasiswa") ? 'disabled' : ''; ?>>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nim'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama<small class="text-danger font-weight-bold">*</small></label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" value="<?= (isset($mahasiswa['nama'])) ? $mahasiswa['nama'] : old('nama') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat, Tgl Lahir<small class="text-danger font-weight-bold">*</small></label>
                    <div class="col-sm">
                        <input type="text" name="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" value="<?= (isset($mahasiswa['tempat_lahir'])) ? $mahasiswa['tempat_lahir'] : old('tempat_lahir') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tempat_lahir'); ?>
                        </div>
                    </div>
                    <div class="col-sm">
                        <input type="date" name="tanggal_lahir" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" value="<?= (isset($mahasiswa['tanggal_lahir'])) ? $mahasiswa['tanggal_lahir'] : old('tanggal_lahir') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir'); ?>
                        </div>
                    </div>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin<small class="text-danger font-weight-bold">*</small></legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="Laki-laki" class="form-check-input <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin" value="Laki-laki" 
                            <?php
                                if (isset($mahasiswa['jenis_kelamin']) and $mahasiswa['jenis_kelamin'] == 'Laki-laki') {
                                    echo 'checked';
                                } else {
                                    if (old('jenis_kelamin') == 'Laki-laki') {
                                        echo 'checked';
                                    }
                                }
                            ?>
                            >
                            <label for="Laki-laki" class="form-check-label">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="Perempuan" class="form-check-input <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" type="radio" name="jenis_kelamin"  value="Perempuan"
                            <?php
                                if (isset($mahasiswa['jenis_kelamin']) and $mahasiswa['jenis_kelamin'] == 'Perempuan') {
                                    echo 'checked';
                                } else {
                                    if (old('jenis_kelamin') == 'Perempuan') {
                                        echo 'checked';
                                    }
                                }
                            ?>>
                            <label for="Perempuan" class="form-check-label">
                                Perempuan
                            </label>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </fieldset>

                <?php if (!empty($dataHobi)) : ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hobi</label>
                    <div class="col-sm-10">
                        <?php foreach ($dataHobi as $hobi) : ?>
                        <div class="form-check form-check-inline">
                            <input id="<?= $hobi['hobi']; ?>" class="form-check-input" type="checkbox" name="hobi[]" value="<?= $hobi['kode_hobi']; ?>"
                            
                            <?php

                                if (!empty($hobimahasiswa) and in_array($hobi['kode_hobi'], $hobimahasiswa)) {
                                    echo 'checked';
                                }

                            ?>
                            
                            >
                            <label for="<?= $hobi['hobi']; ?>" class="form-check-label"><?= $hobi['hobi']; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-sm-12">
                        <small class="text-muted">Tidak terdaftar? silakan tambah hobi sendiri <a href="<?= site_url('Hobi/add') ?>">disini</a>.</small>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($dataAgama)) : ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Agama<small class="text-danger font-weight-bold">*</small></label>
                    <div class="col-sm-10">
                        <select class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?> " name="kode_agama">
                        <!-- <option value selected disabled>-- Agama --</option> -->

                        <?php foreach ($dataAgama as $agama) : ?>
                            <option value="<?= $agama['kode_agama']; ?>" <?= ((isset($mahasiswa['kode_agama']) and $mahasiswa['kode_agama'] == $agama['kode_agama']) or (old('kode_agama') == $agama['kode_agama'])) ? 'selected' : '';?>><?= $agama['agama']; ?></option>
                        <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('agama'); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat<small class="text-danger font-weight-bold">*</small></label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" value="<?= (isset($mahasiswa['alamat'])) ? $mahasiswa['alamat'] : old('alamat') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto<small class="text-danger font-weight-bold">*</small></label>
                    <div class="col-sm-2">
                        <img src="<?php
                        
                        if (isset($mahasiswa['foto'])) {
                            echo base_url('assets/img/mahasiswa/'.$mahasiswa['foto']);
                        } else {
                            echo base_url('assets/img/mahasiswa/default.png');
                        }
                        
                        ?>" class="img-thumbnail img-preview" width="100">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" id="foto" name="foto" class="custom-file-input form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" onchange="previewImg()">
                                <?php if ($validation->hasError('foto')) { ?>
                                    <div class="invalid-feedback">';
                                        <?= $validation->getError('foto'); ?>
                                    </div>
                                <?php } else { ?>
                                    <small class="text-muted">type: jpg/jpeg/png. size: max 1 MB.</small>
                                <?php } ?>
                            <label class="custom-file-label">
                            
                            <?php

                                if (isset($mahasiswa['foto'])) {
                                    echo $mahasiswa['foto'];
                                } else {
                                    echo 'Pilih foto...';
                                }

                            ?>

                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <hr>
                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                        <a href="<?= site_url('Mahasiswa') ?>" class="btn btn-outline-primary btn-block mt-2">Kembali ke Mahasiswa</a>
                    </div>
                </div>

            </form>

            <br><br>

        </div>
    </section>

<?= $this->endSection(); ?>
