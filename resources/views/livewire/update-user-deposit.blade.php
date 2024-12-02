<div>
   <form wire:submit.prevent="store">
        @csrf
        <div class="card box-shadow-title row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="effective_date">Amount <span class="text-danger">*</span>
                        .</label>
                     <div class="input-group">
                        <span class="input-group-text"><i class="icon-wallet"></i></span>
                        <input class="form-control" wire:model="deposit"
                            required type="number" id="password" />

                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-lg btn-outline-info w-100">Submit</button>
    </form>
</div>
