@extends('layouts.pdf-views.master')

@section('title')Loan Application's form
@endsection

@section('content')
<h1 style="text-align: center; width:100%; padding:3px; border: 2px dashed #454545;">Loan Application Form</h1>
<div class="row">
    <div class="col-12">
        <h4 style="text-decoration: underline">Attestation</h5>

        <p class="p-3 border-1 b-r-2 f-20">
            I <u id="declare" class="txt-info">{{$fullname}}</u> &nbsp; hereby apply for the
            Sum of {!!showAmount($loan_amount)!!} from
            FMC Consumer Cooperative Thrift and Credit Society Limited. Abuja. for the purpose of {{$purpose}}.
            <br> I also consent to the deduction of   {!!showAmount($deduction)!!} from my monthly Salary for the period of {{$total_installments}} Months.
            .
        </p>
        <p style="padding-top:5px;margin-top:5px; border-top:2px solid #000; width:100%;">Member Signature & Date: &nbsp; &nbsp;.................................................</p>


    </div>
</div>
<div class="row" style="margin-top:20px; padding-top:20px;">
<h4 class="tet-center">Guarantors' List:</h4>
<p>Notice: Guarantors are to verify their information and append their signatures</p>

    <table border="2">
        <thead>
            @foreach ($guarantors as $key=>$value)
                <tr>
                    <th><div class="bg-primary text-center text-light">Witness {{ $key + 1 }} Name</div>
                            <p style="text-decoration: underline">{{ $value->name}}</p></th>
                    <th><div class="bg-primary text-center text-light">Witness {{ $key + 1 }} Department</div>
                        <p style="text-decoration: underline">{{ $value->department}}</p></th>
                    <th><div class="bg-primary text-center text-light">Witness {{ $key + 1 }} Phone</div>
                        <p style="text-decoration: underline"> {{ $value->phone}}</p></th>
                    <th>
                        <div class="bg-primary text-center text-light">Witness {{ $key + 1 }} Signature</div>
                        <p>&nbsp;</p>
                    </th>
                </tr>

    @endforeach
        </thead>
    </table>

</div>
<p>Notice: Fill the form and upload a copy to the portal and submit one at FEMCAS Secretariat</p>



@endsection


