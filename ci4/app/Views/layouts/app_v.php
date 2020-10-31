<!---           






















            | |    ___ | | __ _ | |_    __ _  _  _  _  _  ___                         
            | |__ / -_)| |/ _` || ' \  / _` || || || || |(_-< _                       
            |____|\___||_|\__,_||_||_| \__, | \_,_| \_, |/__/(_)           _          
            | _ \| _ )\ \    / /  _ __ |___/_ | | __|__/ __    _ __  _  _ | | _  _    
            |  _/| _ \ \ \/\/ /  | '  \ / _` || |/ -_)| '  \  | '  \| || || || || | _ 
            |_| _|___/  \_/\_/   |_|_|_|\__,_||_|\___||_|_|_| |_|_|_|\_,_||_| \_,_|(_)
            | || | __ _  __| | ___ | |_  | |_                                         
            | __ |/ _` |/ _` |/ -_)| ' \ | ' \  _                                     
            |_||_|\__,_|\__,_|\___||_||_||_||_|(_)  
            
            - J3D118042.






















  -->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author">
    <meta name="description">
    <meta name="keyword">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- Font Awesome CSS 4.7.0 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

    <title><?= $title; ?></title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">IPB University</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('Beranda') ?>">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?= ($page == 'Program Studi') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo site_url('Program_Studi') ?>">Program Studi</a>
                    </li>
                    <li class="nav-item <?= ($page == 'Mahasiswa') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo site_url('Mahasiswa') ?>">Mahasiswa</a>
                    </li>
                    <li class="nav-item dropdown <?= in_array($page, ['Agama', 'Hobi']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Data Master
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo site_url('Agama') ?>">Agama</a>
                            <a class="dropdown-item" href="<?php echo site_url('Hobi') ?>">Hobi</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>


    <?= $this->renderSection('content'); ?>

    <footer class="footer">
        <div class="card text-center">
          <span class="text-muted">Made with <span style="color: #e25555;">&#9829;</span> <a href="https://naufalist.com" target="_blank" title="Naufalist">J3D118042</a></span>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>