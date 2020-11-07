<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Font GoogleApis -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css') ?>"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title><?= $title; ?></title>

    <style>
      * { 
        font-family: 'Quicksand', sans-serif;
        font-size: 15px;
      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <!-- <img src="<?= base_url('assets/img/naufalist.svg') ?>" width="145" alt=""> -->
          <h3 class="pt-1">SIPS</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item <?= current_url(); ?>">
              <a class="nav-link" href="#"><i class="fa fa-home"></i> Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="fakeGen" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-magic fa-sm"></i> Fake Generator
              </a>
              <div class="dropdown-menu" aria-labelledby="fakeGen">
                  <a class="dropdown-item" href="" target="_blank">SNMPTN</a>
                  <a class="dropdown-item" href="#">SBMPTN</a>
                  {{-- <a class="dropdown-item" href="#">SNMPN</a> --}}
                  <a class="dropdown-item" href="" target="_blank">SPAN PTKIN</a>
              </div>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="fakeGen" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-graduation-cap fa-sm"></i> Kampus
              </a>
              <div class="dropdown-menu" aria-labelledby="fakeGen">
                  <a class="dropdown-item active" href="">Konversi NIM</a>
                  <a class="dropdown-item active" href="">Konversi NIM</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="fakeGen" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-list-ul fa-sm"></i> Lainnya
              </a>
              <div class="dropdown-menu" aria-labelledby="fakeGen">
                  <a class="dropdown-item" href="#">Weton</a>
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Features</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown link
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row my-5">
        </div>
    </div>

    <?= $this->renderSection('content'); ?>

    <!-- <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Header
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="row my-5">
        </div>
    </div>

    <footer class="navbar navbar-expand-lg navbar-light bg-light fixed-bottom">
        <div class="container justify-content-center py-3">
          <span class="text-muted">Made with <span style="color: #e25555;">&#9829;</span> <a href="https://naufalist.com" target="_blank" title="Muhammad Naufal Wafi">J3D118042</a></span>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="<?= base_url("assets/js/jquery-3.4.1.slim.min.js") ?>"></script> -->
    <!-- <script src="<?= base_url("assets/js/popper.min.js") ?>"></script> -->
    <!-- <script src="<?= base_url("assets/js/bootstrap.min.js") ?>}"></script> -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  </body>
</html>
