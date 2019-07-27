<!-- Sidebar Menu -->
<ul class="sidebar-menu">
    <li class="header">Division Level</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="treeview">
        <a href="#"><i class="fa fa-area-chart"></i> <span>Scoring</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>index.php/DIV_planningScore_c">Planning Score</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/DIV_realizationScore_c">Realization Score</a></li>
        </ul>
    </li>
    <li><a href="<?php echo base_url(); ?>index.php/DIV_mydepartement_c"><i class="fa fa-check-circle"></i> <span>Department Progress</span></a></li>
    <li><a href="<?php echo base_url(); ?>index.php/logout"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
</ul>
<!-- /.sidebar-menu -->