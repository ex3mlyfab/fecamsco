@extends('layouts.modern-layout.master')

@section('title')
    Create Permission
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Create Supplier Profile </h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex justify-content-between">
                        <h5>Create Supplier</h5>
                        <a href="{{route('supplier.all')}}" class="btn btn-small btn-secondary">All Suppliers <i class="fa fa-arrow-circle-right"></i> </a>
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            @livewire('create-supplier')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection

