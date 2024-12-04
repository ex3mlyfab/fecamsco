@extends('layouts.modern-layout.master')

@section('title')
    Receive Order
@endsection
@push('css')
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3> Recieved Purchase Order</h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex justify-content-between">
                        <h5>Recieved Order for {{ $order->purchaseOrder->supplier->name . '-' . date('d-M-Y', strtotime($order->created_at)) }}
                        </h5>
                        <a href="{{ route('receive-order.all') }}" class="btn btn-small btn-secondary">All Received order <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            <div class="row p-5 text-center">
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Date
                                       Recieved</div>
                                    <div>
                                        <h5>{{ date('d-M-Y', strtotime($order->created_at)) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i> Received By</div>
                                    <div>
                                        <h5>{{ $order->receivedBy->fullname}}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i
                                            class="icofont icofont-throne f-16 p-t-1"></i>Order Status</div>
                                    <div>
                                        <h5> Received</h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                 <div class="card">
                        <div class="card-header bg-primary text-light text-center">
                            <h5>Products Received</h5>
                        </div>
                        <div class="card-body">


                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-primary text-center">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Product</th>
                                                <th>Qty Rec'd</th>
                                                <th>selling Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($order->receiveOrderDetails as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->productService->name }}</td>
                                                    <td>{{ $item->quantity }} </td>
                                                    <td>{!! showAmount($item->price) !!}</td>
                                                    <td>{!! showAmount($item->price * $item->quantity)!!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>

                        </div>
                    </div>


            </div>
        </div>
    </div>

    @push('scripts')
    @endpush
@endsection
