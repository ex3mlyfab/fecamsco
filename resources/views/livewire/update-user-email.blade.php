<div>
   <form wire:submit.prevent="store">
        @csrf
        <div class="card box-shadow-title row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">New User Mail<span
                            class="text-danger">*</span>.</label>
                    <div class="input-group">
                        <span class="input-group-text input-air-secondary"><i class="fa fa-envelope"></i></span>
                        <input class="form-control input-air-secondary"
                            id="email" type="email"
                            wire:model="email"
                            min="5000"
                             />
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="effective_date">Password<span class="text-danger">*</span>
                        .</label>
                    <input class="form-control input-air-secondary"
                         type="password" placeholder="********"
                        wire:model="password"
                        />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-lg btn-outline-info w-100">Submit</button>
    </form>
</div>
