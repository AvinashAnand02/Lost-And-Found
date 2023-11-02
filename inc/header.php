<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    
    <!-- Favicons -->
    <link href="<?= validate_image('logo') ?>" rel="icon">
    <link href="<?= base_url ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/vendor/select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url ?>assets/css/custom.css" rel="stylesheet">

    <!-- jQUery -->
    <script src="<?= base_url ?>assets/js/jquery-3.6.4.min.js"></script>
    <script src="<?= base_url ?>assets/js/script.js"></script>
    <script src="<?= base_url ?>assets/vendor/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Updated: Mar 09 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->


    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>
    <?php echo html_entity_decode($_settings->load_data()); ?>
  </head>