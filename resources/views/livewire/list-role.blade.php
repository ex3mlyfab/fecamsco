<div class="card shadow mt-10">
    <div class="card-header bg-primary text-light text-center">
        <h5>Role List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <th>Name</th>
                    <th>Permission</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                       <tr>
                        <td>{{$item->name}}</td>
                        <td>
                            <ul>
                                @forelse ($item->permissions as $item2)
                                    <li>{{$item2->name}}</li>
                                @empty
                                    <p>no permission for this role</p>
                                @endforelse
                            </ul>
                        </td>
                        <td>
                            <a href="{{route('role.edit', $item->id)}}">edit</a>
                            <a href="{{route('role.edit', $item->id)}}">Delete</a>
                            
                        </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
            {{$roles->links()}}
        </div>
    </div>
</div>
