<html>
    <head>
        <title>Hanya Di Kost Sambi</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style>
            .jumbo1{
                background-image : url('<?php echo base_url('assets/img/tampilan1-01.jpg')?>');
                height: 100%;
                width: 100%;
                background-size: cover;
                margin-bottom: 0;
            }
            .jumbo2{
                background-image : url('<?php echo base_url('assets/img/tampilan2-02.jpg')?>');
                height: 100%;
                width: 100%;
                background-size: cover;
                margin-bottom: 0;
            }
            .jumbo3{
                background-color: #2d5066;
                margin: 0;
            }
            .search{
                position: relative;
                top: 50%;
                transform: translateY(-50%);
                height: 130px;
            }
            .infokost{
                position: relative;
                top: 50%;
                transform: translateY(-50%);
            }
            .infogambar{
                width: 100%;
                height: 100%;
            }
            .border{
                color: #2d5066;
            }
            .form-control{
                border-color: #2d5066;
                border-width: 2px;
            }
            .h6{
                color: #2d5066;
            }
        </style>
    </head>
    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('repassword').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }
    </script>
    <?php 
        if($this->session->flashdata('daftar_alert')=='registrasi_berhasil'){
            echo "<script>alert('Registrasi Succes');</script>";
        }
        else if($this->session->flashdata('daftar_alert')=='registrasi_gagal'){
            echo "<script>alert('USERNAME DUPLICATE');</script>";
        }
    ?>
    <?php 
        if ($this->session->flashdata('daftarkost_alert')=='notlogin'){
            echo "<script>alert('Silahkan melakukan login terlebih dahulu ');</script>";
        }
    ?>
    <?php 
        if ($this->session->flashdata('login_alert')=='login_berhasil'){
            echo "<script>alert('Login Berhasil');</script>";
        }else if($this->session->flashdata('login_alert')=='login_gagal'){
            echo "<script>alert('Login Gagal, username atau password salah');</script>";
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
                });
                </script>';
        }
    ?>
    
    <body>
        <section>
            <nav class="navbar fixed-top navbar-expand-sm" style="background-color:#76c2d6">
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
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter"  style="background-color: #d66565;">LOGIN</button>
                        </li>
                        <li class="nav-item" id="afterlogin">
                            <div class="dropdown">
                                <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565;" data-toggle="dropdown">
                                HAI <?php echo $this->session->userdata('username') ?>
                                </a>
                                <div class="dropdown-menu">
                                    
                                    <a href="<?= base_url(); ?>index.php/WebController/myprofile_data/<?= $tabel ?>/<?= $username ?>" class="dropdown-item">PROFILE</a>
                                    <a class="dropdown-item" href="<?php echo base_url("index.php/WebController/logout")?>">LOGOUT</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <ul class="nav nav-tabs nav-fill">
                                <li class="nav-item">
                                    <a style="color:#2d5066" class="nav-link" data-toggle="tab" href="#tabregis">REGISTRASI</a>
                                </li>
                                <li class="nav-item">
                                    <a style="color:#2d5066" class="nav-link active" data-toggle="tab" href="#tablogin">LOGIN</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tablogin">
                                    <div class="text-center">
                                        <img src="<?php echo base_url('assets/img/logo-01.png')?>">
                                        <h3 style="color:#2d5066">Masuk Ke Kost Sambi</h3>
                                    </div>
                                    <form action="<?php echo base_url('index.php/WebController/login_data')?>" method="post">
                                        <div class="form-group row">
                                            <label class="col-2"><img style="height:50px;width:50px" src="<?php echo base_url('assets/img/user.png')?>" ></label>
                                            <input type="text" class="form-control col-9" name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2"><img style="height:50px;width:50px" src="<?php echo base_url('assets/img/key.png')?>" ></label>
                                            <input type="password" class="form-control col-9" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" style="background-color:#2d5066;color :white" class="btn col-12">LOGIN</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tabregis">
                                    <form action="<?php echo base_url('index.php/WebController/daftarakun_data')?>" method="post" enctype="multipart/form-data">
                                        <div class="text-center">
                                            <img src="<?php echo base_url('assets/img/logo-01.png')?>">
                                            <h3 style="color:#2d5066">Bergabung Bersama Kost Sambi</h3>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>NAMA LENGKAP</h6></label>
                                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Anda" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>NO IDENTITAS</h6></label>
                                            <input type="text" class="form-control" name="noidentitas" placeholder="Masukkan No KTP/SIM" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>NO REKENING</h6></label>
                                            <input type="text" class="form-control" name="norek" placeholder="Masukkan No Rekening" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>EMAIL</h6></label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>USERNAME</h6></label>
                                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>PASSWORD</h6></label>
                                            <input type="password" class="form-control" id="password" name="password" onkeyup='check();' placeholder="Masukkan Password Anda" required>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>KONFIRMASI PASSWORD</h6></label>
                                            <input type="password" id="repassword" name="repassword" onkeyup='check();' class="form-control" placeholder="Masukkan Konfirmasi Password Anda" required>
                                            <span id='message'></span>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>DAFTAR SEBAGAI</h6></label>
                                            <select class="form-control" name="sebagai" required>
                                                <option>PEMILIK KOST</option>
                                                <option>PENCARI KOST</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center">
                                            <label><h6>CONTACT</h6></label>
                                            <input type="text" class="form-control" name="contact" placeholder="Masukkan No HP Anda" required>
                                        </div>
                                        <button type="submit" style="background-color:#2d5066;color :white" class="btn col-12">REGISTRASI</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="jumbotron jumbotron-fluid jumbo1">
                <div class="container rounded display-4 search" style="background-color:#2d5066">
                    <form action="<?php echo base_url('index.php/WebController/search_kost')?>" method="post">
                        <div class="form-group">
                            <label for="search" style="color:white">Pilih Kost</label>
                            <input type="search" class="form-control" id="search" name="keyword" placeholder="Cari Alamat Kost Yang Diinginkan">
                        </div>
                        <button type="submit" hidden>HAI</button>
                    </form>
                </div>
            </div>
        </section>
        <section>
            <div class="jumbotron jumbotron-fluid jumbo2">
                <div class="container infokost">
                    <img class="infogambar" src="<?php echo base_url('assets/img/info1-01.png')?>">
                </div>
            </div>
        </section>
        <section>
            <div class="jumbotron jumbotron-fluid jumbo3">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-5"></div>
                    <h3 class="lead text-center" style="color:white">Rekomendasi Untuk Anda</h3>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <div id="kost1" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#kost1" data-slide-to="0" class="active"></li>
                                    <li data-target="#kost1" data-slide-to="1"></li>
                                    <li data-target="#kost1" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost1.jpg')?>" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost2.jpg')?>" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost3.jpg')?>" alt="Third slide">
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
                        
                        <div class="col-4">
                            <div id="kost2" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#kost2" data-slide-to="0" class="active"></li>
                                    <li data-target="#kost2" data-slide-to="1"></li>
                                    <li data-target="#kost2" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost1.jpg')?>" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost2.jpg')?>" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost3.jpg')?>" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#kost2" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#kost2" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div id="kost3" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#kost3" data-slide-to="0" class="active"></li>
                                    <li data-target="#kost3" data-slide-to="1"></li>
                                    <li data-target="#kost3" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost1.jpg')?>" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost2.jpg')?>" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?php echo base_url('assets/img/kost3.jpg')?>" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#kost3" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#kost3" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>   
            <nav class="navbar navbar-expand-lg" style="background-color:white">
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