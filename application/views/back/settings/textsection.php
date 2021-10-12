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
                                <h3 class="card-title">Count</h3>

                                <!-- Search
                                   <div class="card-tools">
                                       <div class="input-group input-group-sm" style="width: 150px;">
                                           <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                           <div class="input-group-append">
                                               <button type="submit" class="btn btn-default">
                                                   <i class="fas fa-search"></i>
                                               </button>
                                           </div>
                                       </div>
                                   </div>
                                   -->
                                <a  href="#"><button id="textInput" class="btn btn-primary btn-xs" style="float: right">Input Add</button></a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Number</th>
                                        <?php foreach ($resultLanguage as $lang): ?>
                                        <th><?php echo $lang->lang; ?></th>
                                        <?php endforeach; ?>

                                        <th>Reason</th>
                                    </tr>
                                    </thead>
                                    <tbody id="textSection">
                                    <?php $i = 1; foreach ($text as $item): ?>
                                        <tr>
                                            <td id="number"><?= $i; ?></td>



                                            <?php foreach ($resultLanguage as $lang): ?>
                                                <td>
                                                    <input type="text" name="<?php echo $lang->lang_key?>">
                                                </td>
                                            <?php endforeach; ?>

                                            <td>
                                                <a onclick="modalSection.modalLanguageEditForm('<?php echo site_url('settings/lang_edit_form') ?>','<?php echo site_url('settings') ?>','<?php echo $item->id; ?>','<?php echo $item->lang; ?>','<?php echo $item->lang ?>')" href="#"><button class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> Edit Page</button></a>
                                                <a href="<?php echo base_url('category/delete') ?>/<?= $item->id; ?>"><button class="btn btn-danger  btn-xs"><i class="fas fa-trash"></i> Delete</button></a>

                                            </td>
                                        </tr>
                                        <?php $i++; endforeach; ?>


                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>


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


<script>
    $("#textInput").on('click',function (){

        var c =  $("#number").text()

        var b = +c;




        $('#textSection').append('<tr><td>' + b + 1 +'</td><td><input type="text" name="tr"></td><td><input type="text" name="en"></td><td><input type="text" name="fr"></td><td><a onclick="Settings.textSection();" href="#"><button class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> Add Button</button></a><a href=""><button class="btn btn-danger  btn-xs"><i class="fas fa-trash"></i> Delete</button></a></td></tr>');

    });


</script>





</body>
</html>
