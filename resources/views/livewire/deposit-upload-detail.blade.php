<div class="table-responsive">
    <input type="text" class="form-control" placeholder="Search ...." style="width: 250px;" wire:model="searchTerm">
    <table class="table table-striped" id="user-array">
        <thead class="bg-primary">
            <tr>
                <th>#</th>
                <th class="sort" wire:click="sortOrder('employee_name')">Employee Name
                    {!! $sortLink !!}</th>
                <th class="sort">Employee Number
                </th>
                <th>Deduction Amount</th>
                <th>Member Account Updated</th>

            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse ($deposits as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->employee_number }}</td>
                    <td>{!!showAmount($item->deduction_amount) !!}</td>
                    <td class="text-center">
                        @if ($item->saving_linked)
                            <span class="badge rounded-pill badge-primary">Yes</span>
                        @else
                            <span class="badge rounded-pill badge-danger">No</span>
                        @endif
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
