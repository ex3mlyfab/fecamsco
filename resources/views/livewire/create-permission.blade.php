<div class="card b-2 b-secondary m-5 p-5 b-r-5">
    <form wire:submit.prevent="store">
        @csrf
        <div class="row gx-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2_phone">Permission<span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('permission_name') is-invalid @enderror"
                        id="witness2_phone" placeholder="permission name" type="text" wire:model="permission_name" />
                    @error('permission_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-lg btn-outline-secondary w-100" >Click to Create Permission </button>
        </div>
    </form>
</div>

