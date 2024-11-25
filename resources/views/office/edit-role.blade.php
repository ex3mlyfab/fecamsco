@extends('layouts.modern-layout.master')

@section('title')
    Edit Role
@endsection
@push('css')

@endpush
@section('content')
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow border-2 b-primary">
                    <div class="card-header bg-primary text-light">
                        Edit Role
                    </div>
                    <div class="card-body">
                        @livewire('edit-role',['role_id'=> $role->id])

                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
@endsection
