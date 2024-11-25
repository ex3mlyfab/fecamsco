
<div class="border-2 b-primary p-6">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
<form wire:submit.prevent="store" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="deduction_amount">Upload Guarantor Form<span
                        class="text-danger">*</span>.</label>

                    <input class="form-control input-air-secondary digit"
                        id="deduction_amount" type="file" placeholder="Upload Guarantor Form"
                        wire:model="uploaded_file"
                         />
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success">Submit</button>
    </div>
</form>
</div>
