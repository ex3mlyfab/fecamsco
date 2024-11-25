@extends('layouts.modern-layout.master')

@section('title')
    Account Number
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Bank Accounts</h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h3>Create New Account Number</h3>
                    </div>
                    <div class="card-body">
                        @livewire('create-bank-account')

                        <div class="m-t-10 p-t-10">
                            <livewire:list-bank-account>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
@endsection
