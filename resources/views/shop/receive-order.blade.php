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
                                <form action="{{route('receive-order.show')}}" method="get">
                                    @csrf

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
                                    <button type="submit" class="btn btn-sm btn-info"> Process Order</button>
                                </form>
                            </div>
                        </div>
                        <div class="shadow border-2 b-primary p-15 m-5">
                           <livewire:list-recieve-order theme="bootstrap-4">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection

