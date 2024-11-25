@extends('layouts.modern-layout.master')

@section('title')
  view Loan Details
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')

<div class="container-fluid dashboard-default-sec">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-2 b-primary b-r-10">
                <div class="card-header bg-primary text-light">
                    <h5 class="text-center">Loan {{$loan->status == 0 ? "Application": " "}} Details</h5>
                </div>
                <div class="card-body">

                    <div class="row">

                            <div class="col-md-6">
                                <div class="icon bg-primary text-light">Loan Type</div>
                                <div>
                                    <h5>{{ $loan->loan_type == 1 ? 'Financial' : 'Electronics'  }}</h5>
                                </div>
                            </div>

                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">Amount applied for</div>
                                <div>
                                    <h5>{!! showAmount($loan->amount) !!}</h5>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">Loan Form</div>
                                <div>
                                    <h5>{{ $loan->form? "Uploaded" : "not yet uploaded" }}</h5>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">Loan Purpose</div>
                                <div>
                                    <h5>{{ $loan->purpose ?? '' }}</h5>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">Loan Status</div>
                                <div>
                                    <h5>{!! loan_status($loan->status) !!}</h5>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="icon bg-primary text-light">Loan Disbursed</div>
                                <div>
                                    <h5>{{ $loan->is_disbursed ? 'yes': 'No' }}</h5>
                                </div>
                        </div>
                    </div>



                    @if ($loan->status==1||$loan->status == 2)
                        <h5 class="text-center">Loan Installments Payment</h5>
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <th>
                                        Installment Number
                                    </th>
                                    <th>
                                        Repayment Amount
                                    </th>
                                    <th>
                                        status
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($loan->installments as $item)
                                        <tr>
                                            <td>{{$item->installment_number}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->status? 'Paid': 'Unpaid'}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

