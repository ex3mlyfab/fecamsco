@extends('layouts.modern-layout.master')

@section('title')
    Users' Loan
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">All loan List</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-2 b-primary">
                    <div class="card-header bg-primary text-light text-center">
                        <h5>Loan details</h5>
                    </div>
                    <div class="card-body">
                        {{-- <livewire:self-loan-detail  theme="bootstrap-4" > --}}
                            @livewire('self-loan-detail', ['user_id' => $user->id,
                            'theme' => 'bootstrap-4'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection
