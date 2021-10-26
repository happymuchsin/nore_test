<div id="muter">
    <img id="muter-image" src="{{ asset('/assets/img/muter.gif') }}" alt="Loading...">
</div>
<script src="{{ asset('/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/js/app.js') }}"></script>
<script src="{{ asset('/assets/js/main.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.repeater.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> -->

<script src="{{ asset('/assets/js/dataTables.hideEmptyColumns.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="https://cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.25/api/average().js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/date-dd-MMM-yyyy.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="{{ asset('/assets/vendors/dropzone/dist/dropzone.js') }}"></script>

<script>
    $(window).on('load', function() {
        $('#muter').hide();
    })

    function commaNumb(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }

        return val;
    }
</script>