@section('title', 'All Order Data')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                    </div>
                @endif

                @php $i = 1; $foodOrder = App\FoodOrder::where('rest_id', Auth::id())->whereDate('order_date',DB::raw('CURDATE()'))->get(); @endphp
                {{--@php dd($foodOrder) @endphp--}}


                <div class="panel panel-success">
                    <div class="panel-heading  text-bold" data-toggle="collapse" data-target="#today">
                        Today's orders <span class="badge">@php echo count($foodOrder); @endphp  </span><span
                                class="badge label-danger pull-right"> MUST RELOAD THIS PAGE BEFORE PRINT BILL</span>
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
                                <th scope="col">Order Status</th>
                                <th scope="col">Discount Amount</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($foodOrder as $order)
                                @php $cust = App\Customer::select('name', 'id')->where('id', $order->cust_id )->get(); @endphp

                                @php $table = App\Table::select('name_or_no')->where('id', $order->table_id )->get(); @endphp
                                {{--@php dd($table) @endphp--}}
                                @php $status=''; $bill=0;
                                $items = App\FoodOrderItem::select('item_id', 'item_quantity', 'item_price')->where('order_id', $order->id)->where('order_status', 1)->get();


                                if($order->status){
                                    $status = 'Completed';
                                }else{
                                    $status = 'Pending';
                                }
                                @endphp

                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <th scope="row">{{ $cust[0]->name }}</th>
                                    <td>{{ $table[0]->name_or_no }}</td>
                                    <td>
                                        @foreach($items as $item_id)
                                            @php $item = App\Item::select('item_name', 'price')->where('id', $item_id->item_id)->get();
                                                $bill += $item_id->item_price * $item_id->item_quantity;

                                            @endphp

                                            {{ $item[0]->item_name }}
                                            ( {{ $item_id->item_quantity }} )<br>

                                            <script>
                                                var items<?php echo $order->id; ?> = [];
                                                items<?php echo $order->id; ?>.push(<?php echo $item[0]->item_name; ?>);
                                            </script>

                                        @endforeach
                                    </td>
                                    @php
                                        App\FoodOrder::where('id', $order->id)->update(array('total_bill' => $bill));
                                    @endphp
                                    <td>{{ $bill }}</td>
                                    <td>{{ $status }}</td>
                                    <script>
                                        var dataObject<?php echo $order->id; ?> = {};
                                        dataObject<?php echo $order->id; ?>['name'] = '<?php echo $cust[0]->name; ?>';
                                        dataObject<?php echo $order->id; ?>['bill'] = '<?php echo $order->total_bill; ?>';
                                        dataObject<?php echo $order->id; ?>['items'] = items<?php echo $order->id; ?>;


                                    </script>
                                    @php
                                        $discount = App\Review::where('cust_id', $cust[0]->id)->groupBy('cust_id')->sum('discount_amount');

                                    @endphp
                                    <td>
                                        {{ $discount }}
                                    </td>
                                    <td>
                                        <button class="btn btn-info"
                                                @php if( $order->bill_paid || !$order->status ) {echo 'disabled';} @endphp onclick="PrintElem(dataObject<?php echo $order->id; ?>)">
                                            Print Bill
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success"
                                                @php if( $order->bill_paid || !$order->status ) {echo 'disabled';} @endphp onclick="location.href='/billpaid{{  $order->id }}'">
                                            Bill Paid
                                        </button>
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
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @php $i = 1;
                $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
                $foodOrder = App\FoodOrder::where('rest_id', Auth::id())->whereDate('order_date', $yesterday )->get();

                @endphp


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

                                @php $bill=0; $items = App\FoodOrderItem::select('item_id', 'item_quantity', 'item_price')->where('order_id', $order->id)->where('order_status', 1)->get(); @endphp

                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <th scope="row">{{ $cust[0]->name }}</th>
                                    <td>{{ $table[0]->name_or_no }}</td>
                                    <td>
                                        @foreach($items as $item_id)
                                            @php $item = App\Item::select('item_name', 'price')->where('id', $item_id->item_id)->get();
                                            $bill += $item_id->item_price;

                                            @endphp

                                            {{ $item[0]->item_name }}
                                            ( {{ $item_id->item_quantity }} ) <br>

                                        @endforeach
                                    </td>
                                    <td>{{ $order->total_bill }}</td>

                                </tr>
                                @php $i++; @endphp
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--View by Date--}}

        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-info">
                    <div class="panel-heading  text-bold text-center" data-target="#month">
                        <p>View Orders</p>
                        Start Date:
                        <input id="datepicker" type="text" name="start"/>
                        End Date:
                        <input id="datepicker2" type="text" name="end"/>
                        <button class="btn btn-success ok">OK</button>
                    </div>

                    <div class="panel-body" id="month">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Items</th>
                                <th scope="col">Bill</th>
                            </tr>
                            </thead>
                            <tbody id="orders">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>

<script>

    var _token = '{{csrf_token()}}';

    $(document).on('click', '.ok', function () {
        var start = $('#datepicker').val();
        var end = $('#datepicker2').val();

        if (end < start) {
            alert("Start Date must be earlier !");
            return;
        }
//        alert(start);
//        alert(end);
//        return;

        $.ajax({
            type: 'post',
            url: '{{ route('orderdata') }}',
            data: {
                _token: _token,
                start: start,
                end: end
            },
            success: function (response) {
                console.log(response);
                var rows = '', x = 1;
                response.map(function (index) {

                    rows += '<tr class=""><td>' + x++ + '</td>' +
                        '<td>' + index.customer.name + '</td>' +
                        '<td>' + index.order_date + '</td><td>';
                    var icon;

                    for (var y = 0; y < index.item.length; y++) {

                        if (index.item[y].pivot.order_status) {
                            icon = 'glyphicon-ok';
                        } else {
                            icon = 'glyphicon-remove';
                        }
                        rows += index.item[y].item_name + ' (' + index.item[y].pivot.item_quantity + ')<span class="glyphicon ' + icon + '"></span><br>';
                    }

                    rows += '</td><td>' + index.total_bill + '</td></tr>';
                });
                $('#orders').html(rows);
            },
            error: function (er) {
                console.log(er);
            }
        })
    });


    function PrintElem(DataArray) {
//        alert(DataArray);

        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h3>' + document.title + '</h3>');
        mywindow.document.write('<h4>Name: ' + DataArray['name'] + '</h4>');
        mywindow.document.write('<h4>Bill: ' + DataArray['bill'] + '</h4>');
        mywindow.document.write('<h4>Items: ' + +'</h4>');

        console.log(DataArray['items']);

        for (var i = 0; i < DataArray['items'].length; i++) {
            // mywindow.document.write('<span>' + DataArray['items'][i] + '</span><br>');

        }

//        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>


