<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <title>Improvement Planning</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">

        <!--Font Awesome--> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/fontawesome/css/font-awesome.min.css">
        <!--Ionicons--> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/ionicons/css/ionicons.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="#" class="logo" style="background-color: #1A2226;">
                    <!--<img style="margin: 0 auto; height: 80%; margin-top: 2%" class="img-responsive" src="dist/img/pakerin.gif">-->

                    <!--mini logo for sidebar mini 50x50 pixels--> 
                    <span class="logo-mini"><b style="font-size: small; color: white;">I</b><b style="font-size: small; color: #3597E0;">Plan</b></span>
                    <!--logo for regular state and mobile devices--> 
                    <span class="logo-sm">
                        <b style="font-size: small; color: white;">IMPROVEMENT</b>
                        <b style="font-size: small; color: #3597E0;"> PLANNING</b> 
                    </span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                                <!-- Menu toggle button -->

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>-->
                                    <?php
                                    echo date('l, d-m-Y');
                                    ;
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>dist/img/pakerin.gif" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $nama; ?></p>
                            <!-- Status -->
                            <a href="#"><?php echo $namaDepartemen; ?></a>
                        </div>
                    </div>

                    <?php include 'sidebar_dept.php'; ?>

                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Rencana Improvement
                        <small></small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Improvement List</h3> 
                                    <a href="<?php echo base_url(); ?>index.php/DEP_rencanaimprovement_c/cetakPDF/<?php echo $iddepartemen; ?>/<?php echo $tahun; ?>">
                                        <button class="btn btn-default pull-right"> <i class="fa fa-print" aria-hidden="true"></i>  PDF</button>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#kriteria" >
                                        <button class="btn btn-default pull-right" style="margin-right: 5px"> <i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                    </a>
                                                    <!--<button class="btn btn-default pull-right"> <i class="fa fa-print" aria-hidden="true"></i>  PDF</button>-->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="alert" style="background-color: #D2D2D2"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><b style="color: red;">Perhatian :</b><br>
                                        <p style="color: red;">
                                            - Click button <i class="fa fa-info-circle" aria-hidden="true"></i> sebelah botton print di pojok kanan atas untuk detil informasi pengisian improvement<br>
                                            - Cek ulang hasil improvement yang telah anda inputkan dengan cara click judul improvement yang telah di inputkan
                                    </div>

                                    <?php echo $pesan; ?>
                                    <?php // var_dump($improvement); ?>
                                    <h2 class="text-center">Rencana Improvement</h2>
                                    <h4 class="text-center">Periode Tahun <?php echo date('Y') + 1; ?></h4>
                                    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Kode</th>
                                                <th>Improvement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($improvement as $key) {
                                                $no++;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no; ?></td>
                                                    <td><?php echo sprintf("%04s", $key->id); ?>-<?php echo sprintf("%03s", $key->Departemen_id); ?>-<?php echo $key->periode; ?></td>
                                                    <td>
                                                        <!--<button type="button" class="btn btn-sm btn-primary" >Edit</button>-->
                                                        <a data-toggle="modal" data-target="#Detil<?php echo $key->id; ?>"><?php echo $key->judul_improvement; ?></a>
                                                    </td>
                                                    <td class="text-center"> 
                                                        <?php
                                                        if ($setting4 == "off") {
                                                            echo '<b>< disabled ><b>';
                                                        } else {
                                                            ?>
                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal<?php echo $key->id; ?>">Edit</button>
                                                            <a href="<?php echo base_url(); ?>index.php/DEP_rencanaimprovement_c/deleteImprovement/<?php echo $key->id; ?>"><button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus improvement tersebut ?');">&#x274c</button></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <!--Modal Detil Improvement-->
                                            <div id="Detil<?php echo $key->id; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <input type="hidden" name="idImprovement" value="<?php echo $key->id; ?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-center">Detail Improvement</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label>
                                                                Judul Improvement : 
                                                            </label>
                                                            <p class="text-justify"><?php echo $key->judul_improvement; ?></p><hr>
                                                            <label>
                                                                Detail Improvement :  <br>
                                                            </label>
                                                            <xmp style="white-space:pre-wrap; word-wrap:break-word;"><?php echo $key->improvement; ?></xmp>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Detil<?php echo $key->id; ?>">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit -->
                                            <div id="myModal<?php echo $key->id; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="<?php echo base_url(); ?>index.php/DEP_rencanaimprovement_c/editImprovement"> 
                                                            <input type="hidden" name="idImprovement" value="<?php echo $key->id; ?>">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Edit Improvement</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Judul Improvement</label>
                                                                    <input name="juduledit"type="text" class="form-control" placeholder="" maxlength="110" value="<?php echo $key->judul_improvement; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Detail Improvement</label>
                                                                    <textarea name="editan" class="form-control" rows="15" maxlength="5000"><?php echo $key->improvement; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal<?php echo $key->id; ?>">Cancel</button>
                                                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal">OK</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>

                                    <br>
                                    <?php
                                    if ($setting4 == "off") {
                                        echo ' ';
                                    } else {
                                        ?>
                                        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalADD">ADD</a>
                                        <?php
                                    }
                                    ?>
                                        
                                    <!-- Modal ADD -->
                                    <div id="modalADD" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form method="POST" action="<?php echo base_url(); ?>index.php/DEP_rencanaimprovement_c/addImprovement"> 
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Add Improvement</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        </p>
                                                        <!--<p style="color: red;"> </p><br>-->
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Judul Improvement</label>
                                                            <input type="text" name="jdl_improvement" class="form-control" placeholder="" maxlength="110">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Detail Improvement</label>
                                                            <textarea rows="15"name="improvement" onkeyup="textCounter(this,'counter',5000);" id="message" class="form-control" rows="4" maxlength="5000"></textarea>
                                                            <div class=""><input disabled  maxlength="3" size="3" value="5000" id="counter">/5000</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalADD">Cancel</button>
                                                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalADD">SUBMIT</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Kriteria Penilaian -->
                                    <div id="kriteria" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form method="POST" action="<?php echo base_url(); ?>index.php/DEP_rencanaimprovement_c/addImprovement"> 
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center">Ketentuan Pengisian Rencana Improvement & Kriteria Penilaian</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <br><br>
                                                        <p> Komponen - komponen apa saja yang diinputkan pada kolom "Detail Improvement" : </p>
                                                        <ol>
                                                            <li>Diharapkan mencantumkan kondisi sebelum improvement</li>
                                                            <li>Mencantumkan masalah yang diselesaikan (Identifikasi Masalah)</li>
                                                            <li>Mencantumkan dampak / manfaat direalisasikanya improvement (Goal / Target Objective)</li>
                                                            <li>Melengkapi langkah-langkah pelaksanaan dengan jelas</li>
                                                            <li>Mencantumkan kebutuhan Manpower</li>
                                                            <li>Mencantumkan perkiraan budgeting</li>
                                                        </ol><br>

                                                        <p> Kriteria Penilaian Rencana Improvement : </p>
                                                        <ol>
                                                            <li>Kreativitas Solusi</li>
                                                            <li>Detail Perencanaan</li>
                                                            <li>Tingkat Masalah yang diselesaikan</li>
                                                        </ol> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!--<button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalADD">SUBMIT</button>-->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>

                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">

                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2017 TIM KPI <a href="http://pakerin.co.id">PT. PAKERIN</a>.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->


        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url(); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url(); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url(); ?>dist/js/demo.js"></script>


        <!-- page script -->
        <script>
            $(function () {
                $("#example").DataTable();
            });
        </script>
        <script>
            function textCounter(field,field2,maxlimit)
            {
                var countfield = document.getElementById(field2);
                if ( field.value.length > maxlimit ) {
                    field.value = field.value.substring( 0, maxlimit );
                    return false;
                } else {
                    countfield.value = maxlimit - field.value.length;
                }
            }
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>

