@props(['products'])
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <th>SN</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Line Total</th>
            <th>-</th>
        </thead>
        <tbody>
            <tr>
                <td><h5>#</h5></td>
                <td>
                    <select class="js-example-basic-single " id="select_product" >
                        <option value=" ">--Please choose Product--</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id. "," .$product->current_selling. ",". $product->name}}"> {{$product->name}} </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <div class="form-group">
                        <input type="number" class="form-control input-air-secondary" id="product_price" readonly>
                    </div>

                </td>
                <td>
                    <div>
                        <input type="number" id="qty_pr" class="form-control input-air-secondary">
                    </div>

                </td>

                <td>
                    <input type="number" id="total_pr" class="form-control input-air-secondary" readonly>
                </td>
                <td>
                    <span class="badge badge-danger" id="already-added">Present in cart</span>
                    <button  type="button" class="btn btn-sm btn-danger" id="add-product" disabled >ADD Product </button>
                </td>

            </tr>
        </tbody>
        <tbody id="tbody">

        </tbody>
    </table>
</div>


