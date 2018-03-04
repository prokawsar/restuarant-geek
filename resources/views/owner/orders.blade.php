@section('title', 'Kitchen View')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::id())->whereDate('order_date',DB::raw('CURDATE()'))->get(); @endphp
                {{--@php dd($foodOrder) @endphp--}}


                <div class="panel panel-success">
                    <div class="panel-heading  text-bold text-center" data-toggle="collapse" data-target="#today">
                        Today's orders <span class="badge">@php echo count($foodOrder); @endphp </span>
                    </div>

                    <div class="panel-body collapse" id="today">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Table Name/No</th>
                                <th scope="col">Items</th>
                                <th scope="col">Bill</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($foodOrder as $order)
                                @php $cust = App\Customer::select('name')->where('id', $order->cust_id )->get(); @endphp

                                @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp
                                {{--@php dd($table) @endphp--}}
                                @php $bill=0; $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp

                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <th scope="row">{{ $cust[0]->name }}</th>
                                    <td>{{ $table[0]->name_or_no }}</td>
                                    <td>
                                        @foreach($items as $item_id)
                                            @php $item = App\Item::select('item_name', 'price')->where('id', $item_id->item_id)->get();
                                        $bill += $item[0]->price;

                                            @endphp

                                            {{ $item[0]->item_name }} <br>

                                        @endforeach
                                    </td>
                                    <td>{{ $bill }}</td>
                                    <td><button class="btn btn-success" onclick="PrintElem(['name'=> '{{$cust[0]->name}}' ])">Receive Bill</button> </td>

                                </tr>
                                @php $i++; @endphp
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::id())->get(); @endphp
                {{--@php dd($foodOrder) @endphp--}}


                <div class="panel panel-default">
                    <div class="panel-heading  text-bold text-center" data-toggle="collapse" data-target="#yesterday">
                        Yesterday orders <span class="badge">@php echo count($foodOrder); @endphp </span>
                    </div>

                    <div class="panel-body collapse" id="yesterday">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Table Name/No</th>
                                <th scope="col">Items</th>
                                <th scope="col">Bill</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($foodOrder as $order)
                                @php $cust = App\Customer::select('name')->where('id', $order->cust_id )->get(); @endphp

                                @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp
                                {{--@php dd($table) @endphp--}}
                                @php $bill=0; $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp

                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <th scope="row">{{ $cust[0]->name }}</th>
                                    <td>{{ $table[0]->name_or_no }}</td>
                                    <td>
                                        @foreach($items as $item_id)
                                            @php $item = App\Item::select('item_name', 'price')->where('id', $item_id->item_id)->get();
                                        $bill += $item[0]->price;

                                            @endphp

                                            {{ $item[0]->item_name }} <br>

                                        @endforeach
                                    </td>
                                    <td>{{ $bill }}</td>

                                </tr>
                                @php $i++; @endphp
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::id())->get(); @endphp
                {{--@php dd($foodOrder) @endphp--}}


                <div class="panel panel-info">
                    <div class="panel-heading  text-bold text-center"  data-target="#month">
                        <p>View Orders</p>
                        Start Date:
                        <input id="datepicker" type="text" name="start"/>
                        End Date:
                        <input id="datepicker2" type="text" name="end" />
                        <button class="btn btn-success">OK</button>
                    </div>

                    <div class="panel-body collapse" id="month">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Table Name/No</th>
                                <th scope="col">Items</th>
                                <th scope="col">Bill</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($foodOrder as $order)
                                @php $cust = App\Customer::select('name')->where('id', $order->cust_id )->get(); @endphp

                                @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp
                                {{--@php dd($table) @endphp--}}
                                @php $bill=0; $items = App\FoodOrderItem::select('item_id')->where('order_id', $order->id)->get(); @endphp

                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <th scope="row">{{ $cust[0]->name }}</th>
                                    <td>{{ $table[0]->name_or_no }}</td>
                                    <td>
                                        @foreach($items as $item_id)
                                            @php $item = App\Item::select('item_name', 'price')->where('id', $item_id->item_id)->get();
                                        $bill += $item[0]->price;

                                            @endphp

                                            {{ $item[0]->item_name }} <br>

                                        @endforeach
                                    </td>
                                    <td>{{ $bill }}</td>

                                </tr>
                                @php $i++; @endphp
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

    function PrintElem(DataArray)
    {
        alert(DataArray);

        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h3>' + document.title  + '</h3>');
        mywindow.document.write('Name: <h5>' + document.title + '</h5>');
//        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>


