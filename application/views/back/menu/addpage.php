<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('back/const/header'); ?>



<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>


    <?php $this->load->view('back/const/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $subtitle; ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url() ?><?php echo seolink($breadcrumb); ?>"><?php echo  $breadcrumb; ?></a></li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="menuAddForm" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Menu Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Desc</label>
                                        <input type="text" name="desc" class="form-control" id="exampleInputPassword1" placeholder="Menu Desc">
                                    </div>
                                    <div class="form-group">
                                        <label>Select</label>
                                        <select name="active" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Passive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button onclick="Menu.menuAdd('<?php echo base_url('menu/add_form') ?>','<?php echo base_url('menu') ?>');" type="button" style="float: right;" class="btn btn-primary">Menu Add</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <?php $this->load->view('back/const/footer'); ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php $this->load->view('back/const/script'); ?>

</body>
</html>

