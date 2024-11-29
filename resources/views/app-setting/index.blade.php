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
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add New Setting</button>

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
                                            <td>{{$setting->setting_name}}</td>
                                            <td>{{$setting->setting_value}}</td>
                                            <td><button class="btn btn-small btn-primary edit-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{$setting->id}}" data-name="{{$setting->setting_name}}" data-value="{{$setting->setting_value}}" id="edit{{$setting->id}}">edit</button>
                                            </td>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Setting</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('application.store')}}" id="regForm" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Setting Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="value"> Setting Value</label>
                            <input type="text" name="value" id="value" class="form-control">
                        </div>
                     <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {
            $('.edit-button').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var value = $(this).data('value');
                $('#exampleModalLabel').text('Update Setting');
                $('#name').val(name);
                $('#value').val(value);
                $('#regForm').attr('action', "{{url('/')}}/application/updateSetting/" + id);
                $('#regForm').append('<input type="hidden" name="_method" value="PATCH">');
            });

            $('#exampleModal').on('hidden.bs.modal', function () {
                $('#regForm').attr('action', "{{route('application.store')}}");
                $('#regForm').find('input[name="_method"]').remove();
                $('#regForm')[0].reset();
            });
        });

    </script>
    @endpush
@endsection

