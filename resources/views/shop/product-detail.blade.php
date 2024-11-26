@extends('layouts.modern-layout.master')

@section('title')
 {{$product->name}} Details
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        <li class="breadcrumb-item active">Products</li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="card border-2 b-primary">
            <div class="card-header bg-primary text-light d-flex justify-content-between">
                <h5>{{$product->name}}</h5>
                <a href="{{route('product.all')}}" class="btn btn-small btn-secondary">All Products <i class="fa fa-arrow-circle-right"></i> </a>
            </div>
            <div class="card-body">
                <div class="row border-2 b-r-4 b-primary pt-4 my-5 text-center">
                    <div class="col-md-6">
                        <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Product Category</div>
                        <div>
                            <h5>{{ $product->productServiceCategory->name }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i>Product Name</div>
                        <div>
                            <h5>{{ $product->name }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Stock Quantity</div>
                        <div>
                            <h5>{{ $product->stock_quantity}}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon bg-primary text-light"><i class="icofont icofont-clip f-16 p-t-1"></i>Minimum Order Quantity</div>
                        <div>
                            <h5>{{ $product->minimum_level}}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon bg-primary text-light"><i class="icofont icofont-list f-16 p-t-1"></i>Selling Price</div>
                        <div>
                            <h5>{!! showAmount($product->latestProductPrice->current_price ?? 0) !!}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Last Received Date</div>
                        <div>
                            <h5></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-success text-light text-center">
                    <h3>Inventory Details</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs border-tab nav-secondary nav-left" id="danger-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="danger-home-tab" data-bs-toggle="tab" href="#danger-home" role="tab" aria-controls="danger-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Receive History</a></li>
                      <li class="nav-item"><a class="nav-link" id="profile-danger-tab" data-bs-toggle="tab" href="#danger-profile" role="tab" aria-controls="danger-profile" aria-selected="false"><i class="icofont icofont-read-book"></i>Sales History</a></li>
                      <li class="nav-item"><a class="nav-link" id="contact-danger-tab" data-bs-toggle="tab" href="#danger-contact" role="tab" aria-controls="danger-contact" aria-selected="false"><i class="icofont icofont-contacts"></i>Return History</a></li>
                    </ul>
                    <div class="tab-content" id="danger-tabContent">
                      <div class="tab-pane fade show active" id="danger-home" role="tabpanel" aria-labelledby="danger-home-tab">
                        <div class="card shadow border-2 b-secondary b-r-3">
                            <div class="card-header d-flex justify-content-around">
                                <h5 class="text-secondary">Receive History</h5>

                            </div>
                            <div class="cardbody m-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date Recieved </th>
                                                <th>Qty Received</th>
                                                <th>cost Price</th>
                                                <th>Selling Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($product->productReceiveds as $item)
                                                <tr>
                                                    <td>{{$item->receiveOrder->created_at ?? " "}}</td>
                                                    <td>{{$item->quantity_received}}</td>
                                                    <td>{!!showAmount($item->cost_price)!!}</td>
                                                    <td>{!!showAmount($item->selling_price)!!}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No Record Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="danger-profile" role="tabpanel" aria-labelledby="profile-danger-tab">
                        <div class="card shadow border-2 b-info b-r-3">
                            <div class="card-header d-flex justify-content-around">
                                <h5 class="text-secondary">Sales History</h5>

                            </div>
                            <div class="cardbody m-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date Sold </th>
                                                <th>Qty </th>
                                                <th>Selling Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($product->productSales as $item)
                                                <tr>
                                                    <td>{{$item->Sale->created_at ?? ""}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td>{!!showAmount($item->selling_price)!!}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No Record Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="danger-contact" role="tabpanel" aria-labelledby="contact-danger-tab">
                        <h5 class="text-center m-b-4">Product Return</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date Returned </th>
                                        <th>Qty Received</th>

                                        <th>Selling Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product->productReturns as $item)
                                        <tr>
                                            <td>{{$item->created_at ?? ""}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{!!showAmount($item->selling_price)!!}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                      </div>

                    </div>
                  </div>
            </div>

        </div>

    </div>
    @push('scripts')

    @endpush
@endsection
