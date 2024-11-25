@extends('layouts.modern-layout.master')

@section('title')
    Monthly CTLS Details
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
        <h3>{{$ctls->deduction_period }} Details</h3>
        @endslot

        <li class="breadcrumb-item active">CTLS</li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Total No Item uploaded:&nbsp; <span class="text-secondary">{{$ctls->ctls->count()}} </h5>
                                <h5>Total CTLS:&nbsp;  <span class="text-secondary">{!! showAmount($ctls->total_ctls) !!}</span></h5>
                                <h5>Uploaded BY :&nbsp;  <span class="text-secondary">{{($ctls->uploadedBy->fullname) }}</span></h5>
                            </div>
                            <div class="col-md-4">
                                <div class="card o-hidden border-0">
                                    <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget">
                                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                            <div class="media-body">
                                                <span class="m-0"><a class="text-light" href="#">Remnants</a></span>
                                                <h4 class="mb-0 counter">{{ $expectedCtls -$ctls->ctls->count()}}</h4>
                                                <i class="icon-bg" data-feather="database"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if ($ctls->ctls_updated_status)
                                <p>click button below to approve update of members CtLS</p>
                                <a href="{{route('approve.ctls', $ctls->id)}}" class="btn btn-lg btn-outline-success w-100"> Process CTLS</a>
                                @else
                                    <h5>All Members CTLS updated</h5>
                                @endif

                            </div>
                        </div>
                    </div>
                    @livewire('credit-upload-detail', ['ctls_id' => $ctls->id])
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    @endpush
@endsection

