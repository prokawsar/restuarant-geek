@section('title', 'Take Review')

@extends('layouts.waiter')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::guard('kitchen')->user()->rest_id)->get(); @endphp

                <div class="panel-heading text-center">Today's Order</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Items</th>
                            <th scope="col">Total Bill</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($foodOrder as $order)
                            @php $cust = App\Customer::select('name')->where('id', $order->cust_id )->get(); @endphp

                             {{--@php dd($table) @endphp--}}
                            @php $price = 0; $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp

                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <th scope="row">{{ $cust[0]->name }}</th>
                                <td>
                                    @foreach($items as $item_id)
                                        @php $item = App\Item::select('item_name', 'price')->where('id', $item_id->item_id)->get();
                                        $price += $item[0]->price;
                                        @endphp

                                        {{ $item[0]->item_name }} <br>
                                    @endforeach
                                </td>
                                <th scope="row">  {{ $price }} </th>
                                <td>
                                    <button class="btn btn-info"  data-toggle="collapse" data-target="#demo{{ $order->id  }}">Take Review</button>
                                </td>

                            </tr>
                            <div class="form-group collapse" id="demo{{ $order->id  }}">

                                <label class="control-label" for="title">Customer Review:<span class="required">*</span></label>

                                <textarea  class="form-control" type="text"></textarea>

                                <label class="control-label" for="title">Customer Phone:<span class="required">*</span></label>

                                <input  class="form-control" type="text" />

                            </div>

                            @php $i++; @endphp
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> {{-- Today's row--}}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::guard('kitchen')->user()->rest_id)->get(); @endphp

                <div class="panel-heading text-center">Previous Order</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
