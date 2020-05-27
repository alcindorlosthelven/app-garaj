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
    <title><?php if (isset($titre)) echo $titre; ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= App::autre("assets/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="<?= App::autre("assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") ?>">
    <!-- iCheck -->

    <link rel="stylesheet" href="<?= App::autre("assets/plugins/toastr/toastr.min.css") ?>">
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

    <style type="text/css">
        #load {
            position: fixed;
            z-index: 9999;
            background: url('<?= App::autre("image/load.gif") ?>') 50% 50% no-repeat;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            cursor: wait;
        }
    </style>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div id="load"></div>
<div class="wrapper">
    <!--menu-->
    <?= App::block("menu") ?>
    <!--fin menu-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php
                if (isset($contenue)) {
                    echo $contenue;
                } else {
                    echo "Pas de contenune";
                }
                ?>
            </div>
        </section>
        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= App::autre("assets/plugins/jquery/jquery.min.js") ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= App::autre("assets/plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= App::autre("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- ChartJS -->
<script src="<?= App::autre("assets/plugins/chart.js/Chart.min.js") ?>"></script>
<!-- Sparkline -->
<!--<script src="<? /*=App::autre("assets/plugins/sparklines/sparkline.js")*/ ?>"></script>-->
<!-- JQVMap -->
<script src="<?= App::autre("assets/plugins/jqvmap/jquery.vmap.min.js") ?>"></script>
<script src="<?= App::autre("assets/plugins/jqvmap/maps/jquery.vmap.usa.js") ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= App::autre("assets/plugins/jquery-knob/jquery.knob.min.js") ?>"></script>
<!-- daterangepicker -->
<script src="<?= App::autre("assets/plugins/moment/moment.min.js") ?>"></script>
<script src="<?= App::autre("assets/plugins/daterangepicker/daterangepicker.js") ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= App::autre("assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") ?>"></script>
<!-- Summernote -->
<script src="<?= App::autre("assets/plugins/summernote/summernote-bs4.min.js") ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= App::autre("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") ?>"></script>

<!-- DataTables -->
<script src="<?= App::autre("assets/plugins/datatables/jquery.dataTables.js") ?>"></script>
<script src="<?= App::autre("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js") ?>"></script>


<!-- SweetAlert2 -->
<!-- Toastr -->
<script src="<?= App::autre("assets/plugins/toastr/toastr.min.js") ?>"></script>
<script src="<?= App::autre("assets/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>


<!-- AdminLTE App -->
<script src="<?= App::autre("assets/dist/js/adminlte.js") ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<? /*=App::autre("assets/dist/js/pages/dashboard.js")*/ ?>"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?= App::autre("assets/dist/js/demo.js") ?>"></script>

<script type="text/javascript"
        src="<?= App::autre("js/jquery.maskedinput-master/src/jquery.maskedinput.js") ?>"></script>
<!--<script type="text/javascript" src="<? /*=App::autre("js/jquery.autocomplete.js")*/ ?>"></script>-->

<script src="<?= App::autre("app.js") ?>"></script>

<script>

    $("document").ready(function () {
        $("form").addClass("was-validated");

    });


    $(".datatable").DataTable();
    $('.datatable1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
    //Timepicker
    $('.datePicker').datepicker({
        format: 'Y-m-d'
    })
    $(".date").mask("99/99/9999");
    $(".cin").mask("99-99-99-9999-99-99999");
    $(".nif").mask("999-999-999-9");
    $(".telephone").mask("(+999)9999-99-99");
    $(".datetime").mask("9999-99-99 99:99:99");

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });


</script>
<!--modal ajouter categorie autre item-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ajout Une Categorie</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="f_categorie">
                    <div class="form-group">
                        <label>Categorie</label>
                        <input type="text" name="categorie" class="form-control" placeholder="Categorie" required>
                    </div>

                    <div class="form-group pull-right">
                        <input type="hidden" name="ajouter_categorie">
                        <input type="submit" value="Ajouter" class="btn btn-warning">
                    </div>
                </form>
                <div class="message"></div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--fin modal ajouter categorie autre item-->
</body>
</html>