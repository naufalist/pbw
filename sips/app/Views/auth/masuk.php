<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk</title>
</head>
<body>
  <center>
  <br><br><br>
  
  <?php if (session()->getFlashdata('pesan')) : ?>
    <?= session()->getFlashdata('pesan') ?>
  <?php endif; ?>

  <form action=" <?= site_url('/masuk'); ?> " method="post" autocomplete="off">
    <?= csrf_field() ?>
    <input
      type="text"
      name="email"
      placeholder="email"
      value="<?= old('email'); ?>"
      <?= ($validation->hasError('email')) ? 'autofocus' : ''; ?>
    >
    <br><br>
    <?= ($validation->hasError('email')) ? $validation->getError('email') : ''; ?>

    <input
      type="password"
      name="password"
      placeholder="password"
      value="<?= old('password'); ?>"
    >
    <br><br>
    <?= ($validation->hasError('password')) ? $validation->getError('password') : ''; ?>

    <button type="submit">Login</button>

    <br><br>
    <ul>
      <li>
        <a href="<?= site_url('/lupa_katasandi'); ?>">Lupa katasandi?</a>
      </li>
    </ul>
    <br>
    <a href="<?= site_url('/daftar'); ?>">Belum punya akun? Daftar sekarang!</a>
  </form>

</body>
</html>