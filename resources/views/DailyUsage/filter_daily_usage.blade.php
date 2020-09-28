<div>
    @foreach($daily_usage as $ds)
        <div class="card bg-secondary text-white">
            <div class="card-body"><span class="float-left bg-success" style="padding-left:4px">{{$ds->date}}</span><span class="float-left" style="padding-left:40px;">{{$ds->title}}</span>
                @if($ds->status=="in")
                    <span class="float-right " style="color:greenyellow">{{$ds->status}}</span>
                @else
                    <span class="float-right " style="color:red">{{$ds->status}}</span>
                @endif
                <span style="padding-right: 40px" class="float-right">{{$ds->amount}}MMK</span> </div>
        </div>
        <br>
    @endforeach
    <p class="ml-5"> {{$daily_usage->links()}}</p>
</div>
