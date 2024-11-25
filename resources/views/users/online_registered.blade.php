@extends('layouts.modern-layout.master')

@section('title')
   Awaiting Approval List
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Users</h3>
        @endslot
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">All Awaiting Approval List</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">

            <div class="col-12"><a href="{{route('add.user')}}" class="btn btn-lg btn-outline-success"><i class="fa fa-plus"></i>Add New Member</a></div>
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
                                        <th>first Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>first Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
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
                var invoice_table = $('#server-side-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    ajax: ({
                        url: '{{ route('online.datatable') }}',
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
                            name: "other_names"
                        },
                        {
                            data: "email",
                            name: "email"
                        },
                        {
                            data: "status",
                            name: "status"
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
                                columns: [0, 1, 2, 3]
                            },
                            title: 'Users',
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'Users',
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'Users',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'Users',
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
