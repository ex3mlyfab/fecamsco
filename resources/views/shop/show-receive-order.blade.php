@extends('layouts.modern-layout.master')

@section('title')
    Receive Order
@endsection
@push('css')
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3> Recieve Purchase Order</h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex justify-content-between">
                        <h5>Purchase Order for {{ $order->supplier->name . '-' . date('d-M-Y', strtotime($order->created_at)) }}
                        </h5>
                        <a href="{{ route('purchase-order.all') }}" class="btn btn-small btn-secondary">All Purchase order <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            <div class="row p-5 text-center">
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Date
                                        Created</div>
                                    <div>
                                        <h5>{{ date('d-M-Y', strtotime($order->created_at)) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i> Total
                                        Amount</div>
                                    <div>
                                        <h5>{!! showAmount($order->total) !!}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i
                                            class="icofont icofont-throne f-16 p-t-1"></i>Order Status</div>
                                    <div>
                                        <h5>{!! purchase_order_status($order->status) !!}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i
                                            class="icofont icofont-clip f-16 p-t-1"></i>File Number</div>
                                    <div>
                                        <h5>{{ $order->created_at }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                 <div class="card">
                        <div class="card-header bg-primary text-light text-center">
                            <h5>Products Ordered</h5>
                        </div>
                        <div class="card-body">
                            
                            <form method="POST" action="{{route('receive.process')}}" >
                                 @csrf
                                <input type="hidden" name="purchase_order_id" value="{{ $order->id }}" />
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-primary text-center">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Product</th>
                                                <th>Qty Proposed</th>
                                                <th>Qty Rec'd</th>
                                                <th>Price</th>
                                                <th>selling Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($order->purchaseOrderDetails as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->productService->name }}</td>
                                                    <td>{{ $item->quantity }} <input type="hidden" name="cost_price[]"
                                                            value="{{ $item->price }}"></td>
                                                    <td> <input class="form-control input-air-secondary" type="number"
                                                            name="product_qty[]" id="line_qty{{ $item->id }}"
                                                            required />
                                                        <input type="hidden" name="product_id[]"
                                                            value="{{ $item->product_service_id}}" />
                                                    </td>
                                                    <td>{{ $item->price }}</td>
                                                    <td><input class="form-control input-air-secondary" type="number"
                                                            name="product_selling_price[]" required
                                                            id="line_proce{{ $item->id }}" /></td>
                                                    <td>{{ $item->price * $item->quantity }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6" class="text-right">
                                                    <h5>Total</h5>
                                                </td>
                                                <td>{{ $order->total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <h5>Supplier Account info</h5>
                                        <div class="form-group">
                                            <label class="witness3_dept">Account Name<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness3_dept"
                                                placeholder="Supplier account Name" type="text" name="account_name"
                                                value="{{ old('account_name') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="witness3dept">Account Number<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness3dept"
                                                placeholder="Supplier Account Number" type="text" name="account_number"
                                                value="{{ old('account_number') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="witnes3_dept">Bank Name<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witnes3_dept"
                                                placeholder="Bank Name" type="text" name="bank_name"
                                                value="{{ old('bank_name') }}" />
                                        </div>

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-lg btn-info w-100">Recieve order</button>
                            </form>
                        </div>
                    </div>


            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
@endsection
