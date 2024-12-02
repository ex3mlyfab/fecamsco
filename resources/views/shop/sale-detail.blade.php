@extends('layouts.modern-layout.master')

@section('title')
  Sales Detail
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')

<div class="container-fluid dashboard-default-sec">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-2 b-primary b-r-10">
                <div class="card-header bg-primary text-light">
                    <h5 class="text-center">Sales Details</h5>
                </div>
                <div class="card-body">

                    <div class="row">

                            <div class="col-md-6">
                                <div class="icon bg-primary text-light">Member Name</div>
                                <div>
                                    <h5>{{ $sale->user->fullname }}</h5>
                                </div>
                            </div>

                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">Total Cost</div>
                                <div>
                                    <h5>{!! showAmount($sale->Total_cost) !!}</h5>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">sale Date</div>
                                <div>
                                    <h5>{{ $sale->created_at->format('d-M-Y')}}</h5>
                                </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name </th>
                                    <th> Qty</th>
                                    <th> Selling Price</th>
                                    <th> Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                    @forelse ($sale->productSales as $item)

                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$item->productService->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->selling_price}}</td>
                                    <td>{!! showAmount($item->quantity * $item->selling_price) !!}</td>
                                </tr>

                    @empty
                                <tr>
                                    <td colspan="5"> No item found</td>
                                </tr>
                    @endforelse
                     </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{route('sales.all')}}" class="btn btn-outline-secondary w-100"> Back to Sales List <i class="fa fa-arrow-circle-left"></i> </a>
        </div>
    </div>
</div>
@endsection

