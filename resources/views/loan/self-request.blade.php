@extends('layouts.modern-layout.master')

@section('title')
   Loan Application
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')


<div class="container-fluid dashboard-default-sec">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-2 b-success b-r-6">
                <div class="card-header pb-0 b-b-secondary">
                    <h5>Apply for Loan</h5>
                    @if (session('errors'))
                    <div class="bg-danger text-light">
                        <ul>
                        @foreach (session('errors')->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('self-store.loan') }}" method="POST" id="loan">
                        @csrf

                    <label>Type of loan</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="media p-20">
                                    <div class="radio radio-primary me-3">
                                        <input id="radio14" type="radio" class="loan-type" name="loan_type" value="Financial" />
                                        <label for="radio14"></label>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mega-title-badge">Financial Loan</h6>
                                        <p>Cash advance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="media p-20">
                                    <div class="radio radio-secondary me-3">
                                        <input id="radio13" type="radio" class="loan-type" name="loan_type" value="Electronics" />
                                        <label for="radio13"></label>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mega-title-badge">Electronics Loan</h6>
                                        <p>Electronics/Appliances </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="loan_amount">Loan Amount<span
                                        class="text-danger">*</span>.</label>
                                <div class="input-group">
                                    <span class="input-group-text input-air-secondary">₦</span>
                                    <input class="form-control input-air-secondary digit"
                                        id="loan_amount" type="number" placeholder="Loan Amount"
                                        name="amount" value="{{ old('amount') }}"
                                        min="5000"
                                        />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ippis_no">Number of installments<span class="text-danger">*</span></label>
                                <input class="form-control input-air-secondary digit" id="ippis_no"
                                    type="number" placeholder="Installment" name="total_installments"
                                    value="{{ old('total_installments') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="loan_purpose">Loan Purpose<span class="text-danger">*</span></label>
                                <input class="form-control input-air-secondary" id="loan_purpose" type="text"
                                    value="{{ old('purpose') }}" name="purpose" placeholder="Loan Purpose"
                                    required />
                            </div>
                        </div>
                    </div>
                        <div class="row" id="account_details">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Bank account Number<span class="text-danger">*</span></label>
                                    <input class="form-control input-air-secondary digit" id="account_no"
                                        type="number" placeholder="Account_number" name="account_number"
                                        value="{{ old('account_number') }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="banke_name">Bank Name<span class="text-danger">*</span></label>
                                    <input class="form-control input-air-secondary" id="banke_name" type="text"
                                        value="{{ old('bank_name') }}" name="bank_name" placeholder="Bank Name"
                                         />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_name">Account Name<span class="text-danger">*</span></label>
                                    <input class="form-control input-air-secondary" id="account_name" type="text"
                                        value="{{ old('account_name') }}" name="account_name" placeholder="Account Name"
                                         />
                                </div>
                            </div>
                        </div>
                        <div class="row pb-5"  id="product-in-select">
                            <x-product-line :products="$products"></x-product-line>
                        </div>
                        <div class="row" class="border-2 b-primary">
                            <h2 class="text-center">Loan Guarantors' details</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness1">Name of Witness I<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness1"
                                                placeholder="witness name I" type="text" name="witness_name[]"
                                                value="{{ old('witness_name[0]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness1_dept">Department of Witness I<span
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
                                            <label class="witness1_phone">Telephone of Witness I<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="witness1_phone"
                                                placeholder="witness I Phone" type="text" name="witness_phone[]"
                                                value="{{ old('witness_phone[0]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness2">Name of Witness II<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness2"
                                                placeholder="witness name II" type="text" name="witness_name[]"
                                                value="{{ old('witness_name[1]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness2_dept">Department of Witness II<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness2_dept"
                                                placeholder="witness II Department" type="text"
                                                name="witness_department[]"
                                                value="{{ old('witness_dept[1]') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness2_phone">Telephone of Witness II<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="witness2_phone"
                                                placeholder="witness II Phone" type="text" name="witness_phone[]"
                                                value="{{ old('witness_phone[1]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness3">Name of Witness III<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary" id="witness3"
                                                placeholder="witness name III" type="text" name="witness_name[]"
                                                value="{{ old('witness_name[2]') }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="witness3_dept">Department of Witness III<span
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
                                            <label class="witness3_phone">Telephone of Witness III<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control input-air-secondary digit" id="witness3_phone"
                                                placeholder="witness III Phone" type="text" name="witness_phone[]"
                                                value="{{ old('witness_phone[2]') }}"
                                                required />
                                        </div>
                                    </div>
                                </div>
                        </div>
                         <div class="my-3"><h5>NB: An admin charge of {!! showAmount($admincharge) !!} will be applied to Loan Amount Granted</h5></div>
                        <button type="submit" class="btn btn-lg btn-outline-primary w-100">Apply for Loan</button>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script>
      $(document).ready(function() {
            // Create a function to toggle the class
            $('#already-added').hide();
            $("#product-in-select").hide();


            $(".js-example-basic-single").select2();
            // Denotes total number of rows
            var rowIdx = 0;
            let product_price, product_name, product_quantity, product_line_total, select_product_id;
            const product_ids = [];
            const product_prices = [];

            $('#select_product').on('change', function(){
                // console.log('event success');
                let product_array = $(this).val().split(",");
                product_name = product_array[2];
                product_price = parseInt(product_array[1]);
                select_product_id = parseInt(product_array[0]);


                product_quantity =product_quantity? product_quantity : 0;
                // console.log(product_price, product_name, product_id);
                calculate_total(product_price, product_quantity);
                $('#product_price').val(product_price);

            });
            $('#qty_pr').on('keyup', function(){
                let price = (product_price) ? product_price: 0;
                product_quantity = $(this).val();
                calculate_total(price, product_quantity);
            })
            function prIdCount(arr, element){
                return arr.filter((currentElement) => currentElement == element).length;
            }


            function selectedProductSum(){
                    let sum = 0;

                    // calculate sum using forEach() method
                    product_prices.forEach( num => {
                    sum += num;
                    })
                    return sum;
            }
            function calculate_total(price, quantity){
                let  pr_price = price ? parseInt(price) : 0;
                let  qty = quantity ? parseInt(quantity) : 0;
                let total = pr_price*qty;
                product_line_total = total;
                // console.log("product_id:"+ product_ids)
                $('#total_pr').val(total);
                if(total > 0 && select_product_id > 0){
                $('#add-product').attr('disabled', false);
                }
            }
            // jQuery button click event to add a row
            $('#add-product').on('click', function () {

                product_ids.push(select_product_id);
                let occurence = prIdCount(product_ids, select_product_id);
                // console.log(occurence);


                if(occurence < 2){
                    $('#tbody').append(`<tr id="R${++rowIdx}" data-productId ="${select_product_id}">
                    <td class="row-index"><p>${rowIdx}</p></td>
                    <td class="text-center">
                        <input type="hidden" name="product_service_id[]" value="${select_product_id}" >
                        <input type="hidden" name="product_price[]" value="${product_price}" >
                        <input type="hidden" name="product_quantity[]" value="${product_quantity}" >
                        <input type="hidden" name="select_line_total[]" id="Pr${select_product_id}" value="${product_line_total}" >
                        <p> ${product_name}</p>
                    </td>
                    <td>
                        <p> ${product_price}</p>
                    </td>
                    <td>
                        <p>${product_quantity}</p>
                        </td>
                    <td><p class"productSelected">${product_line_total}</p></td>
                    <td class="text-center">
                        <button class="btn btn-danger remove"
                        type="button">Remove</button>
                        </td>
                    </tr>`);

                    product_prices.push( parseInt( $('#Pr'+ select_product_id).val()))


                    $('#loan_amount').val(selectedProductSum());
                }else{
                    let pr_index= product_ids.indexOf(select_product_id);

                   product_ids.splice(pr_index, 1);
                   $('#already-added').show()
                   setTimeout(() => {
                        $('#already-added').fadeOut('fast');
                   }, 1000);

                }
                resetProductForm();

                // Adding a row inside the tbody.

            });
            function clearProductTable(){
                $('#tbody').children("tr").remove();
                resetProductForm();
                product_ids = [];
                product_prices = [];
                $('#loan_amount').attr('readonly', false);

            }
            function resetProductForm(){
                select_product_id = 0;
                    product_price =0;
                    product_quantity = 0;
                    product_line_total = 0;
                    product_name = " ";
                    $('#product_price').val(0);
                    $('#add-product').attr('disabled', true);
                    $('#select_product').val(" ") ;
                    $('#qty_pr').val(0);
                    $('#total_pr').val(0)
            }
            $("#elect_product").on('change', function(){

                $('#tbody').append(`<tr id="R${++rowIdx}">
                    <td class="row-index text-center">
                    <p></p>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger remove"
                        type="button">Remove</button>
                        </td>
                    </tr>`);x
            })
             // jQuery button click event to remove a row.
                $('#tbody').on('click', '.remove', function () {

                    // Getting all the rows next to the row
                    // containing the clicked button
                    var child = $(this).closest('tr').nextAll();

                    let productIndex = $(this).closest('tr').attr('data-productId');
                    // console.log(productIndex);
                    let productP_value = parseInt( $('#Pr'+ productIndex).val())
                    let productP_index = product_prices.indexOf(productP_value);
                    let pr_index= product_ids.indexOf(productIndex);

                   product_ids.splice(pr_index, 1);
                   product_prices.splice(productP_index, 1);

                    // Iterating across all the rows
                    // obtained to change the index
                    child.each(function () {

                        // Getting <tr> id.
                        var id = $(this).attr('id');

                        // Getting the <p> inside the .row-index class.
                        var idx = $(this).children('.row-index').children('p');

                        // Gets the row number from <tr> id.
                        var dig = parseInt(id.substring(1));

                        // Modifying row index.
                        idx.html(`${dig - 1}`);

                        // Modifying row id.
                        $(this).attr('id', `R${dig - 1}`);
                    });

                    // Removing the current row.

                    $(this).closest('tr').remove();
                    $('#loan_amount').val(selectedProductSum());
                    // Decreasing total number of rows by 1.
                    rowIdx--;
                    });


                // Bind the toggleClass function to the click event of the button
                $('.loan-type').on('change', toggleClass);
                function toggleClass() {
                    // Get the current class list of the element
                    let cover = $(this).val();

                    // Show Bank details Section if val == Financials loan
                    if (cover =="Financial") {
                        $("#account_details").show()
                        $("#product-in-select").hide()
                        clearProductTable();

                    } else {
                        // Otherwise, remove it
                        $('#loan_purpose').val("Electronics/Appliances/Foodstuff");
                        $("#account_details").hide()
                        $("#product-in-select").show();
                        $('#loan_amount').attr('readonly', true);

                    }
                }


        });
</script>
@endpush
@endsection


