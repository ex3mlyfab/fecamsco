@extends('layouts.modern-layout.master')

@section('title')
    Users' Deposit
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Contribution History</h3>
        @endslot
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">All contributions List</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-2 b-primary">
                    <div class="card-header bg-primary text-light text-center">
                        <h5>Contributions Details</h5>
                    </div>
                    <div class="card-body">
                        @livewire('self-deposit-detail', ['user_id' => $user->id,
                    'theme' => 'bootstrap-4'])
                        {{-- <livewire:self-deposit-detail  theme="bootstrap-4" > --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection
