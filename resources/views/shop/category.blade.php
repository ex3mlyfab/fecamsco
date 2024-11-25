@extends('layouts.modern-layout.master')

@section('title')
    Create Permission
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Product categories </h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Create New Category
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            @livewire('create-product-category')
                        </div>


                            @livewire('list-product-category')

                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        
    @endpush
@endsection

