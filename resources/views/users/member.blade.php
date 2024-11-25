@extends('layouts.modern-layout.master')

@section('title')
    {{ auth()->user()->last_name }}'s Dashboard
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush
@section('content')
    @yield('breadcrumb-list')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Membership Form</h3>
        @endslot

        <li class="breadcrumb-item active"></li>
    @endcomponent
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0 b-b-secondary">
                        <h5>Complete Your Membership Registration</h5>
                        <span>Please ensure all the mandatory fields marked with (<span class="text-danger">*</span>) are
                            filled before clicking on next button</span>

                        @if (session('errors'))
                            <div class="bg-danger text-primary">
                                <ul>
                                @foreach (session('errors')->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form class="form-wizard" id="regForm" action="{{ route('store-register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input class="form-control" id="first_name" type="text"
                                                value="{{ auth()->user()->first_name }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input class="form-control input-air-secondary" id="middle_name" type="text"
                                                placeholder="Middle Name" name="middle_name"
                                                value="{{ old('middle_name') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input class="form-control" id="last_name" type="text"
                                                value="{{ auth()->user()->last_name }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telephone">Telephone No.<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digits" id="telephone"
                                                type="number" placeholder="123456789" name="telephone" required
                                                value="{{ old('telephone') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact">E Mail.</label>
                                            <input class="form-control input-air-secondary" id="contact" type="email"
                                                value="{{ auth()->user()->email }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Department/Division<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="exampleFormControlInput1"
                                                type="text" placeholder="department" required name="department"
                                                value="{{ old('department') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Location</label>
                                            <input class="form-control input-air-secondary" id="exampleInputPassword1"
                                                type="text" placeholder="location" value="{{ old('location') }}"
                                                name="location" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="file_no">File No<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="file_no" type="text"
                                                value="{{ old('file_no') }}" name="file_no" placeholder="File No"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ippis_no">IPPIS No.<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="ippis_no"
                                                type="number" placeholder="IPPIS No" name="ippis_no"
                                                value="{{ old('ippis_no') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="rank">Rank<span class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="rank" type="text"
                                                placeholder="Rank" value="{{ old('rank') }}" name="rank" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="grade">Grade</label>
                                            <input class="form-control input-air-secondary" id="grade" type="text"
                                                value="{{ old('grade') }}" placeholder="Grade" name="grade" />
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="tab">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="residential">Residential Address<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="residential" name="residential_address" value="{{ old('residential_address') }}"
                                                placeholder="Residential Address" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="permanent">Permanent/ Home Town<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="permanent" name="permanent_address" value="{{ old('permanent_address') }}"
                                                placeholder="Permanent Address" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="nok">Next of Kin<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="nok"
                                                placeholder="Next of Kin" type="text" name="next_of_kin"
                                                value="{{ old('next_of_kin') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="nok_relationship">Relationship<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="nok_relationship"
                                                placeholder="Next of Kin" type="text" name="nok_relationship"
                                                value="{{ old('nok_relationship') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nok_address">Address of Next of Kin<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="nok_address" name="nok_address" value="{{ old('nok_address') }}"
                                                placeholder="nok Address" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="deduction_amount">Amount to be deducted<span
                                                    class="text-danger">*</span>.</label>
                                            <div class="input-group">
                                                <span class="input-group-text input-air-secondary">₦</span>
                                                <input class="form-control input-air-secondary digit"
                                                    id="deduction_amount" type="number" placeholder="Deduction Amount"
                                                    name="deduction_amount" value="{{ old('deduction_amount') }}"
                                                    min="5000"
                                                    required />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="effective_date">Effective Date<span class="text-danger">*</span>
                                                .</label>
                                            <input class="datepicker-here form-control input-air-secondary digit"
                                                id="effective_date" type="text" placeholder="with effect from"
                                                name="effective_date" data-language="en"
                                                value="{{ old('effective_date') }}" required />
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="tab">
                                <h2 class="text-center">Witness to Applicant details</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness1">Name of Witness I<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness1"
                                                placeholder="witness name I" type="text" name="witness_name[]"
                                                value="{{ old('witness_name[0]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness1_dept">Department of Witness I<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness1_dept"
                                                placeholder="witness I Department" type="text"
                                                name="witness_department[]"
                                                value="{{ old('witness_dept[0]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness1_phone">Telephone of Witness I<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="witness1_phone"
                                                placeholder="witness I Phone" type="text" name="witness_phone[]"
                                                value="{{ old('witness_phone[0]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness2">Name of Witness II<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness2"
                                                placeholder="witness name II" type="text" name="witness_name[]"
                                                value="{{ old('witness_name[1]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness2_dept">Department of Witness II<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness2_dept"
                                                placeholder="witness II Department" type="text"
                                                name="witness_department[]"
                                                value="{{ old('witness_dept[1]') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness2_phone">Telephone of Witness II<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="witness2_phone"
                                                placeholder="witness II Phone" type="text" name="witness_phone[]"
                                                value="{{ old('witness_phone[1]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness3">Name of Witness III<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness3"
                                                placeholder="witness name III" type="text" name="witness_name[]"
                                                value="{{ old('witness_name[2]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness3_dept">Department of Witness III<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness3_dept"
                                                placeholder="witness III Department" type="text"
                                                name="witness_department[]"
                                                value="{{ old('witness_dept[2]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="witness3_phone">Telephone of Witness III<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="witness3_phone"
                                                placeholder="witness III Phone" type="text" name="witness_phone[]"
                                                value="{{ old('witness_phone[2]') }}"
                                                required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <h1 class="text-center">Declaration of Applicant</h1>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="p-5 border-1 b-r-2">
                                            I <u id="declare" class="txt-info"></u> &nbsp; hereby apply for the
                                            membership of the
                                            FMC Consumer Cooperative Thrift and Credit Society Limited. Abuja. If admitted
                                            and
                                            Registered undertake to abide by the provisions of the Bye-Laws and Rules of the
                                            Society registered under the Northern Region Cooperative Societies, Law No. 9 of
                                            1956 and other relevant Laws of the Federal Republic of Nigeria.
                                        </p>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-dark m-squar">
                                                <input id="inline-sqr-3" type="checkbox" name="declared" required>
                                                <label for="inline-sqr-3">Click here to affirm <span
                                                        class="text-danger">*</span>.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label" for="upload_passport">Upload Your Passport
                                                    Photograph <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file"
                                                        name="passport_photograph" id="upload_passport" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div>
                                <div class="text-end btn-mb">
                                    <button class="btn btn-secondary" id="prevBtn" type="button"
                                        onclick="nextPrev(-1)"> Previous</button>
                                    <button class="btn btn-primary" id="nextBtn" type="button"
                                        onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                            <!-- Circles which indicates the steps of the form:-->
                            <div class="text-center"><span class="step"></span><span class="step"></span><span
                                    class="step"></span><span class="step"></span></div>
                            <!-- Circles which indicates the steps of the form:-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('assets/js/form-wizard/form-wizard.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#effective_date').datepicker({
                    language: 'en',
                    minDate: new Date() // Now can select only dates, which goes after today
                });

                $('#telephone').on("change", function() {
                    let sname = $('#first_name').val() + ' ' + $('#middle_name').val() + ' ' + $('#last_name')
                        .val();

                    $("#declare").text(sname);
                });
            });
        </script>
    @endpush
@endsection
