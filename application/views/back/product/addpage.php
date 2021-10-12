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
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <?php
                                    $data = [];
                                    foreach ($lang as $la){
                                        array_push($data, $la->lang_key);
                                    } ?>



                                    <?php for ($i = 0; $i < count($data); $i++) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($i == "0") { echo "active";  } ?>" id="en-home" data-toggle="pill" href="#<?php echo $data[$i]; ?>" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true"><?php echo $data[$i]; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">


                                    <?php for ($i = 0; $i < count($data); $i++) { ?>
                                        <div class="tab-pane fade <?php if($i == "0") { echo "show active";  } ?>" id="<?php echo $data[$i] ?>" role="tabpanel" aria-labelledby="<?php echo $data[$i] ?>-home">
                                            <div class="col-md-12">
                                                <!-- general form elements -->
                                                <div class="card card-primary">
                                                    <!--
                                                  <div class="card-header">
                                                      <h3 class="card-title">Quick Example</h3>
                                                  </div>
                                                /.card-header -->
                                                    <!-- form start -->
                                                    <form id="productAddForm-<?php echo $data[$i]; ?>" method="post">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <select onchange="Product.productcategoryselect('<?php echo base_url() ?>product/category_select')" id="category" name="category[<?php echo $data[$i]; ?>]" class="form-control">
                                                                   <?php foreach ($category as $cate ) { ?>
                                                                        <option value="<?php echo $cate->id; ?>"><?php echo $cate->title; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label>Subcategory</label>
                                                                    <select id="subcategory" name="subcategory[<?php echo $data[$i]; ?>]" class="form-control">
                                                                            <option id="ProductDate" value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Title</label>
                                                                <input type="text" name="title[<?php echo $data[$i]; ?>]" class="form-control" id="exampleInputEmail1title[<?php echo $data[$i]; ?>]" placeholder="title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Desc</label>
                                                                <textarea name="desc[<?php echo $data[$i]; ?>]" class="form-control" rows="3" placeholder="Valuee ..."></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Keywords</label>
                                                                <input type="text" name="keywords[<?php echo $data[$i]; ?>]" class="form-control" id="exampleInputEmail1" placeholder="Keywords">
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label>Select</label>
                                                                    <select name="select[<?php echo $data[$i]; ?>]" class="form-control">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Passive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="<?php echo $data[$i]; ?>" name="lang">
                                                        <input type="hidden" class="key[<?php echo $data[$i]; ?>]" name="key" id="<?php echo $data[$i]; ?>" value="">
                                                        <div class="card-footer">
                                                            <button onclick="Product.productAdd('<?php echo site_url() ?>product/add_form','<?php echo $data[$i]; ?>','<?php echo base_url('product') ?>')" style="float: right;"  type="button" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /.card -->
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
