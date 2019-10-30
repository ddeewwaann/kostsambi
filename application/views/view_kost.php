<html>
    <head>
        <title>Hanya Di Kost Sambi</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        
        <style>
            .carousel-item{
                height: 500px;
            }
            .carousel-item img{
                height: 500px;
                object-fit: contain;
            }
            .carousel{
                background-color: #2d5066;
            }
            .body{
                color: #2d5066;
            }
            .harga{
                border-style: solid;
                border-color: #2d5066;
                border-width: 3px;
                height: 150px;
                width: 330px;
            }
            .separator{
                border-style: solid;
                height: 3px;
                color: #2d5066
            }
        </style>
    </head>
    
    <?php 
        if($this->session->flashdata('reservasi_alert')=='notlogin'){
            echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
        }
        else if($this->session->flashdata('reservasi_alert')=='berhasil'){
            echo "<script>alert('Reservasi Sedang di Verifikasi, Notifikasi Akan Dikirimkan Lewat Email');</script>";
        }
        else if($this->session->flashdata('reservasi_alert')=='gagal'){
            echo "<script>alert('Reservasi Gagal, Silahkan Cek Kembali Ketersediaan Kamar');</script>";
        }
    ?>
    
    <?php
        if(($this->session->userdata('logged_in')==1) && ($this->session->userdata('role')==1)){
            echo '<script>
                $(document).ready(function(){
                    $("#loginbutton").hide();
                    $("#afterlogin").show();
                    $("#daftarkankost").hide();
                    $("#mykost").hide();
                    $("#reservasi").show();
                    $("#kode").hide();
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
                    $("#reservasi").hide();
                    $("#kode").show();
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
                    $("#loginbtn").show();
                    $("#reservasi").show();
                    $("#kode").hide();
                });
                </script>';
        }
        
    ?>
    <body>
        <section>
            <nav class="navbar fixed-top navbar-expand-sm" style="background-color:#C6E6F1">
                <div class="collapse navbar-collapse">
                    <a class="navbar-brand font-weight-bold" style="color: #2d5066;font-size:25px" href="<?php echo base_url('')?>">
                        <img src="<?php echo base_url('assets/img/logo-01.png')?>" width="50" height="50" alt="">
                        KOST SAMBI
                    </a>
                    <ul class="navbsar-nav mr-auto ">
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="daftarkankost" href="<?php echo base_url('index.php/WebController/daftarkost')?>" style="color: #2d5066;font-size:18px">DAFTARKAN KOST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="mykost" href="<?php echo base_url('index.php/WebController/mykost')?>" style="color: #2d5066;font-size:18px">MY KOST</a>
                        </li>
                        <li class="nav-item" id="loginbutton">
                            <a href="<?php echo base_url('index.php/WebController/index')?>"><button type="button" class="btn btn-secondary" style="background-color: #d66565;">LOGIN</button></a>
                        </li>
                        <li class="nav-item" id="afterlogin">
                            <div class="dropdown">
                                <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565;" data-toggle="dropdown">
                                 <?php echo $this->session->userdata('username') ?>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item">PROFILE</a>
                                    <a class="dropdown-item" href="<?php echo base_url("index.php/WebController/logout")?>">LOGOUT</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>
      
        <br>
        <br>
        <br>
        <section class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                            <div id="kost1" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#kost1" data-slide-to="0" class="active"></li>
                                    <li data-target="#kost1" data-slide-to="1"></li>
                                    <li data-target="#kost1" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo base_url($view_kost[0]['foto'])?>" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url($view_kost[0]['foto2'])?>" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url($view_kost[0]['foto3'])?>" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#kost1" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#kost1" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-7">
                        <h3>NAMA KOST</h3>
                        <h5><?= $view_kost[0]['namakost'];?></h5>
                        <div class="separator"></div>
                        <br>
                        <div id="kode">
                            <h3>KODE KOST</h3>
                            <h5><?= $view_kost[0]['kodekost'];?></h5>
                            <div class="separator"></div>
                        </div>
                        <br>
                        <h3>JENIS KOST</h3>
                        <h5><?= $view_kost[0]['jenis'];?></h5>
                        <div class="separator"></div>
                        <br>
                        <h3>FASILITAS</h3>
                        <h5><?= $view_kost[0]['fasilitas'];?></h5>
                        <div class="separator"></div>
                        <br>
                        <h3>JUMLAH KAMAR TERSISA</h3>
                        <h5><?= $view_kost[0]['jumlahkamar'];?> KAMAR</h5>
                        <div class="separator"></div>
                    </div>
                    <div class="col-3">
                        <div class="harga text-center">
                            <h2>RP <?= $view_kost[0]['harga'];?>/TAHUN</h2>
                            <h2>RP <?= ceil($view_kost[0]['harga']/12);?>/BULAN</h2>
                            <a><button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter" id="reservasi" style="width:300px;background-color:#2d5066">RESERVASI</button></a>
                        </div>
                        <br>
                        <h2>LOKASI</h2>
                        <a target="_blank" href="https://www.google.com/maps/place/<?= $view_kost[0]['alamat'];?>"><img style="width:300px; height:200px" src="<?php echo base_url('assets/img/gmaps.jpeg')?>"></a>
                        <h5><?= $view_kost[0]['alamat'];?></h5>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>
        <section>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2d5066;color:white">
                            <h5 class="modal-title" id="exampleModalLongTitle">Silahkan Transfer Ke Kost Sambi Dengan Rekening 1301174134 Sebesar RP <?= ceil($view_kost[0]['harga']/12);?> </h5>
                                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('index.php/WebController/add_reservasi')?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <h6><label>Silahkan Upload Bukti Pembayaran</label></h6>
                                    <input type="text" name="username" value="<?= $this->session->userdata('username'); ?>" hidden>
                                    <input type="text" name="email" value="<?= $this->session->userdata('email'); ?>" hidden>
                                    <input type="text" name="kodekost" value="<?= $view_kost[0]['kodekost'];?>" hidden>
                                    <input type="text" name="nominal" value="<?= ceil($view_kost[0]['harga']/12);?>" hidden>
                                    <input type="text" name="jumlahkamar" value="<?= $view_kost[0]['jumlahkamar'];?>" hidden>
                                    <input type="file" name="userfile" size="100" required >
                                </div>
                                <button type="button" style="background-color:#2d5066;float:right;border-color:white" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="upload" style="background-color:#2d5066;color :white; float:right;border-color:white" class="btn btn-primary">SUBMIT</button>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>   
            <nav class="navbar navbar-expand-lg" style="background-color:#C6E6F1">
                <div class="collapse navbar-collapse">
                    <a class="navbar-brand font-weight-bold" style="color: #2d5066;font-size:25px" href="#">
                        <img src="<?php echo base_url('assets/img/logo-01.png')?>" width="50" height="50" alt="">
                        KOST SAMBI
                    </a>
                </div>
            </nav>         
        </section>
    </body>
</html>