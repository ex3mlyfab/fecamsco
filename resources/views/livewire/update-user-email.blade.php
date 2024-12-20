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
                     <div class="input-group">
                        <span class="input-group-text"><i class="icon-lock"></i></span>
                        <input class="form-control" wire:model="password"
                            required type="password" id="password" />

                    </div>
                    <input class="mt-2 ms-3" type="checkbox" onclick="myFunction()" id="checkbox1" /><label for="checkbox1"> Show Password</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-lg btn-outline-info w-100">Submit</button>
    </form>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
