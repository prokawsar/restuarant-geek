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

                <div class="panel panel-default">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Table Name/No</th>
                            <th scope="col">Items</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Order On</th>
                        </tr>
                        </thead>
                        <tbody id="datas">



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.16/moment-timezone-with-data.js"></script>


<script>

    var token = '{{csrf_token()}}';
    function loadOrderData() {
        $.ajax({
            type: 'get',
            url: '{{route('allorders')}}',
            success: function (data) {
                console.log(data);
                var rows = '', x = 1;
                data.map(function (index) {
//                        console.log(index.item[0].item_name);
                    var status = '';
                    var statusClass='';
                    if(index.status){ statusClass="success"; }
                    else{ statusClass= "danger"; }

                    rows += '<tr class="'+ statusClass +'"><td>' + x++ + '</td>' +
                        '<td class="col-md-2">' + index.table.name_or_no + '</td><td><table class="table table-hover">';

                    for (var y = 0; y < index.item.length; y++) {
                        if(index.item[y].pivot.order_status){
                            status = 'disabled';
                            statusClass="success";
                        }
                        else{
                            status = '';
                            statusClass= "danger";
                        }
                        if(index.status){
                            status = 'disabled';
                        }
                        rows +='<tr class="'+statusClass +'"><td class="custom-row ">' + index.item[y].item_name + ' ('+ index.item[y].pivot.item_quantity +')' +
                            ' <button type="button" class="btn btn-info pull-right" onclick="itemDone('+index.item[y].pivot.id +','+ index.id +')"'+ status +' data-id="' + index.item[y].pivot.id + '">Done </button></td></tr>';
                    }
                    status = '';
                    statusClass = '';
                    var compTime = ''; // in future will add complete time
                    if (index.status) {
                        status = 'Completed';
                        statusClass = 'disabled';
                    } else {
                        status = 'Pending';

                    }

                        rows += '</table></td><td>' + status + '</td>' +
                        '<td><button type="button" class="btn btn-info "'+ statusClass +' onclick="orderDone(' + index.id + ')">Order Done </button></td>' +
                        '<td>'+ moment(index.created_at).add('6', 'hours').fromNow() +'</td></tr>';
                })
                $('#datas').html(rows);
            }
        })
    }
    function timeOut() {
        setTimeout(function () {
            loadOrderData();
            timeOut();
        }, 5000);
    }

    $(document).ready(function () {
        timeOut();
        loadOrderData();

    });

$(document).on('click', '.geturlbutton', function () {
//            alert($('.geturlbutton').data('id'));
        var id = $('.geturlbutton').data('id');
            url = '/kitchen/orderdone' + id;
        window.location.href = url;
    });

    function itemDone(id, orderID) {
//            alert($('.geturlbutton').data('id'));
        // var id = $('.itemDoneButton').data('id');
        url = '/kitchen/itemdone' + id +'/'+ orderID;
        window.location.href = url;
    }

    function orderDone(id) {
//            alert($('.geturlbutton').data('id'));
        // var id = $('.itemDoneButton').data('id');
        url = '/kitchen/orderdone' + id;
        window.location.href = url;
    }
</script>

