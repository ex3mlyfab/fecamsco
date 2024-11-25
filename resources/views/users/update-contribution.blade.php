@extends('layouts.modern-layout.master')

@section('title')
    Users' Contribution History
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush
@section('content')
       <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-2 b-primary">
                    <div class="card-header bg-primary text-light text-center">
                        <h5>Deductions Change</h5>
                    </div>
                    <div class="card-body">

                        @livewire('update-contribution', ['user_id' => $user->id])
                        <div class="card bg-info-light p-5">
                            @livewire('list-contribution-history', ['user_id' => $user->id])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#effective_date').datepicker({
                language: 'en',
                minDate: new Date() // Now can select only dates, which goes after today
            });

            });
    </script>
    @endpush
@endsection
