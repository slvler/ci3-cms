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
                                <a onclick="modalSection.modalLanguageForm('<?php echo site_url() ?>setting/lang_add_form','<?php echo site_url() ?>settings');" href="#"><button class="btn btn-primary btn-xs" style="float: right">Language Add</button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($resultLanguage as $item): ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $item->lang; ?></td>
                                        <td><?= $item->lang_key; ?></td>
                                        <td><?= $item->select; ?></td>
                                        <td>
                                            <a onclick="modalSection.modalLanguageEditForm('<?php echo site_url('settings/lang_edit_form') ?>','<?php echo site_url('settings') ?>','<?php echo $item->id; ?>','<?php echo $item->lang; ?>','<?php echo $item->lang_key ?>')" href="#"><button class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> Edit Page</button></a>
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

        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="settingsGeneralForm">
                            <div class="form-group">
                                <label for="inputName">Title</label>
                                <input type="text" id="generaltitle" class="form-control" name="title" value="<?php echo $resultSettings->title ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea id="generalDesc" class="form-control" name="desc" rows="4"><?php echo $resultSettings->desc ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Keywords</label>
                                <textarea id="generalKeywords" class="form-control" name="keywords" rows="4"><?php echo $resultSettings->keywords ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Google Analytics</label>
                                <textarea id="generalAnalytics" class="form-control" name="analytics" rows="4"><?php echo $resultSettings->analytics ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Yandex Metrica</label>
                                <textarea id="generalMetrica" class="form-control" name="metrica" rows="4"><?php echo $resultSettings->metrica ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select id="generalselect" name="select" class="form-control custom-select">
                                    <?php if ($resultSettings->status == "1"){ ?>
                                    <option value="1">Active</option>
                                    <option value="0">Passive</option>
                                    <?php }else{ ?>
                                        <option value="0">Passive</option>
                                        <option value="1">Active</option>
                                    <?php } ?>
                                </select>
                            </div>
                                <input type="hidden" id="generalid" value="<?php echo $resultSettings->id; ?>">
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Mail Section</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="settingsSmptForm">
                            <div class="form-group">
                                <label for="inputEstimatedBudget">SMPT Host</label>
                                <input type="text" id="smpthost" name="Host" class="form-control" value="<?php echo $resultSettings->smtp_host ?>" >
                            </div>
                            <div class="form-group">
                                <label for="inputSpentBudget">SMPT Port</label>
                                <input type="text" id="smptport" name="port" class="form-control" value="<?php echo $resultSettings->smtp_port ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputEstimatedDuration">SMPT Mail</label>
                                <input type="text" id="smptmail" name="mail" class="form-control" value="<?php echo $resultSettings->smtp_mail ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputEstimatedDuration">SMPT Password</label>
                                <input type="text" id="smptpass" name="password" class="form-control" value="<?php echo $resultSettings->smtp_pass ?>">
                            </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Gallery Files</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th style="float:right; "><a onclick="modalSection.modalSettingsGallery('<?php echo site_url('settings/gallery_add'); ?>','<?php echo site_url('settings'); ?>','<?php echo $resultSettings->id; ?>')" href="#"  style="border: 1px solid #000;" class="btn btn-black"><i class="fas fa-image"> Gallery</i></a></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td><?php echo $resultSettings->logo_name; ?></td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <!-- https://via.placeholder.com/1200/000000.png?text=2 -->
                                            <a href="<?php echo $resultSettings->logo; ?>" data-toggle="lightbox" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo $resultSettings->logo_banner_name; ?></td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo $resultSettings->logo_banner; ?>" data-toggle="lightbox" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo $resultSettings->fav_icon_name; ?></td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo $resultSettings->fav_icon; ?>" data-toggle="lightbox" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <a onclick="Settings.settingGenerelAdd('<?php echo site_url('settings/settings_edit'); ?>','<?php echo site_url('settings'); ?>');"><button type="button" class="btn btn-success float-right">Save Changes</button></a>
                </div>
            </div>
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



<!--
<script >
    $(document).ready( function () {

        $('.toggle').change(function() {
            id=$(this)[0].getAttribute('id');
            statu=$(this).prop('checked');
            val=$(this).val();
            alert(val);
        })
    } );
</script>
 -->




</body>
</html>
