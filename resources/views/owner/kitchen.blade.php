@section('title', 'Kitchen View')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::id())->whereDate('order_date',DB::raw('CURDATE()'))->get(); @endphp
                {{--@php dd($foodOrder) @endphp--}}


                <div class="panel panel-primary">
                    <div class="panel panel-heading text-center">
                        Today's Kitchen
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Table Name/No</th>
                            <th scope="col">Items</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($foodOrder as $order)
                            @php $cust = App\Customer::select('name')->where('id', $order->cust_id )->get(); @endphp

                            @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp
                            {{--@php dd($table) @endphp--}}
                            @php $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp

                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <th scope="row">{{ $cust[0]->name }}</th>
                                <td>{{ $table[0]->name_or_no }}</td>
                                <td>
                                    @foreach($items as $item_id)
                                        @php $item = App\Item::select('item_name')->where('id', $item_id->item_id)->get(); @endphp

                                        {{ $item[0]->item_name }} <br>
                                    @endforeach
                                </td>
                                <td>{{ $order->status  }}</td>
                                <td>
                                    <button class="btn btn-info" @php if(Auth() ) echo "disabled"; @endphp >Done</button>
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
