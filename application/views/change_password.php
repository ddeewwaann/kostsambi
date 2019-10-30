<html>
    <head>
        <title>Hanya Di Kost Sambi</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    
    <?php 
        if ($this->session->flashdata('daftarkost_alert')=='notlogin'){
            echo "<script>alert('Silahkan melakukan login terlebih dahulu ');</script>";
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
    
    <?php 
        if ($this->session->flashdata('password_alert')=='repass'){
            echo "<script>alert('Konfirmasi Password Salah');</script>";
        }
        else if($this->session->flashdata('password_alert')=='oldpass'){
            echo "<script>alert('Password Lama Salah');</script>";
        }
    ?>
    
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
                                <?php echo $this->session->userdata('username') ?>
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
        </section>
        <br>
        <br>
        <br>
        <br>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <form action="<?php echo base_url('index.php/WebController/change_password_data')?>" method="post">
                            <div class="form-group text-center">
                                <label><h5>PASSWORD LAMA</h5></label>
                                <input type="password" class="form-control" name="passwordlama" placeholder="Masukkan Password Lama Anda" required>
                                <input type="text" class="form-control" name="table" value="<?= $tabel ?>" hidden>
                            </div>
                            <div class="form-group text-center">
                                <label><h5>PASSWORD BARU</h5></label>
                                <input type="password" class="form-control" id="password" name="passwordbaru" onkeyup='check();' placeholder="Masukkan Password Baru Anda" required>
                            </div>
                            <div class="form-group text-center">
                                <label><h5>KONFIRMASI PASSWORD</h5></label>
                                <input type="password" id="repassword" name="repassword" onkeyup='check();' class="form-control" placeholder="Masukkan Konfirmasi Password Anda" required>
                                <span id='message'></span>
                            </div>
                            <button type="submit" style="background-color:#2d5066;color :white" class="btn col-12">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>