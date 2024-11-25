<div class="card shadow m-5 border-2 b-primary">
   <div class="card-header bg-primary text-light text-center">
    <h5>Update Contribution Amount</h5>
   </div>
   <div class="card-body">
    <form wire:submit.prevent="store">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="deduction_amount">Amount to be deducted<span
                            class="text-danger">*</span>.</label>
                    <div class="input-group">
                        <span class="input-group-text input-air-secondary">₦</span>
                        <input class="form-control input-air-secondary digit"
                            id="deduction_amount" type="number" placeholder="Deduction Amount"
                            wire:model="deduction_amount"
                            min="5000"
                             />
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="effective_date">Effective Date<span class="text-danger">*</span>
                        .</label>
                    <input class="form-control input-air-secondary digit"
                         type="date" placeholder="with effect from"
                        wire:model="effective_from" data-language="en"
                        />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-lg btn-outline-info w-100">Submit</button>
    </form>
   </div>
</div>

