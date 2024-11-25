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
                        <h5>All Products</h5>
                        <div class="d-flex flex-column">
                            <a href="{{route('product.create')}}" class="btn btn-sm btn-light"><i class="fa fa-plus-square"></i> Create New Product </a>
                            <a href="{{route('purchase-order.ceate')}}" class="btn btn-sm btn-secondary"><i class="fa fa-pencil-square"></i> Make Purchase Order</a>
                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-share-square"></i> Receive Purchase Order</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary p-15 m-5">
                           <livewire:product-service-table theme="bootstrap-4">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection

