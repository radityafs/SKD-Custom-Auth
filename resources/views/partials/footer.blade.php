<script src="{{ url('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/jszip/jszip.min.js') }}"></script>
<script src="{{ url('assets/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('assets/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ url('assets/js/adminlte.min.js') }}"></script>
<script src="{{ url('assets/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('assets/chart.js/Chart.min.js') }}"></script>

<script>
    $(function() {
        $("#activated_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#activated_table .col-md-6:eq(0)');

        $("#not_activated_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#not_activated_table .col-md-6:eq(0)');

        const checkboxElement = $('#customSwitch1');


        if (localStorage.getItem('theme') === 'dark') {
            checkboxElement.prop('checked', true);
            $('body').addClass('dark-mode');
        }

        checkboxElement.change(function() {
            if (this.checked) {
                localStorage.setItem('theme', 'dark');
                document.body.classList.add('dark-mode');
            } else {
                localStorage.setItem('theme', 'light');
                document.body.classList.remove('dark-mode');
            }
        });

    });
</script>

</html>
