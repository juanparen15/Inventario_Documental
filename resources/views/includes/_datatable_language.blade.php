<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "search": {
                "smart": true,
                "regex": true,
                "caseInsensitive": true,
                "full": true
            },
            "searching": true,
            "paging": false,
            "pageLength": 100000, // Un número grande para mostrar todos los registros
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>

{{-- <script>
    $(function() {
        $('#example2').DataTable({
            "serverSide": true,
            "ajax": {
                "url": '/inventario',
                "type": 'POST'
            },
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script> --}}
