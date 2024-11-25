@extends('layouts.modern-layout.master')

@section('title')
 Create Purchase Order
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Create Purchase Order</h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex justify-content-between">
                       <h5>Create New Purchase Order</h5>
                       <a href="{{route('purchase-order.all')}}" class="btn btn-small btn-secondary">All Purchase order <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            <livewire:create-purchase-order />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection
