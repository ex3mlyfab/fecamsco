@extends('layouts.modern-layout.master')

@section('title')
 App Settings
@endsection
@push('css')

@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3> All Settings</h3>
        @endslot

       
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex flex-row justify-content-between">
                        <h5>All Suettings</h5>
                        <a href="{{route('app-setting.create')}}" class="btn btn-small btn-secondary">Add Setting <i class="fa fa-arrow-circle-right"></i> </a>

                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary p-15 m-5">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Value</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <td>{{$setting->name}}</td>
                                            <td>{{$setting->value}}</td>
                                            <td><button class="btn btn-small"></button>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
@endsection

