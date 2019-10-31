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
    
    <?php
        if(($this->session->userdata('logged_in')==1) && ($this->session->userdata('role')==1)){
            echo '<script>
                $(document).ready(function(){
                    $("#loginbutton").hide();
                    $("#afterlogin").show();
                    $("#daftarkankost").hide();
                    $("#mykost").hide();
                });
                </script>';
            $tabel = 'pencari';
            $username = $this->session->userdata('username');
        }
        else if(($this->session->userdata('logged_in')==1) && ($this->session->userdata('role')==2)){
            echo '<script>
                $(document).ready(function(){
                    $("#loginbutton").hide();
                    $("#afterlogin").show();
                    $("#daftarkankost").show();
                    $("#mykost").show();
                });
                </script>';
            $tabel = 'pemilik';
            $username = $this->session->userdata('username');
        }
        else{
             echo '<script>
                $(document).ready(function(){
                    $("#afterlogin").hide();
                    $("#imgp").hide();
                    $("#loginbutton").show();
                });
                </script>';
        }
        
    ?>
    <body>
        <section>
            <nav class="navbar fixed-top navbar-expand-lg" style="background-color:#2d5066">
                    <a class="navbar-brand font-weight-bold" style="color: white;font-size:25px" href="<?php echo base_url('')?>">
                            <img src="<?php echo base_url('assets/img/logoputih.png')?>" width="50" height="50" alt="">
                            KOST SAMBI
                    </a>
                    <button style="background-color:white"  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto ">
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="daftarkankost" href="<?php echo base_url('index.php/WebController/daftarkost')?>" style="color: white;font-size:18px">DAFTARKAN KOST</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="mykost" href="<?php echo base_url('index.php/WebController/mykost')?>" style="color: white;font-size:18px">MY KOST</a>
                            </li>
                            <li class="nav-item" id="loginbutton">
                                <a href="<?php echo base_url("index.php/WebController/index")?>"><button class="btn btn-secondary" style="background-color: #d66565; height:45px;width:100px;font-size:15px;">LOGIN</button></a>
                            </li>
                            <li class="nav-item row">
                                <div class="dropdown col-6" id="dropdown">
                                    <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565; height:50px;width:80px;font-size:15px;" data-toggle="dropdown">
                                    <?php echo $this->session->userdata('username') ?>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= base_url(); ?>index.php/WebController/myprofile_data/<?= $tabel ?>/<?= $username ?>">PROFILE</a>
                                        <a class="dropdown-item" href="<?php echo base_url("index.php/WebController/logout")?>">LOGOUT</a>
                                    </div>
                                </div>
                                <img id="imgp" class="col-6" style="width:60px";height="60px" src="<?php echo base_url('assets/img/user.png')?>">
                            </li>
                        </ul>
                    </div>
                
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
                                    <a class="btn col-3" href="<?= base_url(); ?>index.php/WebController/editkost/<?= $kst['kodekost'];?>">EDIT</a>
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