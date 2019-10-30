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
            .foto{
                width: 50px;
                height: 100px;
            }
            .content{
                font-size: 35px;
            }
            .header1{
                border-bottom-width: 0px;
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
                    $("#loginbutton").show();
                    $("#dropdown").hide();
                });
                </script>';
        }
        
    ?>
    
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
                        <li class="nav-item" id="loginbutton">
                            <a href="<?php echo base_url("index.php/WebController/index")?>"><button class="btn btn-secondary" style="background-color: #d66565; height:45px;width:100px;font-size:15px;">LOGIN</button></a>
                        </li>
                        <li class="nav-item row">
                            <div class="dropdown col-6" id="dropdown">
                                <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565; height:50px;width:80px;font-size:15px;" data-toggle="dropdown">
                                <?php echo $this->session->userdata('username') ?>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">PROFILE</a>
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
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-7">
                        <?php foreach ($kostan as $kst) : ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5><?= $kst['namakost'];?></h5>
                                        </div>
                                        <div class="col-3">
                                            <h5><?= $kst['harga'];?> /Tahun</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $kst['alamat'];?></h5>
                                    <div class="row">
                                        <img class="col-3 foto" src="<?php echo base_url($kst['foto'])?>">
                                        <a class="btn col-3 content" href="<?= base_url(); ?>index.php/WebController/view_kost_pencari/<?=$kst['kodekost'] ?>">VIEW</a>
                                        <a class="btn col-3 content" data-toggle="modal" data-target="#exampleModalCenter">RESERVASI</a>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <section>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:#2d5066;color:white">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Silahkan Transfer Ke Kost Sambi Dengan Rekening 1301174134 Sebesar RP <?= ceil($kst['harga']/12);?> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('index.php/WebController/add_reservasi')?>" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <h6><label>Silahkan Upload Bukti Pembayaran</label></h6>
                                                    <input type="text" name="username" value="<?= $this->session->userdata('username'); ?>" hidden>
                                                    <input type="text" name="email" value="<?= $this->session->userdata('email'); ?>" hidden>
                                                    <input type="text" name="kodekost" value="<?= $kst['kodekost'];?>" hidden>
                                                    <input type="text" name="nominal" value="<?= ceil($kst['harga']/12);?>" hidden>
                                                    <input type="text" name="jumlahkamar" value="<?= $kst['jumlahkamar'];?>" hidden>
                                                    <input type="file" name="userfile" size="100" required >
                                                </div>
                                                <button type="button" style="background-color:#2d5066;float:right;border-color:white;color:white" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="upload" style="background-color:#2d5066;color :white; float:right;border-color:white" class="btn btn-primary">SUBMIT</button>
                                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>