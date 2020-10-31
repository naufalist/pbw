<?= $this->extend('layouts/app_v'); ?>

<?= $this->section('content'); ?>
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section class="my-4">
        <div class="container">
            <h2>Hobi</h2>

            <form method="post" action="<?= site_url('Hobi/save'); ?>">
            <?= csrf_field(); ?>

                <?php if (isset($hobi['kode_hobi'])) : ?>
                <input type="hidden" name="kode_hobi" id="kode_hobi" value="<?= $hobi["kode_hobi"] ?>">
                <?php endif; ?>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hobi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('hobi')) ? 'is-invalid' : ''; ?>" value="<?= (isset($hobi['hobi'])) ? $hobi['hobi'] : old('hobi') ?>" id="hobi" name="hobi" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('hobi'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                        <a href="<?= site_url('Hobi') ?>" class="btn btn-outline-primary btn-block mt-2">Kembali ke Hobi</a>
                    </div>
                </div>
            </form>

        </div>
    </section>

<?= $this->endSection(); ?>
