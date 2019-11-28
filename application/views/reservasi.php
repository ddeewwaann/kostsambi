<html>
    <head>
    <title>Hanya Di Kost Sambi</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <script type="text/javascript"charset="utf8"src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    </head>

    <script>
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>

    <?php
        if(($this->session->userdata('logged_in')==1) && ($this->session->userdata('role')==1)){
            echo '<script>
                $(document).ready(function(){
                    $("#loginbutton").hide();
                    $("#afterlogin").show();
                    $("#daftarkankost").hide();
                    $("#mykost").hide();
                    $("#admin").hide();
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
                    $("#admin").hide();
                });
                </script>';
            $tabel = 'pemilik';
            $username = $this->session->userdata('username');
        }
        else if(($this->session->userdata('logged_in')==1) && ($this->session->userdata('role')==3)){
            echo '<script>
                $(document).ready(function(){
                    $("#loginbutton").hide();
                    $("#afterlogin").show();
                    $("#daftarkankost").hide();
                    $("#mykost").hide();
                    $("#profile").hide();
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
            <nav class="navbar fixed-top navbar-expand-lg" style="background-color:#2d5066">
                <a class="navbar-brand font-weight-bold" style="color: white;font-size:25px" href="<?php echo base_url('')?>">
                    <img src="<?php echo base_url('assets/img/logoputih.png')?>" width="50" height="50" alt="">
                    KOST SAMBI
                </a>
                <button style="background-color:#2d5066"  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter"  style="background-color: #d66565;">LOGIN</button>
                        </li>
                        <li class="nav-item" id="afterlogin">
                            <div class="dropdown">
                                <a class="dropdown-toggle btn btn-secondary" style="background-color: #d66565;height:50px;width:80px;font-size:15px;" data-toggle="dropdown">
                                    <?php echo $this->session->userdata('username') ?>
                                </a>
                                <div class="dropdown-menu">
                                    
                                    <a id="profile" href="<?= base_url(); ?>index.php/WebController/myprofile_data/<?= $tabel ?>/<?= $username ?>" class="dropdown-item">PROFILE</a>
                                    <a id="admin" class="dropdown-item" href="<?php echo base_url("index.php/AdminController/admin")?>">ADMIN</a>
                                    <a class="dropdown-item" href="<?php echo base_url("index.php/WebController/logout")?>">LOGOUT</a>
                                    
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>
        <section>
        <div class="container-fluid">
                    <h1 class="mt-4">hai</h1>
                    <br><br>
                    <div class="row">
                        <div class="col-12">
                            <table class="table display" id="table">
                                <thead style="background-color:#2d5066;color:white">
                                    <tr>
                                        <th scope="col">FOTO</th>
                                        <th scope="col">NO</th>
                                        <th scope="col">USERNAME PENCARI</th>
                                        <th scope="col">EMAIL PENCARI</th>
                                        <th scope="col">KODE KOST</th>
                                        <th scope="col">SISA KAMAR</th>
                                        <th scope="col">NOMINAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($reservasi as $rsv) : ?>
                                            <td><button><img style="height:100px;width:200px;" src="<?php echo base_url($rsv['foto'])?>" data-toggle="modal" data-target="#exampleModalCenter"></button></td>
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-       labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">BUKTI TRANSFER</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <img style="height:500px;width:750px;"  src="<?php echo base_url($rsv['foto'])?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td><?= $rsv['no'];?></td>
                                            <td><?= $rsv['username'];?></td>
                                            <td><?= $rsv['email'];?></td>
                                            <td><?= $rsv['kodekost'];?></td>
                                            <td><?= $rsv['jumlahkamar'];?></td>
                                            <td><?= $rsv['nominalreservasi'];?></td>
                                            
                                    </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>