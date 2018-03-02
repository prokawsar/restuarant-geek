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

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::guard('kitchen')->user()->rest_id)->orderBy('status')->get(); @endphp
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
                        <tbody>

                        @foreach ($foodOrder as $order)
                            @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp
                            {{--@php dd($table) @endphp--}}
                            @php $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp

                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $table[0]->name_or_no }}</td>
                                <td>
                                    @foreach($items as $item_id)
                                        @php $item = App\Item::select('item_name')->where('id', $item_id->item_id)->get(); @endphp

                                        {{ $item[0]->item_name }} <br>
                                    @endforeach
                                </td>
                                <td>{{ $order->status  }}</td>
                                <td>
                                    <button type="button" onclick="window.location='{{ route("orderdone", ["id" => $order->id ] )  }}'"
                                       class="btn btn-info" @php if($order->status) echo 'disabled' @endphp >Done</button>
                                </td>

                            </tr>
                            @php $i++; @endphp
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
