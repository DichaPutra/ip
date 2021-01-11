<?php ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Improvement Planning</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">

        <!--Font Awesome--> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/fontawesome/css/font-awesome.min.css">
        <!--Ionicons--> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/ionicons/css/ionicons.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css">

        <!-- DataTables -->
        <!--<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/responsive.bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>rdatatable/rowReorder.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>rdatatable/responsive.dataTables.min.css">



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
                            <p>Tim KPI</p>
                            <!-- Status -->
                            <a href="#">Departemen KPI</a>
                        </div>
                    </div>
                    <?php include 'sidebar_kpi.php'; ?>

                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Realization Detail
                        <small></small>
                    </h1>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Realization Progress</a></li>
                        <li class="breadcrumb-item"><a href="#">Realization Detail</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Improvement</h3>
                                    <a href="<?php echo base_url(); ?>index.php/KPI_realizationprogress_c/cetakPDF/<?php echo $iddepartemen; ?>/<?php echo $tahun; ?>">
                                        <button class="btn btn-default pull-right"> <i class="fa fa-print" aria-hidden="true"></i>  PDF</button>
                                    </a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <?php // echo $pesan; ?>
                                    <h2 class="text-center"><?php echo $departemen; ?></h2>
                                    <h4 class="text-center">Periode Tahun <?php echo $tahun; ?></h4>
                                    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>

                                                <th>No</th>
                                                <th>Improvement</th>
                                                <th>Kendala</th>
                                                <th>Status</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($improvement as $key) {
                                                $no++;
                                                ?>
                                                <tr>
                                                    <td class="text-center" style="width: 3%"><?php echo $no; ?></td>
                                                    <td>                                                        <!--<button type="button" class="btn btn-sm btn-primary" >Edit</button>-->
                                                        <a data-toggle="modal" data-target="#Detil<?php echo $key->id; ?>">
                                                            <?php
                                                            if (strlen($key->judul_improvement) > 75) {
                                                                $ringkas = substr($key->judul_improvement, 0, 75);
                                                                echo $ringkas."...";
                                                                
                                                            } else {
                                                                echo $key->judul_improvement;
                                                            }
                                                            ?>
                                                        </a>
                                                        <?php
                                                        if ($key->periode != date('Y')) {
                                                            echo "<span class=\"label label-warning\">Lanjutan</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="width: 5%" class="text-center">
                                                        <?php
                                                        if ($key->kendalaRealisasi == NULL) {
                                                            echo '<small>Tidak Ada</small>';
                                                        } else {
                                                            ?>
                                                            <a data-toggle="modal" data-target="#Kendala<?php echo $key->id; ?>">
                                                                <button class="btn btn-info btn-xs">Lihat Kendala</button>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="width: 5%">
                                                        <div class="text-center" >
                                                            <?php
                                                            if ($key->persentaseCapaian == NULL || $key->persentaseCapaian == 0) {
                                                                echo "<span class=\"label label-danger\">Belum Start</span>";
                                                            } elseif ($key->persentaseCapaian == "100") {
                                                                echo "<span class=\"label label-success\">Completed</span>";
                                                            } else {
                                                                echo "<span class=\"label label-warning\">In Progress</span>";
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%">
                                                        <div class="progress text-center" >
                                                            <?php
                                                            if ($key->persentaseCapaian == NULL) {
                                                                $persentase = "0%";
                                                                echo "0%";
//                                                                echo "<span class=\"label label-danger\">Belum Ada Progress</span>";
                                                            } elseif ($key->persentaseCapaian == "100") {
                                                                $persentase = $key->persentaseCapaian . "%";
                                                                echo "<div class=\"progress-bar progress-bar-success progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"5\" aria-valuemin=\"0\" aria-valuemax=\"6\" style=\"width: $persentase; \">" . $persentase;
                                                            } else {
                                                                $persentase = round($key->persentaseCapaian, 2) . "%";
                                                                echo "<div class=\"progress-bar progress-bar-warning progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"5\" aria-valuemin=\"0\" aria-valuemax=\"6\" style=\"width: $persentase; \">" . $persentase;
                                                            }
                                                            ?>
                                                        </div>
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
                                                                Kode : 
                                                            </label>
                                                            <p><?php echo sprintf("%04s", $key->id); ?>-<?php echo sprintf("%03s", $key->Departemen_id); ?>-<?php echo $key->periode; ?></p><hr>
                                                            <label>
                                                                Judul Improvement : 
                                                            </label>
                                                            <p class="text-justify"><?php echo $key->judul_improvement; ?></p><hr>
                                                            <label>
                                                                Detail Improvement :  <br>
                                                            </label>
                                                            <p class="text-justify"><?php echo $key->improvement; ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Detil<?php echo $key->id; ?>">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Modal Kendala-->
                                            <div id="Kendala<?php echo $key->id; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <input type="hidden" name="idImprovement" value="<?php echo $key->id; ?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-center">Kendala</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-justify"><?php echo $key->kendalaRealisasi; ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Kendala<?php echo $key->id; ?>">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end of modal detil improvement-->
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>

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

        <!--<script src="plugins/datatables/jquery.dataTables.min.js"></script>-->
        <script src="<?php echo base_url(); ?>rdatatable/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>rdatatable/dataTables.rowReorder.min.js"></script>
        <script src="<?php echo base_url(); ?>rdatatable/dataTables.responsive.min.js"></script>


        <!-- page script -->
        <!-- page script -->
        <script>
            $(function () {
                $("#example").DataTable();
            });
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>