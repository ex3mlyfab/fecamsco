@extends('layouts.modern-layout.master')

@section('title')
    {{ $user->fullname }} Profile
@endsection
@push('css')
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Users</h3>
        @endslot
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">{{ $user->fullname }} Profile</li>
    @endcomponent

    <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body px-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="rounded-circle shadow border-2 b-light" width="200" alt="{{$user->last_name}}"
                                            src="{{ ($user->member()->exists()) ? asset(user_avatar($user->member->avatar)) : asset('femcas-logo.png') }}" />

                                            <h3 class="mb-1 f-20 txt-primary">{{ $user->fullname }}</h3>
                                    <p class="f-12">
                                        <x-badge :user="$user"></x-badge>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    @isset($user->member)
                                    <div class="row border-2 b-r-4 b-primary pt-4 my-5">
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Telephone</div>
                                            <div>
                                                <h5>{{ $user->member->telephone ?? '' }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i>Email</div>
                                            <div>
                                                <h5>{{ $user->email }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Department/Division</div>
                                            <div>
                                                <h5>{{ $user->member->department ?? " "}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-clip f-16 p-t-1"></i>File Number</div>
                                            <div>
                                                <h5>{{ $user->member->file_no ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-list f-16 p-t-1"></i>IPPIS No</div>
                                            <div>
                                                <h5>{{ $user->member->ippis_no?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Location</div>
                                            <div>
                                                <h5>{{ $user->member->location ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-bill-alt f-16 p-t-1"></i>Total Contribution</div>
                                            <div>
                                                <h5 class="text-center">{!! showAmount($user->total_contribution) !!}</h5>
                                            </div>
                                        </div>


                                    </div>

                                    @endisset
                                    @if (!isset($user->member))
                                            <h1>member has not completed registration</h1>
                                    @endif
                                    @if ($user->member_status == 2)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{route('membership.approve', $user->id)}}" class="btn btn-outline-primary">Approve Membership</a>
                                            </div>
                                            @can('deny-membership')
                                            <div class="col-md-6">
                                                <a href="{{route('membership.decline', $user->id)}}" class="btn btn-outline-danger">Deny Membership</a>
                                            </div>
                                            @endcan

                                        </div>

                                    @endif
                                </div>



                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6 xl-100">
                        <div class="card shadow border-2 b-info">
                          <div class="card-header pb-0">
                            <h5>Financial Info</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="icon bg-primary text-light text-center"><i class="fa fa-money f-16 p-t-1"></i>Total Contribution</div>
                                    <h5 class="text-center">{!! showAmount($user->total_contribution)!!}</h5>
                                </div>

                            </div>
                        </div>
                         <div class="card-body">
                            <div class="table-responsive">
                                <table class="display datatables" id="server-side-datatable">
                                    <thead>
                                        <tr>

                                            <th>Amount</th>
                                            <th>Deduction Period</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>

                                            <th>Amount</th>
                                            <th>Deduction Period</th>
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
                        url: '{{ route('userContribution.datatable', $user->id) }}',
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
                    "columns": [
                        {
                            data: "amount",
                            name: "amount",


                        },
                        {
                            data: "period",
                            name: "period",
                            className: "text-center"
                        },


                    ],
                    responsive: true,
                    "bStateSave": true,
                    "bAutoWidth": false,
                    "ordering": true,
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
                                columns: [0, 1, 2]
                            },
                            title: 'Users Deduction',
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2]
                            },
                            title: 'Users',
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [0, 1, 2]
                            },
                            title: 'Users',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2]
                            },
                            title: 'Users',
                            customize: function(win) {
                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .prepend('<h4 class="text-center">User Deduction</h4>');
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

                // $('#first-name').on('keyup', function(e) {
                //     invoice_table.draw();
                // });

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

