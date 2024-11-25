@extends('layouts.modern-layout.master')

@section('title')
   Assign Role 
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush
@section('content')
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow border-2 b-primary">
                    <div class="card-header bg-primary text-light text-center">
                        <h3> Assign User Role</h3>
                    </div>
                    <div class="card-body">
                        @if (session('errors'))
                            <div class="bg-danger text-light">
                                <ul>
                                @foreach (session('errors')->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('role.process')}}" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-12">
                                <label class="col-form-label" for="select_member">Select Member</label>
                                    <select class="js-example-basic-single col-sm-12" name="user_id" id="select_member" required>
                                        <option value="">--select a Member --</option>
                                        @foreach ($users as $item)
                                            <option value="{{$item->id}}">{{$item->fullname}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-12">
                                <label class="col-form-label" for="select-role">Role</label>
                                    <select class="js-example-basic-single col-sm-12" name="role_id" id="select-role" required>
                                        <option value="">--Select a Role --</option>
                                        @foreach ($roles as $more)
                                            <option value="{{$more->id}}">{{$more->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-outline-primary w-100 m-t-10"> Submit</button>
                    </form>

                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
        });
    </script>
    @endpush
@endsection
