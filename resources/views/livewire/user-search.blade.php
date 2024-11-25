<div class="table-responsive">
    <input type="text"  class="form-control" placeholder="Search" wire:model="searchTerm" />

    <table class="table table-striped" id="user-array">
        <thead class=" ">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>last name</th>
                <th>membership status</th>
                <th>email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse ($users as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        {{ $item->first_name }}
                    </td>
                    <td>
                        {{ $item->last_name }}
                    </td>
                    <td>
                        @if (isset($item->member))
                            <span class="badge rounded-pill badge-primary">Registered</span>
                        @else
                            <span class="badge rounded-pill badge-danger">unRegistered</span>
                        @endif
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td>
                        <a href="{{ route('user.show', $item->id) }}" data-container="body"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Show Member"><i
                                data-feather="eye"></i></a>
                        <a href="#"><i data-feather="edit"></i></a>
                        <a href="#"><i data-feather="delete"></i></a>
                    </td>

                </tr>

            @empty
            @endforelse
        </tbody>

    </table>
    <div class="d-flex">
        {!! $users->links() !!}
    </div>
</div>
