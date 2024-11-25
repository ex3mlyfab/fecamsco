<div class="card b-2 b-secondary m-5 p-5 b-r-5">
    <form wire:submit.prevent="store">
        @csrf
        <div class="row gx-2">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>{{$role_name}}</h5>
                   
                </div>
            </div>
            <div class="col-md-12 border-2 b-primary b-r-5 m-2 p-2 middle">
                <div class="form-group ">

                    <label class="witness2_phone">Assign Permissions<span class="text-danger">*</span></label>
                    <div class="row gx-2 gy-2">
                        @forelse ($stored_permissions as $item)
                            <label class="col-sm-6 col-md-3" for="chk-ani.{{ $item->id }}" wire:key="{{$item->id}}">
                                <input class="checkbox_animated" id="chk-ani.{{ $item->id }}" type="checkbox"
                                   wire:model="permissions" wire:key="{{$item->id}}" value="{{$item->id}}"> {{ $item->name }}
                            </label>
                        @empty
                            <div class="col-md-12">
                                <h3>Create Permissions </h3>
                                <a href=""{{route('permission.create')}} class="btn btn-sm"> Here</a>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

            <button class="btn btn-lg btn-outline-secondary w-100" @if (!isset($permissions))
            disabled
            @endif>Click to Update Role </button>
    </form>
</div>
