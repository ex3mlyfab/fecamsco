<div class="row gx-2">
    <div class="col-md-6">
        <div class="form-group">
            <label class="witness2_phone">Input Member IPPIS no<span class="text-danger">*</span></label>
            <input class="form-control input-air-secondary digit"
                id="witness2_phone" placeholder="Member Ippis" type="text" wire:model.debounce="member_ippis"wire:change="search"/>
        </div>
    </div>
    <div class="col-md-6">
        <livewire:user-select-result :result="$result" :member_id="$member_id" >
    </div>
</div>
