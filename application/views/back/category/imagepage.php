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
                        <div class="card card-default">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <div id="actions" class="row">
                                    <div class="col-lg-6">
                                        <div class="btn-group w-100">
                                          <span class="btn btn-success col fileinput-button">
                                            <i class="fas fa-plus"></i>
                                              <span>Add files</span>
                                           </span>
                                            <button type="submit" class="btn btn-primary col start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start upload</span>
                                            </button>
                                            <button type="reset" class="btn btn-warning col cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Cancel upload</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="fileupload-process w-100">
                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table table-striped files" id="previews">
                                    <div id="template" class="row mt-2">
                                        <div class="col-auto">
                                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <p class="mb-0">
                                                <span class="lead" data-dz-name></span>
                                                (<span data-dz-size></span>)
                                            </p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-warning cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancel</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-danger delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dZUpload" class="dropzone">
                                <div class="dz-default dz-message"></div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div id="dZUpload" class="dropzone">
                                    <div class="dz-default dz-message"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $downtitle; ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($media as $item){ ?>
                                        <div class="col-sm-2">
                                            <a href="<?php echo base_url(); ?><?php echo $item->media_path; ?>" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                                <img src="<?php echo base_url(); ?><?php echo $item->media_path; ?>" class="img-fluid mb-2" alt="white sample"/>
                                            </a>
                                            <div class="formBtn" style="display: flex;">

                                                <?php if ($item->media_active == "1") {  ?>
                                                    <div style="margin-right: 10px;">
                                                        <a onclick="Category.categoryImageHead('<?php echo base_url() ?>category/image_head','<?php echo $item->id; ?>','0','<?php echo base_url(); ?>/category/image/<?php echo $item->product_id; ?>')" href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                <?php }else { ?>
                                                    <div style="margin-right: 10px;">
                                                        <a onclick="Category.categoryImageHead('<?php echo base_url() ?>category/image_head','<?php echo $item->id; ?>','1','<?php echo base_url(); ?>/category/image/<?php echo $item->product_id; ?>')" href="#"><i class="fa fa-star-half"></i></a>
                                                    </div>

                                                <?php } ?>
                                                <div>
                                                    <a onclick="Category.categoryImageDelete('<?php echo base_url() ?>category/image_delete','<?php echo $item->id ?>','<?php echo base_url() ?>category/image/<?php echo $item->product_id; ?>')" href="#"><i class="fa fa-trash"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
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

<script>


    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var urlPath = "<?php echo base_url(); ?>category/image_form/<?php echo $this->uri->segment(3) ?>";
    var base = "<?php echo base_url(); ?>category";

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: urlPath, // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button",
        success: function (response) {
            //var imgName = response;
            //file.previewElement.classList.add("dz-success");
            $("#dZUpload").text(response.status);
            setTimeout(function(){// wait for 5 secs(2)
                window.location.href = base;
            }, 1000);
        },
        error: function (response) {
            $("#dZUpload").text("error");
        }// Define the element that should be used as click trigger to select files.
    })




    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() {
            myDropzone.enqueueFile(file)

        }
    })



    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {


        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {

        //alert("gel");

        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
</script>
</body>
</html>
