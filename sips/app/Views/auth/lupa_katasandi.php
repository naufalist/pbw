<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Katasandi</title>
</head>
<body>
  <center>

  
  <?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
  <?php endif; ?>

  <label for="">Masukkan email</label>
  <form action=" <?= site_url('/lupa_katasandi'); ?> " method="post" autocomplete="off">
  <?= csrf_field() ?>
  <input type="text" name="email" placeholder="email" value="<?= old('email'); ?>" <?= ($validation->hasError('email')) ? 'autofocus' : ''; ?>><br><br>
  
  <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?>


  <button type="submit">Kirim</button>


  <br><br>
  <a href="<?= site_url('/masuk'); ?>">Kembali ke laman masuk</a>
  </form>
</body>
</html>