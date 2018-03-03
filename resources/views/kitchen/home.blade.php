@section('title', 'Kitchen')

@extends('layouts.kitchen')

@section('content')
    <div class="container">
        @php $name = App\User::select('rest_name')->where('id', Auth::guard('kitchen')->user()->rest_id)->get(); @endphp

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <h3 class="text-center"> You are on <span class="text-success">{{ $name[0]->rest_name }}'s </span>
                Kitchen </h3>
            <h3 class="text-center">Today's Orders</h3>

        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::guard('kitchen')->user()->rest_id)->whereDate('order_date',DB::raw('CURDATE()'))->orderBy('status')->get(); @endphp
                {{--@php dd($foodOrder) @endphp--}}
                <div class="panel panel-default">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Table Name/No</th>
                            <th scope="col">Items</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="datas">

                        {{--@foreach ($foodOrder as $order)--}}
                            {{--@php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp--}}
                            {{--@php dd($table) @endphp--}}
                            {{--@php $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp--}}

                            {{--<tr>--}}
                                {{--<th scope="row">{{ $i }}</th>--}}
                                {{--<td>{{ $table[0]->name_or_no }}</td>--}}
                                {{--<td>--}}
                                    {{--@foreach($items as $item_id)--}}
                                        {{--@php $item = App\Item::select('item_name')->where('id', $item_id->item_id)->get(); @endphp--}}

                                        {{--{{ $item[0]->item_name }} <br>--}}
                                    {{--@endforeach--}}
                                {{--</td>--}}
                                {{--<td>{{ $order->status  }}</td>--}}
                                {{--<td>--}}
                                    {{--<button type="button" onclick="window.location='{{ route("orderdone", ["id" => $order->id ] )  }}'"--}}
                                       {{--class="btn btn-info" @php if($order->status) echo 'disabled' @endphp >Done</button>--}}
                                {{--</td>--}}

                            {{--</tr>--}}
                            {{--@php $i++; @endphp--}}
                        {{--@endforeach--}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>

    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>--}}
    <script>

        var token='{{csrf_token()}}';
        function loadOrderData() {
            $.ajax({
                type:'get',
                url:'{{route('allorders')}}',
                success:function (data) {
                    console.log(data);
                    var rows='',x=1;
                    data.map(function (index) {
//                        console.log("hello");
                        rows+='<tr><td>'+x+++'</td>' +
                            '<td>'+index.table_id+'</td>' +
                            '<td></td>' +
                            '<td>'+index.status+'</td>' +
                            '<td><button type="button" class="btn btn-info" >Done </button></td>' +
                        '</tr>';
                    })
                    $('#datas').html(rows);
//                    for(var x=0;x<data.length;x++)
//                    {
//                        $('#datas').append('<tr><td>'+x+'</td>' +
//                            '<td>'+data[x].table_id+'</td>' +
//                            '<td></td>' +
//                            '<td>'+data[x].status+'</td>' +
////                            '<td><button type="button" class="btn btn-info" >Done </button></td>' +
//                        '</tr>');

//                }
        }
        })
        }
        function timeOut(){
            setTimeout(function(){
                loadOrderData();
                timeOut();
            },5000);
        }

$(document).ready(function () {
//            alert("ok");
    timeOut();

    loadOrderData();

})
</script>

