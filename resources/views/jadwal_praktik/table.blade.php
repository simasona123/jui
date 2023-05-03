@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush
<div class="card-body px-4">
    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
</div>

@push('third_party_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        (function ($, DataTable) {
            // Datatable global configuration
            $.extend(true, DataTable.defaults, {
                language: {
                    "sProcessing": "Proses...",
                    "sLengthMenu": "Dari _MENU_ Hingga",
                    "sZeroRecords": "Tidak ada hasil",
                    "sInfo": "Menampilkan _START_ hingga _END_ dari _TOTAL_ hasil pencarian",
                    "sSearch": "Cari:",
                    "sLoadingRecords": "Menunggu...",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sLast": "Akhir",
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya"
                    },
                }
            });

            })(jQuery, jQuery.fn.dataTable);
    </script>
@endpush
