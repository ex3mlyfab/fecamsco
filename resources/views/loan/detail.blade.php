@extends('layouts.modern-layout.master')

@section('title')
  Review Loan Application
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
                    <h5 class="text-center">Member details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <img class="rounded-circle shadow border-2 b-light" width="200" alt="{{$loan->user->last_name}}"
                                            src="{{ asset(user_avatar($loan->user->member->avatar)) }}" />

                        <h3 class="mb-1 f-20 txt-primary">{{ $loan->user->fullname }}</h3>
                        </div>
                        <div class="col-md-8">
                            @isset($loan->user->member)
                                    <div class="row border-2 b-r-4 b-primary pt-4 my-5 text-center">
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Telephone</div>
                                            <div>
                                                <h5>{{ $loan->user->member->telephone ?? '' }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i>Email</div>
                                            <div>
                                                <h5>{{ $loan->user->email }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Department/Division</div>
                                            <div>
                                                <h5>{{ $loan->user->member->department ?? " "}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-clip f-16 p-t-1"></i>File Number</div>
                                            <div>
                                                <h5>{{ $loan->user->member->file_no ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-list f-16 p-t-1"></i>IPPIS No</div>
                                            <div>
                                                <h5>{{ $loan->user->member->ippis_no?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Location</div>
                                            <div>
                                                <h5>{{ $loan->user->member->location ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-bill-alt f-16 p-t-1"></i>Total Contribution</div>
                                            <div>
                                                <h5 class="text-center">{!! showAmount($loan->user->total_contribution) !!}</h5>
                                            </div>
                                        </div>


                                    </div>

                                    @endisset
                        </div>
                    </div>
                    <h5 class="text-center">Loan {{$loan->status == 0 ? "Application": " "}} Details</h5>
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
                                    <h5>{{ showAmountPer($loan->amount) }}</h5>
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

                    @if ($loan->loan_type == 2)
                        @if (($loan->status==0 && $loan->loanProduct()->exists()) || $loan->status == 3)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Product Name </th>
                                        <th> Qty</th>
                                        <th> Selling Price</th>
                                        <th> Line Total</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($loan->loanProduct->loanProductDetails as $loanProduct)
                                        <tr>
                                            <td>{{$loop->index +1}}</td>
                                            <td>{{$loanProduct->productService->name}}</td>
                                            <td>{{$loanProduct->quantity}}</td>
                                            <td>{{showAmountPer($loanProduct->selling_price)}}</td>
                                            <td>{{showAmountPer($loanProduct->quantity * $loanProduct->selling_price)}}</td>
                                        </tr>
                                        @empty
                                            <td colspan="5"><p>No Item to display</P></td>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                         @else
                         <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Product Name </th>
                                    <th> Qty</th>
                                    <th> Selling Price</th>
                                    <th> Line Total</th>
                                </thead>
                                <tbody>
                                    @foreach ($loan->sale->productSales as $item)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$item->productService->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->selling_price}}</td>
                                        <td>{{$item->quantity * $item->selling_price}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    @endif
                    @if ($loan->status==0)
                    <form id="approve-loan" action="{{route('approve.loan')}}" method="POST">
                        @csrf
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                    </form>
                    <form id="decline-loan" action="{{route('decline.loan')}}" method="POST">
                        @csrf
                        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                    </form>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{route('approve.loan')}}" class="btn btn-lg btn-outline-success w-100" onclick="event.preventDefault();
                    document.getElementById('approve-loan').submit();"> Approve Loan</a>

                        </div>
                        <div class="col-6">
                            <a href="{{route('decline.loan')}}" class="btn btn-lg btn-danger w-100" onclick="event.preventDefault();
                    document.getElementById('decline-loan').submit();"> Decline Loan</a>
                        </div>
                    </div>



                    @endif
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

