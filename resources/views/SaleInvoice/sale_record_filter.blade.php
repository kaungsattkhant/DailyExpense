<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Invoice NO</th>
            <th>Total</th>
            <th>Front Man</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale_invoices as $s)
            <tr>
                <td></td>
                <td>{{$s->invoice_no}}</td>
                <td>{{$s->total_kyats}}</td>
                <td>{{$s->user->name}}</td>
                <td>
                    <button class="btn btn-default btn-sm cs-btn" onclick="detail({{$s->id}})">Detail</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$sale_invoices->links()}}
</div>
