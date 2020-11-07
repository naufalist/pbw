<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar</title>
</head>
<body>
  <center>

  
  <?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
  <?php endif; ?>


  <form action=" <?= site_url('/daftar'); ?> " method="post" autocomplete="off">
  <?= csrf_field() ?>
  <input type="text" name="email" placeholder="email" value="<?= old('email'); ?>" <?= ($validation->hasError('email')) ? 'autofocus' : ''; ?>><br><br>
  <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?>

  <input type="text" name="nama" placeholder="nama" value="<?= old('nama'); ?>" <?= ($validation->hasError('nama')) ? 'autofocus' : ''; ?>><br><br>
  <?= ($validation->hasError('nama')) ? $validation->getError('nama') : ''; ?>

  <input type="password" name="password" placeholder="password" value="<?= old('password'); ?>"><br><br>
  <?= ($validation->hasError('password')) ? $validation->getError('password') : ''; ?>

  <input type="password" name="repassword" placeholder="repassword" value="<?= old('repassword'); ?>"><br><br>
  <?= ($validation->hasError('repassword')) ? $validation->getError('repassword') : ''; ?>

  <input type="text" name="organisasi" placeholder="organisasi" value="<?= old('organisasi'); ?>" <?= ($validation->hasError('organisasi')) ? 'autofocus' : ''; ?>><br><br>
  <?= ($validation->hasError('organisasi')) ? $validation->getError('organisasi') : ''; ?>

  <button type="submit">Daftar</button>
  </form>
</body>
</html>