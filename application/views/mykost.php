<html>
    <head>
        <title>Hanya Di Kost Sambi</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <style>
            .card{
                border-color: #2d5066;
            }
            .card-header{
                background-color: #2d5066;
                color: white;
            }
            .btn{
                color: #2d5066;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <section>
            <nav class="navbar fixed-top navbar-expand-sm" style="background-color:#2d5066">
                <div class="collapse navbar-collapse">
                    <a class="navbar-brand font-weight-bold" style="color: white;font-size:25px" href="<?php echo base_url('')?>">
                        <img src="<?php echo base_url('assets/img/logoputih.png')?>" width="50" height="50" alt="">
                        KOST SAMBI
                    </a>
                </div>
                <ul class="navbar-nav mr-auto ">
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="daftarkankost" href="<?php echo base_url('index.php/WebController/daftarkost')?>" style="color: white;font-size:18px">DAFTARKAN KOST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="mykost" href="<?php echo base_url('index.php/WebController/mykost')?>" style="color: white;font-size:18px">MY KOST</a>
                        </li>
                        <li class="nav-item row">
                            <div class="dropdown col-6">
                                <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565; height:50px;width:80px;font-size:15px;" data-toggle="dropdown">
                                HAI <?php echo $this->session->userdata('username') ?>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item">PROFILE</a>
                                    <a class="dropdown-item" href="<?php echo base_url("index.php/WebController/logout")?>">LOGOUT</a>
                                </div>
                            </div>
                            <img class="col-6" style="width:60px";height="60px" src="<?php echo base_url('assets/img/user.png')?>">
                        </li>
                    </ul>
            </nav>
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-7">
                        <?php foreach ($kost as $kst) : ?>
                            <div class="card">
                                <h5 class="card-header"><?= $kst['namakost'];?></h5>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $kst['alamat'];?></h5>
                                    <img class="col-3" src="<?php echo base_url($kst['foto'])?>" style="width:100px;heigth:50px">
                                    <a class="btn col-3" href="<?= base_url(); ?>index.php/WebController/view_kost_pemilik/<?=$kst['kodekost'] ?>">VIEW</a>
                                    <a class="btn col-3">EDIT</a>
                                    <a class="btn col-3" href="<?= base_url(); ?>index.php/WebController/delete_mykost/<?=$kst['kodekost'] ?>">DELETE</a>
                                </div>
                            </div>
                        <br>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-5">
                        <img src="<?php echo base_url('assets/img/hmm.png')?>" style="width:500px;height:500px">
                    </div>
                </div>
            </div>
        </section>
    
    </body>
</html>