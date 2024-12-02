@extends('layouts.modern-layout.master')

@section('title')
    Manual Deposit
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Manual Member Deposit</li>
    @endcomponent

    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body px-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="rounded-circle shadow border-2 b-light" width="200" alt="{{$user->last_name}}"
                                            src="{{ ($user->member()->exists()) ? asset(user_avatar($user->member->avatar)) : asset('femcas-logo.png') }}" />

                                            <h3 class="mb-1 f-20 txt-primary">{{ $user->fullname }}</h3>
                                    <p class="f-12">
                                        <x-badge :user="$user"></x-badge>
                                    </p>
                                </div>
                                <div class="col-md-4">


                                    @isset($user->member)
                                    <div class="row border-2 b-r-4 b-primary">
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Telephone</div>
                                            <div>
                                                <h5>{{ $user->member->telephone ?? '' }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i>Email</div>
                                            <div>
                                                <h5>{{ $user->email }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Department/Division</div>
                                            <div>
                                                <h5>{{ $user->member->department ?? " "}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-clip f-16 p-t-1"></i>File Number</div>
                                            <div>
                                                <h5>{{ $user->member->file_no ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-list f-16 p-t-1"></i>IPPIS No</div>
                                            <div>
                                                <h5>{{ $user->member->ippis_no?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Location</div>
                                            <div>
                                                <h5>{{ $user->member->location ?? " " }}</h5>
                                            </div>
                                        </div>



                                    </div>

                                    @endisset
                                    @if (!isset($user->member))
                                            <h1>member has not completed registration</h1>
                                    @endif


                                </div>

                                <div class="col-md-8">
                                     <div class="col-12">
                                        <div class="card border-2 b-primary">
                                            <div class="card-header bg-primary text-light text-center">
                                                <h5>Manual Deposit</h5>
                                            </div>
                                            <div class="card-body">
                                                <livewire:update-user-deposit  :user_id="$user->id">
                                            </div>
                                        </div>
                                    </div>
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
