<div class="card n-t-10">
    <div class="card-head bg-primary text-light">
        <h5 class="text-center">Product Categories</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Name</th>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                    <tr>
                        <td> {{$item->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$categories->links()}}
        </div>
    </div>
</div>
