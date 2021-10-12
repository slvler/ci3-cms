  <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo $settings->desc; ?>" />
        <meta name="author" content="<?php echo $settings->title; ?>" />
         <meta name="keywords" content="<?php echo $settings->keywords; ?>">
        <title><?php echo $settings->title; ?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" alt="<?php echo $settings->fav_icon_name; ?>" href="<?php echo $settings->fav_icon; ?>" />
        <!-- Bootstrap icons-->
        <link href="<?php echo base_url() ?>/assets/front/css/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo base_url() ?>/assets/front/css/styles.css" rel="stylesheet" />
         <!-- Google Analytics -->
         <?php echo $settings->analytics; ?>
         <!-- Yandex Metrica -->
         <?php echo $settings->metrica; ?>
    </head>