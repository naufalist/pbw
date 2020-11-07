<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Katasandi</title>
</head>
<body>
  <center>

  
  <?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
  <?php endif; ?>

  <label for="">Masukkan password baru</label>
  <form action=" <?= site_url('/ubah_katasandi'); ?> " method="post" autocomplete="off">
  <?= csrf_field() ?>
  <input type="password" name="password" placeholder="password" value="<?= old('password'); ?>" <?= ($validation->hasError('password')) ? 'autofocus' : ''; ?>><br><br>
  <?= ($validation->hasError('password')) ? $validation->getError('password') : ''; ?>
  <input type="password" name="repassword" placeholder="repassword" value="<?= old('repassword'); ?>" <?= ($validation->hasError('repassword')) ? 'autofocus' : ''; ?>><br><br>
  <?= ($validation->hasError('repassword')) ? $validation->getError('repassword') : ''; ?>

  <input type="hidden" name="id" value="<?= $id ?>">
  <input type="hidden" name="token" value="<?= $token ?>">

  <button type="submit">Ubah</button>


  <br><br>
  <a href="<?= site_url('/masuk'); ?>">Kembali ke laman masuk</a>
  </form>
</body>
</html>