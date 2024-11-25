<div class="card b-2 b-secondary m-5 p-5 b-r-5">
    <form wire:submit.prevent="store">
        @csrf
        <div class="row gx-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witness2_phone">Bank Name<span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('bank_name') is-invalid @enderror"
                        id="witness2_phone" placeholder="Ban
                        k name" type="text" wire:model="bank_name" />
                    @error('bank_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="witnessphone">Bank Account<span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('account_number') is-invalid @enderror"
                        id="witnessphone" placeholder="Bank name" type="text" wire:model="account_number" />
                    @error('account_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="phone">Balance<span class="text-danger">*</span></label>
                    <input class="form-control input-air-secondary digit @error('initial_balance') is-invalid @enderror"
                        id="phone" placeholder="Bank name" type="number" wire:model="initial_balance" />
                    @error('initial_balance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-lg btn-outline-secondary w-100" >Click to Create bank </button>
        </div>
    </form>
</div>
