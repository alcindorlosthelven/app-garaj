<?php

use systeme\Application\Application as App;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="los-framework">
    <meta name="author" content="Alcindor losthelven">
    <title>.</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="<?= App::autre("assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/jqvmap/jqvmap.min.css") ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= App::autre("assets/dist/css/adminlte.min.css") ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/daterangepicker/daterangepicker.css") ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/summernote/summernote-bs4.css") ?>">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php
if(isset($contenue))echo $contenue;
?>
</div>

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>