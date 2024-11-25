<div class="card n-t-10">
    <div class="card-head bg-primary text-light">
        <h5 class="text-center">Bank Accounts</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                </thead>
                <tbody>
                    @foreach ($accounts as $item)
                    <tr>
                        <td> {{$item->bank_name}}</td>
                        <td> {{$item->account_number}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$accounts->links()}}
        </div>
    </div>
</div>
