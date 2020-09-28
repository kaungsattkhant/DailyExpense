<div class="table-responsive" >
    <table class="table">
        <thead>
        <!--                        <tr ><p style="background-color: gray">Cart</p></tr>-->
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                <td>
                    {{$p->name}}
                </td>
                <td>
                    {{$p->pivot->qty}}
{{--                                <span class="badge"> {{$t->qty}}--}}
{{--                                </span>--}}
                </td>
                <th>{{$p->price}}</th>
                <td>{{$p->price*$p->pivot->qty}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
