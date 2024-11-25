<div class="card b-2 b-secondary m-5 p-5 b-r-5">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <form wire:submit.prevent="store">
        @csrf
        <div class="row gx-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2_phone">Product Category <span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('productcategory') is-invalid @enderror"
                        id="witness2_phone" placeholder="product/Service Category" type="text" wire:model="productcategory" />
                    @error('productcategory')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-lg btn-outline-secondary w-100" >Click to Create Product Category </button>
        </div>
    </form>
</div>
