@props(['value'])
@if ($value)
    <span class="badge rounded-pill badge-primary">registered</span>
@else
    <span class="badge rounded-pill badge-danger">unregistered user</span>
@endif
