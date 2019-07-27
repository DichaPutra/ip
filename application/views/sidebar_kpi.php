<!-- Sidebar Menu -->
<ul class="sidebar-menu">
    <li class="header">Admin KPI</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="treeview">
        <a href="#"><i class="fa fa-area-chart"></i> <span>Score Monitoring</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/KPI_planningscore_c">Planning Score</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/KPI_realizationscore_c">Realization Score</a></li>
        </ul>
    </li>
    <!--<li><a href="kpi_planningscore.php"><i class="fa fa-area-chart"></i> <span>Planning Score</span></a></li>-->
    <li><a href="<?php echo base_url(); ?>index.php/KPI_improvementplanning_c"><i class="fa fa-check-circle"></i> <span>Improvement Planning</span></a></li>
    <li><a href="<?php echo base_url(); ?>index.php/KPI_realizationprogress_c"><i class="fa fa-check-circle"></i> <span>Realization Progress</span></a></li>

    <li class="header">Settings</li>
    <li class="treeview">
        <a href="#"><i class="fa fa-user"></i> <span>Account Management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/KPI_managedivision_c">Manage Division</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/KPI_managedepartement_c">Manage Departments</a></li>
        </ul>
    </li>
    <li><a href="<?php echo base_url(); ?>index.php/KPI_locking_c"><i class="fa fa-lock"></i> <span>Locking</span></a></li>
    <li><a href="<?php echo base_url(); ?>index.php/logout"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
</ul>
<!-- /.sidebar-menu -->