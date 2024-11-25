@extends('layouts.modern-layout.master')

@section('title')
    Create Role
@endsection
@push('css')

@endpush
@section('content')
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Create New Role
                    </div>
                    <div class="card-body">
                        @livewire('create-role')

                        <div class="m-t-10 p-t-10">
                            <livewire:list-role>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
@endsection
