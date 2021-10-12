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

                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Count </h3>
                                <a href="<?php echo site_url('menu/add') ?>"><button class="btn btn-primary btn-xs" style="float: right">Menu Add</button></a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Title</th>
                                        <th>Desc</th>
                                        <th>Active</th>
                                        <th>Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; foreach ($result as $item): ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $item->name; ?></td>
                                            <td><?= $item->desc; ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" <?php if ($item->select == "1") { echo "checked"; } ?> class="toggle custom-control-input" onchange="Category.categoryActive('<?php echo site_url() ?>category/active','<?php echo $item->id; ?>','<?php echo $item->select; ?>','<?php echo base_url('category') ?>')" id="<?php echo $item->id ?>" value="<?php echo $item->id ?>">
                                                        <label class="custom-control-label"  for="<?php echo $item->id ?>"></label>
                                                    </div>
                                                </div>


                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('category/edit') ?>/<?= $item->id; ?>"><button class="btn btn-primary btn-block btn-xs"><i class="fas fa-eye"></i> Edit Page</button></a>
                                                <a href="<?php echo base_url('submenu') ?>/<?= $item->id; ?>"><button class="mt-1 btn btn-warning btn-block btn-xs"><i class="fas fa-list"></i> Submenu Page</button></a>

                                                <a onclick="Category.categoryDelete('<?php echo base_url() ?>/category/delete','<?php echo $item->id ?>','<?php echo base_url() ?>/category');" href="#"><button class="mt-1 btn btn-danger btn-block btn-xs"><i class="fas fa-trash"></i> Delete</button></a>

                                            </td>
                                        </tr>
                                        <?php $i++; endforeach; ?>

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
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

