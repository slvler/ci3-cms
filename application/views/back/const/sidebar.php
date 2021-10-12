<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('username'); ?></a>
            </div>
        </div>
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?php echo site_url() ?>admin" class="nav-link <?php if ($this->uri->segment(1) == "admin") { echo "active"; } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Home Page
                        </p>
                    </a>
                </li>
                <?php foreach ($menu as $stepOne): ?>

                <li class="nav-item <?php if ($this->uri->segment(1) == $stepOne->seo) { echo "menu-open"; } ?>">


                    <a href="#" class="nav-link <?php if ($this->uri->segment(1) == $stepOne->seo) { echo "active"; } ?>">
                        <i class="nav-icon fas fa-circle nav-icon"></i>
                        <p>
                            <?php echo $stepOne->name; ?>

                            <?php foreach ($select_join as $join): ?>
                                <?php if ($join->menu_id == $stepOne->id ): ?>
                                    <i class="right fas fa-angle-left"></i>

                                <?php break; endif; ?>
                            <?php endforeach; ?>
                        </p>
                    </a>

                    <?php foreach ($select_join as $join): ?>
                        <?php if ($join->menu_id == $stepOne->id ): ?>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url(); ?><?php echo $join->submenu_seo; ?>" class="nav-link ">
                                        <i class="fas fa-circle nav-icon "></i>
                                        <p><?php echo $join->submenu_name; ?></p>
                                    </a>
                                </li>
                            </ul>

                        <?php endif; ?>
                    <?php endforeach; ?>


                </li>

                <?php endforeach; ?>

                <li class="nav-item">
                    <a href="<?php echo base_url('logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Logut
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>