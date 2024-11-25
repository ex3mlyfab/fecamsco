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
                    <label class="witness2_phone">Supplier Name <span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('name') is-invalid @enderror"
                        id="witness2_phone" placeholder="Supplier Name" type="text" wire:model="name" />
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2">Phone Number <span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('phone') is-invalid @enderror"
                    id="witness2" placeholder="Supplier phone" type="text" wire:model="phone" />
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness">Supplier Address</label>
                    <textarea  id="witness" cols="30" rows="3" class="form-control" wire:model="address"></textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-lg btn-outline-info w-100" >Click to Create Supplier </button>
        </div>
    </form>{{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
