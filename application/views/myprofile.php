<html>
    <head>
        <title>Hanya Di Kost Sambi</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <style>
            .form-group {
                color: #2d5066;
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
                                    <a href="<?php echo base_url("index.php/WebController/myprofile")?>" class="dropdown-item">PROFILE</a>
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
        <br>
        <br>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url('assets/img/hmm.png')?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $profile[0]['nama'];?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <form action="" method="post">
                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-3">
                                        <label><h3>NAMA LENGKAP</h3></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="nama" value="<?= $profile[0]['nama'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-3">
                                        <label><h3>NO IDENTITAS</h3></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="noidentitas" value="<?= $profile[0]['noidentitas'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-3">
                                        <label><h3>USERNAME</h3></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="username" value="<?= $profile[0]['username'];?>" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-3">
                                        <label><h3>EMAIL</h3></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="email" class="form-control" name="email" value="<?= $profile[0]['email'];?>" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-3">
                                        <label><h3>NO REKENING</h3></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="norek" value="<?= $profile[0]['norekening'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="row">
                                    <div class="col-3">
                                        <label><h3>CONTACT</h3></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="contact" value="<?= $profile[0]['contact'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-3">
                                    <button type="submit" style="background-color:#2d5066;color :white" class="btn col-12">UPDATE</button>
                                </div>
                                <div class="col-3">
                                    <a><button type="submit" style="background-color:#2d5066;color :white" class="btn col-12">CHANGE PASSWORD</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>