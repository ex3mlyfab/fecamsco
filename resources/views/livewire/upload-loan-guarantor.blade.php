
    @slot('title')
        upload Guarantors Form
    @endslot
    <div class="card shadow border-2 b-primary m-10">
        {{-- Be like water. --}}
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            @csrf
            <div class="form-group row p-20">
                <label class="col-sm-3 col-form-label text-end">Select Guarantors Forms</label>
                <div class="col-xl-5 col-sm-9">
                    <input class="form-control @error('guarantor_form') is-invalid @enderror" type="file"
                        wire:model="guarantor_form" />
                    @error('guarantor_form')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button class="btn btn-outline-secondary w-100">Upload FIle</button>

        </form>
    </div>


