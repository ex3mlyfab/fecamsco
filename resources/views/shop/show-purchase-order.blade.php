@extends('layouts.modern-layout.master')

@section('title')
 Purchase Order
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3> Purchase Order Details</h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex justify-content-between">
                       <h5>Purchase Order for  {{ $order->supplier->name.'-'.date('d-M-Y', strtotime($order->created_at))}}</h5>
                       <a href="{{route('purchase-order.all')}}" class="btn btn-small btn-secondary">All Purchase order <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            <div class="row p-5 text-center">
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Date Created</div>
                                    <div>
                                        <h5>{{ date('d-M-Y', strtotime($order->created_at)) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i> Total Amount</div>
                                    <div>
                                        <h5>{!! showAmount($order->total) !!}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Order Status</div>
                                    <div>
                                        <h5>{!!purchase_order_status($order->status)!!}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icofont icofont-clip f-16 p-t-1"></i>File Number</div>
                                    <div>
                                        <h5>{{ $order->created_at }}</h5>
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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-primary text-center">
                                        <th>S/N</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->purchaseOrderDetails as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item->productService->name}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{!!showAmount($item->price * $item->quantity)!!}</td>
                                        </tr>

                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right"><h5>Total</h5></td>
                                            <td>{!!showAmount($order->total)!!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                             @if ($order->status ==1)
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-right">Process Purchase Order</h5>
                                </div>


                                <div class="col-md-6">
                                    <form action="{{route('purchase-order.process', $order->id)}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">

                                            <select class="form-control input-air-secondary digit @error('productcategory') is-invalid @enderror"
                                                id="witness2" placeholder="product category" type="text" name="process_order" >
                                                <option value="">--Please choose an action--</option>
                                                <option value="2">Approve</option>
                                                <option value="3">Decline</option>
                                            </select>
                                            @error('productcategory')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-info"> Process Order</button>
                                    </form>
                                </div>
                            </div>
                             @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection
