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
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter"  style="background-color: #d66565;">LOGIN</button>
                        </li>
                        <li class="nav-item" id="afterlogin">
                            <div class="dropdown">
                                <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565;" data-toggle="dropdown">
                                HAI <?php echo $this->session->userdata('username') ?>
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
        <br>
        <br>
        
        <section>
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
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <p>KOST <?= $view_kost[0]['jenis'];?></p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>