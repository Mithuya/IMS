<!-- Required datatable js -->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="../plugins/datatables/jszip.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>

<script src="../plugins/datatables/vfs_fonts.js"></script>
<script src="../plugins/datatables/buttons.html5.min.js"></script>
<script src="../plugins/datatables/buttons.print.min.js"></script>
<script src="../plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="../plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.1/features/mark.js/datatables.mark.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>


<script>
    /* -------------------------------------------------------------------------------------- */
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        className: 'btn btn-sm'
    })
    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.container, {
        className: 'dt-buttons'
    })

    $.extend(true, $.fn.dataTable.defaults, {
        dom: "<'row mb-1'<'col-sm-12 col-md-8'i><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-9'p>>" +
            "<'row'<'col-sm-12'tr>>",
        processing: true,
        deferRender: true,
        stateSave: true,
        stateDuration: -1,
        responsive: true,
        language: {
            url: "{{ asset('json/datatables/i18n/en_gb.json') }}"
        },
        lengthMenu: [
            [20, 25, 50, 75, 100, -1],
            [20, 25, 50, 75, 100, "All"]
        ],
        pageLength: 20,
        pagingType: 'full_numbers',
        mark: {
            element: 'span',
            className: 'bg-info'
        },
        select: true,
        order: [],
        buttons: [
            {
                extend: 'colvis',
                className: 'btn-outline-dark',
                text: '<i class="bi bi-columns"></i>',
                titleAttr: 'Column visibility',
                postfixButtons: [{
                    extend: 'colvisRestore',
                    text: 'Show all',
                    className: 'bg-info',
                }],
            },
            {
                extend: 'copyHtml5',
                className: 'btn-outline-dark',
                text: '<i class="bi bi-clipboard"></i>',
                titleAttr: 'Copy to clipboard',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn-secondary',
                text: '<i class="bi bi-file-earmark-pdf"></i>',
                titleAttr: 'Export to PDF',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                download: 'open',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.pageMargins = [10, 15, 10, 15];
                    doc.defaultStyle.fontSize = 9;
                },
            },
            {
                extend: 'excelHtml5',
                className: 'btn-secondary',
                text: '<i class="bi bi-file-earmark-excel"></i>',
                titleAttr: 'Export to spreadsheet',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                autoFilter: true,
            },
            {
                extend: 'print',
                className: 'btn-secondary',
                text: '<i class="bi bi-printer"></i>',
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                //autoPrint: false,
                customize: function(win) {
                    $(win.document.body).css('padding-top', '0.5rem');
                    $(win.document.body).find('h1').css('font-size', '12px');
                    $(win.document.body).find('table')
                        .addClass('display')
                        .addClass('compact')
                        .css('font-size', '10px');
                },
            },
            {
                extend: 'selectNone',
                className: 'btn-info',
                text: '<i class="bi bi-x"></i>',
                titleAttr: 'Deselect all',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'selectAll',
                className: 'btn-info',
                text: '<i class="bi bi-check"></i>',
                titleAttr: 'Select all',
                exportOptions: {
                    columns: ':visible'
                },
                action: function(e, dt, node, config) {
                    dt.rows({
                        search: 'applied',
                        page: 'current'
                    }).select()
                }
            },
        ]
    });
    /* -------------------------------------------------------------------------------------- */
    let dtButtonsLeft = $.extend(true, [], $.fn.dataTable.defaults.buttons);
    let dtButtonsCenter = [];
    let dtButtonsRight = [];
    /* -------------------------------------------------------------------------------------- */
</script>
