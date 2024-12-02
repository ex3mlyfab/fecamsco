@extends('layouts.modern-layout.master')

@section('title')
    ALL EXECUTIVES
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3> EXECUTIVE MEBERS</h3>
            {{public_path()}}
        @endslot
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary text-light text-center d-flex flex-row justify-content-between">
                        <h5>EXECUTIVE LIST</h5>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal"
                            data-original-title="test" data-bs-target="#exampleModal">Add New Executive</button>

                    </div>
                    <div class="card-body">
                        <div class="shadow border-2 b-primary p-15 m-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Avatar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($executives as $executive)
                                            <tr>
                                                <td>{{ $executive->user->fullname }}</td>
                                                <td>{{ $executive->position }}</td>
                                                <td>{{ $executive->avatar ?? "<span class='pill pill-badge-info'>No Image uploaded</span>" }}
                                                </td>
                                                <td><button class="btn btn-small btn-primary edit-button"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        data-id="{{ $executive->id }}" data-name="{{ $executive->user_id }}"
                                                        data-position="{{ $executive->position }}"
                                                        data-avatar="{{ $executive->avatar }}"
                                                        data-status="{{ $executive->status }}"
                                                        id="edit{{ $executive->id }}">edit</button>
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
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Executive</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('executive.store') }}" id="regForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label class="col-form-label">Select Member</label>
                                <select class="js-example-basic-single col-sm-12" name="user_id" id="select-user">
                                    @foreach ($members as $item)
                                        <option value="{{ $item->user_id }}">{{ $item->user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="value"> Position </label>
                            <input type="text" name="position" id="value" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="col-sm-3 col-form-label">Upload Picture</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" name="avatar" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="media">
                                    <label class="col-form-label m-r-10">Status</label>
                                    <div class="media-body text-end">
                                        <label class="switch">
                                            <input type="checkbox" name="status" id="status-id" value="1" checked=""><span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script>
            $(document).ready(function() {

                $(".js-example-basic-single").select2();
                $('.edit-button').click(function() {
                    var id = $(this).data('id');
                    var userId = $(this).data('name');
                    var position = $(this).data('position');
                    let avatar = $(this).data('avatar');
                    $('#exampleModalLabel').text('Update executive');
                    $('#select-user').val(userId);
                    $('#value').val(position);
                    $('#regForm').attr('action', "{{ url('/') }}/application/update-executive/" + id);
                    $('#regForm').append('<input type="hidden" name="_method" value="PATCH">');
                });

                $('#exampleModal').on('hidden.bs.modal', function() {
                    $('#regForm').attr('action', "{{ route('executive.store') }}");
                    $('#regForm').find('input[name="_method"]').remove();
                    $('#regForm')[0].reset();
                });
            });
        </script>
    @endpush
@endsection
