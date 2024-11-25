<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <form wire:submit.prevent="store">
        @csrf
        <div class="row gx-2 p-10 ">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2_phone">Product Name <span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('productname') is-invalid @enderror"
                        id="witness2_phone" placeholder="product Name" type="text" wire:model="name" />
                    @error('productname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2">Product Category <span class="text-danger">*</span></label>
                    <select class="form-control input-air-secondary digit @error('productcategory') is-invalid @enderror"
                        id="witness2" placeholder="product category" type="text" wire:model="productcategory" >
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('productcategory')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witne">Product Reorder Level <span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('reorder_level') is-invalid @enderror"
                        id="witne" placeholder="product Reorder Level" type="number" wire:model="reorder_level" >


                    @error('reorder_level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness">Product Description</label>
                    <textarea  id="witness" cols="30" rows="3" class="form-control" wire:model="desription"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-lg btn-outline-secondary w-100" >Click to Create Product </button>
        </div>
    </form>{{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
