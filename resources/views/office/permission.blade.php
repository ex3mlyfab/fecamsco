@extends('layouts.modern-layout.master')

@section('title')
    Create Permission
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Permission </h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Create New Permission
                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary">
                            @livewire('create-permission')
                        </div>

                        <div class="mt-8 p-t-10">
                            <livewire:list-permission>
                        <div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
@endsection

