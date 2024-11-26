@extends('layouts.modern-layout.master')

@section('title')
   Members List
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
        <li class="breadcrumb-item active">All Members List</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax data source array start-->
            {{-- <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h1>All User's List</h1>
                    </div>
                    <div class="card-body shadow">
                        <div class="table-responsive">
                            <table class="table table-striped" id="user-array">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>last name</th>
                                        <th>membership status</th>
                                        <th>email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($users as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $item->first_name }}
                                            </td>
                                            <td>
                                                {{ $item->last_name }}
                                            </td>
                                            <td>
                                                @if (isset($item->member))
                                                    <span class="badge rounded-pill badge-primary">Registered</span>
                                                @else
                                                    <span class="badge rounded-pill badge-danger">unRegistered</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                <a href="{{ route('user.show', $item->id) }}" data-container="body"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Show Member"><i
                                                        data-feather="eye"></i></a>
                                                <a href="#"><i data-feather="edit"></i></a>
                                                <a href="#"><i data-feather="delete"></i></a>
                                            </td>

                                        </tr>

                                    @empty
                                    @endforelse
                                </tbody>

                            </table>
                            <div class="d-flex">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                                        <th>Member Name</th>
                                        <th>Email</th>
                                        <th>Amount</th>
                                        <th>Deduction Period</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>first Name</th>
                                        <th>Email</th>
                                        <th>Amount</th>
                                        <th>Deduction Period</th>
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
                    ajax: ({
                        url: '{{ route('savings.datatable') }}',
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
                            data: "amount",
                            name: "amount"
                        },
                        {
                            data: "deposit_period",
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
                            "previous": "<i class='fa fa-arrow-left'></i>",
                            "next": "<i class='fa fa-arrow-right'></i>"
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
