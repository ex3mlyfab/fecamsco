@extends('layouts.modern-layout.master')

@section('title')
  Batch Review
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')

<div class="container-fluid dashboard-default-sec">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-2 b-primary b-r-10">
                <div class="card-header bg-primary text-light text-center">
                    <h5> Review Loan</h5>

                </div>
                <div class="card-body">
                    <h5 class="text-center">Batch  details: {{$batch->batch_id}}</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row border-2 b-r-4 b-primary pt-4 my-5 text-center">
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-bill f-16 p-t-1"></i>Amount</div>
                                    <div>
                                        <h5>{!!showAmount($batch->total_amount) !!}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Approved by</div>
                                    <div>
                                        <h5>{{ $batch->approvedBy->fullname}}</h5>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>Amount</th>
                                <th>Bank Name</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Narration</th>
                            </thead>
                            <tbody>
                                @forelse ($batch->bankMandateDetails as $item)
                                  <tr>
                                    <td>{!! showAmount($item->amount) !!}</td>
                                    <td>{{$item->bank_name}}</td>
                                    <td>{{$item->account_name}}</td>
                                    <td>{{$item->account_number}}</td>
                                    <td>{{$item->narration}}</td>
                                  </tr>
                                @empty
                                  <tr>
                                    <td colspan="4">No item to display</td>
                                  </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection

