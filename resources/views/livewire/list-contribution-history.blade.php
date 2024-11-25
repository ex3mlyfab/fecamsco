<div class="card n-t-10">
    <div class="card-head bg-primary text-light">
        <h5 class="text-center">Deduction History</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Amount </th>
                    <th>Effective From</th>
                    <th>Status</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($deductions as $item)
                    <tr>
                        <td> {!! showAmount($item->deduction_amount)!!}</td>
                        <td> {{date('d/m/Y', strtotime($item->effective_from))}}</td>
                        <td>@if ($loop->first)
                            <span class="badge badge-primary">Active</span>
                            @else
                            <span class="badge badge-info">Not active</span>
                        @endif  </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$deductions->links()}}
        </div>
    </div>
</div>

