@extends('layouts.modern-layout.master')

@section('title')
   Bank Mandate Information
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">

@endpush
@section('content')

    <div class="container-fluid dashboard-default-sec">
        <form id="frm-example" action="{{route('bankmandatebatch.process')}}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex justify-content-between">

                                <h5>Bank Mandate Awaiting Batching</h5>

                            <div>

                                <p class="text-light">click button below to Batch Payment and Download excel</p>
                                <button class="btn btn-secondary btn-lg w-100" type="button" id="process-batch"> Batch Selected Payment</button>
                                <p id="no-select" class="text-danger"> Select one or more mandate</p>


                            </div>

                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('Account Name') }}</label>
                                <input type="text" class="form-control select-filter" name="last_name" id="first-name">
                            </div>
                            <div class="col-lg-3">
                                {{-- <div class="checkbox checkbox-success">
                                    <input id="checkbox-primary" type="checkbox">
                                    <label for="checkbox-primary">Select All</label>
                                  </div> --}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="display datatables" id="server-side-datatable">
                                <thead>
                                    <tr>
                                        <th> <input id="checkbox-primary" type="checkbox" name="select-all" value="1"></th>
                                        <th>Amount</th>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Narration</th>


                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Amount</th>
                                        <th>Bank Name</th>
                                        <th>Account name</th>
                                        <th>Account Number</th>
                                        <th>Narration</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
        <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
        <script>
        (function($) {
            "use strict";

            $(function() {
                $('#no-select').hide();
                var invoice_table = $('#server-side-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    search: {
        return: true
                         },
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    ajax: ({
                        url: '{{ route('bankmandate.datatable') }}',
                        method: "POST",
                        data: function(d) {

                            d._token = $('meta[name="csrf-token"]').attr('content');

                            if ($('input[name=deduction_period]').val() != '') {
                                d.last_name = $('input[name=deduction_period]').val();
                            }

                            // if ($('select[name=client_id]').val() != '') {
                            // 	d.client_id = $('select[name=client_id]').val();
                            // }

                            // if ($('select[name=status]').val() != '') {
                            // 	d.status = JSON.stringify($('select[name=status]').val());
                            // }

                            // if ($('input[name=date_range]').val() != '') {
                            // 	d.date_range = $('input[name=date_range]').val();
                            // }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    }),
                    'columnDefs': [{
                            'targets': 0,
                            'searchable':false,
                            'orderable':false,
                            'className': 'dt-body-center',
                            'render': function (data, type, full, meta){
                                return '<input type="checkbox" name="id[]" value="'
                                    + $('<div/>').text(data).html() + '">';
                            }
                        }],
                    "columns": [{
                           data: "id"
                        },
                        {
                            data: "amount",
                            name: "amount"
                        },

                        {
                            data: "bank_name",
                            name: "bank_name"
                        },
                        {
                            data: "account_name",
                            name: "account_name"
                        },
                        {
                            data: "account_number",
                            name: "account_number"
                        },
                        {
                            data: "narration",
                            name: "narration"
                        },

                    ],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    responsive: true,
                    "bStateSave": true,
                    "bAutoWidth": false,
                    "ordering": false,
                    // "searching": false,
                    dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6 text-right'l>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "language": {
                        "decimal": "",
                        "emptyTable": "No Data Found",
                        "info": "Showing" + " _START_ " + "to" + " _END_ " + "of" +
                            " _TOTAL_ " + "Entries",
                        "infoEmpty": "Showing 0 To 0 Of 0 Entries",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Show" + " _MENU_ " + "Entries",
                        "loadingRecords": "Loading",
                        "processing": "Processing",
                        "search": "Search",
                        "zeroRecords": "No_matching_records_found",
                        "paginate": {
                            "first": "first",
                            "last": "last",
                            "previous": "<i data-feather='arrow-left'></i>",
                            "next": "<i data-feathe='arrow-right'></i>"
                        }
                    },
                    buttons: [{
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5]
                            },
                            title: 'mandate',
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            },
                            title: 'mandate',
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            },
                            title: 'mandate',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            },
                            title: 'mandate',
                            customize: function(win) {
                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .prepend('<h4 class="text-center">Invoice</h4>');
                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ],
                    drawCallback: function() {
                        $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
                    }
                });

                $('#first-name').on('keyup', function(e) {
                    invoice_table.draw();
                });
                $('#process-batch').on('click', function(){
                    let checkedBoxes = 0;
                    var rows = invoice_table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).each(function(){
                        // // If checkbox doesn't exist in DOM
                        //  if(!$.contains(document, this)){
                            // If checkbox is checked
                            if(this.checked){
                            // Create a hidden element
                            // $(form).append(
                            //     $('<input>')
                            //         .attr('type', 'hidden')
                            //         .attr('name', this.name)
                            //         .val(this.value)
                            // );
                            checkedBoxes++
                            }

                        // }
                    });
                    if(checkedBoxes > 0){
                         $('#frm-example').submit();
                    }else{
                        $('#no-select').show();
                        setTimeout(() => {
                            $('#no-select').fadeOut('slow')
                        }, 1500);
                    }

                });
                $('#frm-exam').on('submit', function(e){
                    var form = this;

                    // Iterate over all checkboxes in the table
                    invoice_table.$('input[type="checkbox"]').each(function(){
                        // If checkbox doesn't exist in DOM
                        if(!$.contains(document, this)){
                            // If checkbox is checked
                            if(this.checked){
                            // Create a hidden element
                            $(form).append(
                                $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', this.name)
                                    .val(this.value)
                            );
                            }
                        }
                    });

                    // FOR TESTING ONLY

                    // Output form data to a console
                    $('#example-console').text($(form).serialize());
                    console.log("Form submission", $(form).serialize());

                    // Prevent actual form submission
                    e.preventDefault();
                });
                                // Handle click on checkbox to set state of "Select all" control
                $('#server-side-datatable tbody').on('change', 'input[type="checkbox"]', function(){
                    // If checkbox is not checked
                    if(!this.checked){
                        var el = $('checkbox-primary').get(0);
                        // If "Select all" control is checked and has 'indeterminate' property
                        if(el && el.checked && ('indeterminate' in el)){
                            // Set visual state of "Select all" control
                            // as 'indeterminate'
                            el.indeterminate = true;
                        }
                    }
                });

                // Handle click on "Select all" control
                $('#checkbox-primary').on('click', function(){
                    // Check/uncheck all checkboxes in the table
                    var rows = invoice_table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
});
                // $('.select-filter').on('change', function(e) {
                //     invoice_table.draw();
                // });

                // $('#date_range').daterangepicker({
                //     autoUpdateInput: false,
                //     locale: {
                //         format: 'YYYY-MM-DD',
                //         cancelLabel: 'Clear'
                //     }
                // });

                // $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                //     $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                //         'YYYY-MM-DD'));
                //     invoice_table.draw();
                // });

                // $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                //     $(this).val('');
                //     invoice_table.draw();
                // });

            // });

        })(jQuery);
    </script>

    @endpush
@endsection

