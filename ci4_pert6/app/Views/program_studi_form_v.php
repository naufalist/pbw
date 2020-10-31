
    
    <div class="jumbotron bg-purple text-white">
        <div class="container">
            <h1>IPB University</h1>
        </div>
    </div>

    <section class="my-4">
        <div class="container">
            <h2>Program Studi</h2>

            <form method="post" action="<?php echo site_url('Program_Studi/save'); ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode" name="kode" max-length="1" value="<?php if (!empty($dataProdi)) echo $dataProdi->kode_prodi; ?>" required>
                        <input type="hidden" name="id" id="id" value="<?php if(!empty($dataProdi)) echo $dataProdi->kode_prodi; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php if(!empty($dataProdi)) echo $dataProdi->nama_prodi; ?>"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Ketua</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ketua" name="ketua" value="<?php if(!empty($dataProdi)) echo $dataProdi->ketua_prodi; ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>

        </div>
    </section>
