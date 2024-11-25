@extends('layouts.modern-layout.master')

@section('title')
    {{ auth()->user()->last_name }}'s Dashboard
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Chart</h3>
        @endslot
        <li class="breadcrumb-item">Widgets</li>
        <li class="breadcrumb-item active">Chart</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <!-- Ajax data source array start-->
            <div class="col-sm-12">
                <div class="card shadow b-1 b-primary">
                    <div class="card-header">
                        <h1>All User's List</h1>
                    </div>
                    <div class="card-body">
                        <livewire:user-table />
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')


    @endpush
@endsection
