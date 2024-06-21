<!-- jQuery -->
<script src="../../template/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../template/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../template/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../template/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../template/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../template/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../template/plugins/moment/moment.min.js"></script>
<script src="../../template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../template/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../template/plugins/jszip/jszip.min.js"></script>
<script src="../../template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- SweetAlert2 -->
<script src="../../template/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- AdminLTE App -->
<script src="../../template/dist/js/adminlte.js"></script>

<script>
    $(function() {

        $("#bayar").DataTable({
            "paging": false,
            "searching": true,
            "responsive": true,
            "lengthChange": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
        });

    });
</script>

</body>

</html>