<div class="b-2 b-primary p-4">

    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-sm-3 col-form-label text-end">Upload File</label>
            <div class="col-xl-5 col-sm-9">
                <input class="form-control @error('uploaded_file') is-invalid @enderror" type="file"
                    wire:model="uploaded_file" />
                @error('uploaded_file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label text-end">Deduction Month</label>
            <div class="col-xl-5 col-sm-9">
                <input class="form-control digits  @error('deduction_period') is-invalid @enderror" type="month" wire:model="deduction_period" />
                @error('deduction_period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <button class="btn btn-outline-secondary w-100">Upload FIle</button>

    </form>
    @if ($importing && !$importFinished)
        <div wire:poll="updateImportProgress">Importing...please wait.</div>
    @endif

    @if ($importFinished)
        Finished importing.
    @endif
</div>
