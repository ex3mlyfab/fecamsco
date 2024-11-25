@extends('layouts.modern-layout.master')

@section('title')
    Monthly Contribution Details
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
        <h3>{{$deposit_upload->deduction_period }} Details</h3>
        @endslot

        <li class="breadcrumb-item active">Monthly contribution</li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Total No Item uploaded:&nbsp; <span class="text-secondary">{{$deposit_upload->savingUploads->count()}} </h5>
                                <h5>Total Contribution:&nbsp;  <span class="text-secondary">{!! showAmount($deposit_upload->total_saving) !!}</span></h5>
                                <h5>Uploaded BY :&nbsp;  <span class="text-secondary">{{$deposit_upload->uploadedBy->fullname}}</span></h5>

                            </div>
                            <div class="col-md-4">
                                <div class="card o-hidden border-0">
                                    <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget">
                                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                            <div class="media-body">
                                                <span class="m-0"><a class="text-light" href="#">Remnants</a></span>
                                                <h4 class="mb-0 counter">{{$expectedCtss - $deposit_upload->savingUploads->count()}}</h4>
                                                <i class="icon-bg" data-feather="database"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('approve-deposit')
                            <div class="col-md-4">
                                @if ($deposit_upload->saving_updated_status)
                                <p>click button below to approve update of members savings</p>
                                <a href="{{route('approve.contribution', $deposit_upload->id)}}" class="btn btn-lg btn-outline-success w-100"> Confirm Contribution</a>
                                @else
                                    <h5>All Members contribution updated</h5>
                                @endif

                            </div>
                            @endcan

                        </div>
                    </div>
                    @livewire('deposit-upload-detail', ['deposit_upload_id' => $deposit_upload->id])
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    @endpush
@endsection

