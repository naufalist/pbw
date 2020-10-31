<?= $this->extend('layouts/app_v'); ?>

<?= $this->section('content'); ?>
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section class="my-4">
        <div class="container">
            <h2>Ubah Agama</h2>

            <form method="post" action="<?= site_url('Agama/save'); ?>">
            <?= csrf_field(); ?>

                <?php if (isset($agama['kode_agama'])) : ?>
                <input type="hidden" name="kode_agama" id="kode_agama" value="<?= $agama["kode_agama"] ?>">
                <?php endif; ?>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" value="<?= (isset($agama['agama'])) ? $agama['agama'] : old('agama') ?>" id="agama" name="agama" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('agama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                        <a href="<?= site_url('Agama') ?>" class="btn btn-outline-primary btn-block mt-2">Kembali ke Agama</a>
                    </div>
                </div>
            </form>

            <br><br>

        </div>
    </section>

<?= $this->endSection(); ?>
