@extends('layouts.modern-layout.master')

@section('title')
 All Analysis
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterange-picker.css') }}">
@endpush
@section('content')

    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light text-center d-flex flex-row justify-content-between">
                        <h5>All Analysis</h5>
                    </div>

                    <div class="card-body">

                        {{-- @foreach ($ctss_year as $item)
                        {{$item['year']}}
                        @endforeach --}}
                         <div class="row mb-2">
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('Year') }}</label>
                                <select class="form-select btn-pill digits select-filter" id="exampleFormControlSelect7" name="year">
                                    <option value="">Select Year</option>
                                    @foreach ($ctss_year as $item)
                                        <option value="{{ $item['year'] }}" @selected(now()->year ==  $item['year'])>{{  $item['year'] }}</option>
                                    @endforeach
								</select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('Select date Range') }}</label>
                                <div class="form-group">
                                    <input class="form-control digits" type="text" name="daterange" id="date_range" />
                                </div>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label>{{ __('Member Name') }}</label>
                                <input type="text" class="form-control select-filter" name="last_name" id="first-name">
                            </div>

                        </div>
                        <div class="shadow border-2 b-primary p-15 m-5">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="analysis">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

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
    <script src="{{ asset('assets/js/datepicker/daterange-picker/moment.min.js') }}"></script>
     <script src="{{ asset('assets/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
        <script>
            $(document).ready(function () {
                 function drawTable(){
                    $.ajax({
                        url: "{{ route('analysis.deposit')}}",
                        method: "post",
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            year: $('select[name=year]').val()
                        },
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                    }
                })
             }
                drawTable();
                $('.select-filter').on('change', function(e) {
                        drawTable();
                });



            });
        </script>
    @endpush
@endsection

