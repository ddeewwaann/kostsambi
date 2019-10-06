<html>
    <head>
        <title>Hanya Di Kost Sambi</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo-01.png')?>" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <script type="text/javascript"charset="utf8"src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

        <style>
            #sidebar-wrapper {
                height: 1000px;
                background-color: #2d5066;
            }
            .aa{
                background-color: #2d5066;
                color: white;
            }
            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }
        </style>
    </head>
    <script>
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
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
        <section>
            <div class="d-flex" id="wrapper">
                <div class="border-right" id="sidebar-wrapper">
                    <div class="sidebar-heading ">Start Bootstrap </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action aa">Dashboard</a>
                            <a href="<?php echo base_url("index.php/WebController/admin")?>" class="list-group-item list-group-item-action aa">PENCARI</a>
                            <a href="<?php echo base_url("index.php/WebController/admin_pemilik")?>" class="list-group-item list-group-item-action aa">PEMILIK</a>
                            <a href="<?php echo base_url("index.php/WebController/admin_listkost")?>" class="list-group-item list-group-item-action aa">LIST KOST</a>
                        </div>
                </div>
                <div class="container-fluid">
                    <h1 class="mt-4">hai</h1>
                    <br><br>
                    <div class="row">
                        <div class="col-11">
                            <table class="table display" id="table">
                                <thead style="background-color:#2d5066;color:white">
                                    <tr>
                                        <th scope="col">NAMA KOST</th>
                                        <th scope="col">KODE KOST</th>
                                        <th scope="col">ALAMAT</th>
                                        <th scope="col">FASILITAS</th>
                                        <th scope="col">HARGA</th>
                                        <th scope="col">JENIS</th>
                                        <th scope="col">PEMILIK</th>
                                        <th scope="col">CONTACT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($kost as $kst) : ?>
                                                <td><?= $kst['namakost'];?></td>
                                                <td><?= $kst['kodekost'];?></td>
                                                <td><?= $kst['alamat'];?></td>
                                                <td><?= $kst['fasilitas'];?></td>
                                                <td><?= $kst['harga'];?></td>
                                                <td><?= $kst['jenis'];?></td>
                                                <td><?= $kst['namapemilik'];?></td>
                                                <td><?= $kst['contact'];?></td>
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