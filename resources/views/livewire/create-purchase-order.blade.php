<div>

    <form wire:submit.prevent="store">
        @csrf
        <div class="row gx-2 p-10 ">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2">Select Supplier <span class="text-danger">*</span></label>
                    <select class="form-control input-air-secondary digit @error('supplier_id') is-invalid @enderror"
                        id="witness2" placeholder="Select Supplier"  wire:model="supplier_id">
                        <option value="">--Please choose a Supplier--</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                </select>

                </div>
            </div>
            <div class="d-flex justify-content-between">
            <h5 class="text-center">Add Products to Order </h5>
            <button wire:click.prevent="addOrder" class="btn btn-lg btn-info"><i class="fa fa-plus-circle"></i> Add More Rows</button>

            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-primary">
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($adding as $key=>$item)
                        <tr>
                            <td>
                                <select class="form-control input-air-secondary digit" id="witness2.{{$key}}" placeholder="Select Product"  wire:model="purchase_order.{{$key}}.product_service_id" wire:change.debounce.500ms="calculateTotal({{$key}})" >
                                    <option value="">--Please choose Product--</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}" >{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div>
                                    <input type="number" wire:model="purchase_order.{{$key}}.quantity" id="qty.{{$key}}" class="form-control input-air-secondary">
                                    @error('purchase_order'.$key.'quantity')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" wire:model="purchase_order.{{$key}}.price" id="price.{{$key}}"  wire:keyup.debounce.500ms="calculateTotal({{$key}})" class="form-control input-air-secondary">
                                    @error('purchase_order'.$key.'price')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                            </td>
                            <td>
                                <input type="number" wire:model="purchase_order.{{$key}}.total" id="total.{{$key}}" class="form-control input-air-secondary">
                            </td>
                            <td>
                                <button wire:click.prevent="removeOrder({{$key}})" class="btn btn-sm btn-danger" wire:key="formbutton.{{$key}}"> Delete</button>
                            </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><h3>Total</h3></td>
                            <td><h5>{!!showAmount($orderTotal)!!}</h5></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row m-t-10">


                </div>
            </div>


            <button class="btn btn-lg btn-outline-secondary w-100" type="submit" >Click to Create Purchase Order </button>
        </div>
    </form>{{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
