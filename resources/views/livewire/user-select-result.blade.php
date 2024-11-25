<div class="form-group">
    <label class="witness2_phone">Member Details<span class="text-danger">*</span></label>
    @if ($result)
            {{$result}}
        <input type="hidden" value="{{$member_id}}"  name="user_id"/>
    @else
    <h5>Member not found</h5>
    @endif

</div>
