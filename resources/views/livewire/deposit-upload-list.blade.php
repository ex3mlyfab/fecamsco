<div class="card shadow b-2 b-primary m-t-5">
    <div class="table-responsive">
        <input type="text" class="form-control" placeholder="Search ...." style="width: 250px;" wire:model="searchTerm">
        <table class="table table-striped" id="user-array">
            <thead class="bg-primary">
                <tr>
                    <th>#</th>
                    <th class="sort" wire:click="sortOrder('deduction_period')">Deduction period
                        {!! $sortLink !!}</th>
                    <th>Amount</th>
                    <th>Uploaded</th>
                    <th>Approved By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($deposits as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->deduction_period }}</td>
                        <td>{!! showAmount($item->total_saving) !!}</td>
                        <td>{{ $item->uploaded_by }}</td>
                        <td>{{ $item->approved_by }}</td>
                        <td>
                            <a href="{{ route('deposit.show', $item->id) }}" data-container="body"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Show Member"><i
                                    data-feather="eye"></i></a>
                            <a href="#"><i data-feather="edit"></i></a>
                            <a href="#"><i data-feather="delete"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No record found</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="d-flex mt-5">
            {{ $deposits->links() }}
        </div>
    </div>
</div>
