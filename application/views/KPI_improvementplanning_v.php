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
                        Improvement Planning
                        <small></small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">

                                    <h3 class="box-title">List Departement</h3>

                                    <div class="col-md-3  pull-right">
                                        <form method="post" action="<?php echo base_url(); ?>index.php/KPI_improvementplanning_c">
                                            <select class="form-control" name="tahun" onchange="this.form.submit();">
                                                <?php
                                                foreach ($tahunlist as $thn) {
                                                    ?>
                                                    <option 
                                                        value="<?php echo $thn->periode; ?>"  
                                                        <?php if($tahun == $thn->periode){echo 'selected';}?>
                                                        >
                                                        <?php echo $thn->periode; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </form>
                                    </div>


                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <?php // echo $pesan;  ?>

                                    <h2 class="text-center">Improvement Planning</h2>
                                    <h4 class="text-center">Periode Th. <?php echo $tahun; ?></h4><br>
                                    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Divisi</th>
                                                <th>Departement</th>
                                                <th>Head of Department</th>
                                                <th>Jumlah Improvement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($departemen as $key) {
                                                $no++;
                                                ?>
                                                <tr>
                                                    <td style="width: 15%;background-color:<?php echo $key->color; ?>" class="text-center"><strong><?php echo $key->namaDivisi; ?></strong></td>
                                                    <td><?php echo $key->namaDepartemen; ?></td>
                                                    <td><?php echo $key->nama; ?></td>
                                                    <td style="width: 10%" class="text-center"><b><?php echo $key->jmlhImprovement; ?></b></td>

                                                    <td style="width: 20%">
                                                        <a href="<?php echo base_url(); ?>index.php/KPI_improvementplanning_c/viewPlanning/<?php echo $key->id; ?>/<?php echo $tahun; ?>">
                                                            <button type="button" class="btn btn-sm btn-primary">View Planning</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

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
        <script>
            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    "iDisplayLength": 50
                } );
            } );
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>