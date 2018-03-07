@section('title', 'Placed Order')

@extends('layouts.waiter')

@section('content')
    <div class="container">
        @php $name = App\User::select('rest_name')->where('id', Auth::guard('waiter')->user()->rest_id)->get(); @endphp

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <h3 class="text-center"> You are on <span class="text-success">{{ $name[0]->rest_name }}'s </span>
                Restaurant </h3>
            <h3 class="text-center">Today's Orders</h3>

        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::guard('waiter')->user()->rest_id)->whereDate('order_date',DB::raw('CURDATE()'))->orderBy('status')->paginate(10); @endphp
                {{--@php dd($foodOrder) @endphp--}}
                <div class="panel panel-default">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Table Name/No</th>
                            <th scope="col">Items</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Billing Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($foodOrder as $order)
                            @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp

                            @php $status=''; $billStatus='';
                            $items = App\FoodOrderItem::select('item_id', 'item_quantity', 'order_status')->where('order_id', $order->id)->get();

                              if($order->status){
                                    $status = 'Completed';
                                }else{
                                    $status = 'Pending';
                                }
                            if($order->bill_paid){
                                    $billStatus = 'Paid';
                                }else{
                                    $billStatus = 'Not Paid';
                                }
                            @endphp

                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $table[0]->name_or_no }}</td>
                                <td>
                                    @foreach($items as $item_id)
                                        @php $item = App\Item::select('item_name')->where('id', $item_id->item_id)->get(); @endphp

                                        {{ $item[0]->item_name }}
                                        ( {{ $item_id->item_quantity }} )
                                        @php if($item_id->order_status ){
                                            echo '<span class="glyphicon glyphicon-ok"></span>';
                                        }else{
                                            echo '<span class="glyphicon glyphicon-remove"></span>';

                                        } @endphp
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{ $status  }}</td>
                                <td>{{ $billStatus }}</td>

                                <td>
                                    <button type="button"
                                       class="btn btn-info" onclick="window.location='{{ route('moreitem', ['id' => $order->id ]) }}'" @php if( $order->bill_paid ) echo 'disabled'; @endphp >Add More Item</button>
                                </td>

                            </tr>
                            @php $i++; @endphp
                        @endforeach

                        </tbody>
                        {{ $foodOrder->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
