@extends('layouts.modern-layout.master')

@section('title')
    Loans List
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Loans</h3>
        @endslot
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">All Pending Loans List</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">

            {{-- <div class="col-12"><a href="{{route('add.user')}}" class="btn btn-lg btn-outline-success"><i class="fa fa-plus"></i>Add New Member</a></div> --}}
            <div class="col-sm-12">
                <div class="card border-2 b-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('First Name') }}</label>
                                <input type="text" class="form-control select-filter" name="last_name" id="first-name">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="display datatables" id="server-side-datatable">
                                <thead>
                                    <tr>
                                        <th>Member Name</th>
                                        <th>Loan Amount</th>
                                        <th>Status</th>
                                        <th>Loan Type</th>
                                        <th>Performance</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Member Name</th>
                                        <th>Loan Amount</th>
                                        <th>Status</th>
                                        <th>Loan Type</th>
                                        <th>performance</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            $(function() {
                var invoice_table = $('#server-side-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: ({
                        url: '{{ route('pending.datatable') }}',
                        method: "POST",
                        data: function(d) {

                            d._token = $('meta[name="csrf-token"]').attr('content');

                            if ($('input[name=last_name]').val() != '') {
                                d.last_name = $('input[name=last_name]').val();
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
                    "columns": [{
                            data: "member_names",
                            name: "member_names"
                        },
                        {
                            data: "loan_amount",
                            name: "loan_amount"
                        },
                        {
                            data: "status",
                            name: "status"
                        },
                        {
                            data: "loan_type",
                            name: "loan_type"
                        },
                        {
                            data: "performance",
                            name: "performance"
                        },
                        {
                            data: "action",
                            name: "action"
                        },
                    ],
                    responsive: true,
                    "bStateSave": true,
                    "bAutoWidth": false,
                    "ordering": false,
                    "searching": false,
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
                                columns: [0, 1, 2, 3,4]
                            },
                            title: 'Invoice',
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: 'Invoice',
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: 'Invoice',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            title: 'Loam Details',
                            customize: function(win) {
                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .prepend('<h4 class="text-center">Loan details</h4>');
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

            });

        })(jQuery);
    </script>
    @endpush
@endsection
