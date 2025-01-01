@extends('layouts.modern-layout.master')

@section('title')
 All Product List
@endsection
@push('css')

@endpush
@section('content')

    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex flex-row justify-content-between">
                        <h5>All Receive Orders</h5>
                        <div class="d-flex flex-column">
                            <a href="{{route('product.create')}}" class="btn btn-sm btn-light"><i class="fa fa-plus-square"></i> Create New Product </a>
                            <a href="{{route('purchase-order.ceate')}}" class="btn btn-sm btn-secondary"><i class="fa fa-pencil-square"></i> Make Purchase Order</a>
                            <a href="{{route('receive-order.all')}}" class="btn btn-sm btn-success"><i class="fa fa-share-square"></i> Receive Purchase Order</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Select Purchase Order to recieve</h5>
                            </div>
                            <div class="col-md-6">

                                    <div class="form-group">

                                        <select class="form-control input-air-secondary digit @error('productcategory') is-invalid @enderror"
                                            id="witness2" placeholder="product category" type="text" name="process_order" >
                                            <option value="">--Please choose an action--</option>
                                          @foreach ($readyPurchase as $item)
                                              <option value="{{$item->id}}"> {{ $item->supplier->name. '/'.date('d-M-Y', strtotime($item->created_at)) }}</option>
                                          @endforeach
                                        </select>
                                        @error('productcategory')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="button" id="process" class="btn btn-sm btn-info"> Process Order</button>

                            </div>
                        </div>
                        <div class="shadow border-2 b-primary p-15 m-5">
                            <div class="row">
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('Year') }}</label>
                                <select class="form-select btn-pill digits select-filter" id="exampleFormControlSelect7" name="year">
                                    <option value="">Select Year</option>
                                    @foreach ($receive_year as $item)
                                        <option value="{{ $item->year }}" @selected(now()->year == $item->year)>{{ $item->year }}</option>
                                    @endforeach
								</select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('Select date Range') }}</label>
                                <div class="form-group">
                                    <input class="form-control digits" type="text" name="daterange" id="date_range" />
                                </div>
                            </div>

                        </div>
                          <div class="table-responsive">
                                    <table class="display datatables" id="server-side-datatable">
                                        <thead>
                                            <tr>
                                               
                                                <th>Supplier</th>
                                                <th>Total Cost</th>
                                                <th>Received by</th>
                                                <th>Status</th>
                                                <th>action</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               
                                                <th>Supplier</th>
                                                <th>Total Cost</th>
                                                <th>Received by</th>
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
      <script src="{{ asset('assets/js/datepicker/daterange-picker/moment.min.js') }}"></script>
     <script src="{{ asset('assets/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
        <script>
            $(window).ready(function(){
                 $(function() {

                var invoice_table = $('#server-side-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    'paginate': {
                    'previous': '<i class="fa fa-chevron-left"></i>',
                    'next': '<i class="fa fa-chevron-right"></i>'
                             },
                    ajax: ({
                        url: '{{ route('receive-order.datatable') }}',
                        method: "POST",
                        data: function(d) {

                            d._token = $('meta[name="csrf-token"]').attr('content');

                              if ($('select[name=year]').val() != '') {
                            	d.year = $('select[name=year]').val();
                            }

                            if ($('input[name=daterange]').val() != '') {
                            	d.daterange = $('input[name=daterange]').val();
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    }),
                    "columns": [

                        {
                            data: "supplier_name",
                            name: "supplier.name"
                        },
                        {
                            data: "cal_cost",
                            name: "cost"
                        },
                        {
                            data: "received_by",
                            name: "received_by"

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
                             "previous": "<i class='fa fa-arrow-left'></i>",
                            "next": "<i class='fa fa-arrow-right'></i>"
                        }
                    },
                    buttons: [{
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'sales',
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'sales',
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'sales',
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            title: 'sales',
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

                $('.select-filter').on('change', function(e) {
                    invoice_table.draw();
                });

                $('#date_range').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        format: 'YYYY-MM-DD',
                        cancelLabel: 'Clear'
                    }
                });

                $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));

                    invoice_table.draw();
                });

                $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                    invoice_table.draw();
                });

            });

                $('#process').click(function(){
                    var id = $('#witness2').val();
                    window.location.href = "{{url('/')}}/shops/receive-order/show/"+id;
                })
            })
        </script>
    @endpush
@endsection

