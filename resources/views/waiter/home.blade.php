@section('title', 'Make Order')

@extends('layouts.waiter')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif

                @php $categories = App\Category::where('rest_id', Auth::guard('waiter')->user()->rest_id)->get(); @endphp
                @php $name = App\User::select('rest_name')->where('id', Auth::guard('waiter')->user()->rest_id)->get(); @endphp

                <div class="row">
                    <h3 class="text-center"> You are on <span class="text-success">{{ $name[0]->rest_name }} </span>
                        Restaurant </h3>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <button class="btn btn-default pull-left" id="collapse-all">Expand All</button>
                    </div>
                    <br>
                    @foreach ($categories as $category)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading text-bold text-center" data-toggle="collapse"
                                         data-target="#demo{{ $category->id }}">{{ $category->cat_name }} </div>

                                    <div class="panel-body collapse coll-all" id="demo{{ $category->id }}">


                                        @php $items = App\Item::where('cat_id', $category->id)->get(); @endphp

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>

                                                <th scope="col">Item Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($items as $item)
                                                <tr class="sc-product-item">
                                                    <input type="hidden" data-name="item_name"
                                                           value="{{ $item->item_name}}"/>
                                                    <input type="hidden" data-name="item_price"
                                                           value="{{ $item->price}}"/>
                                                    <input type="hidden" data-name="item_id" value="{{ $item->id }}"/>

                                                    <th scope="row">{{ $item->item_name}}</th>
                                                    <td>{{ $item->price }}</td>
                                                    <td><a href="#" class="sc-add-to-cart btn btn-info">Add to order</a>
                                                    </td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading text-bold text-center">
                            Current Order Items
                        </div>

                        <div class="panel-body">

                            <form data-toggle="validator" action="{{ url('/placeorder')  }}" method="POST">

                                {{ csrf_field() }}
                                <input type="hidden" id="rest_id" name="rest_id"
                                       value="{{ Auth::guard('waiter')->user()->rest_id }}"/>

                                <input type="hidden" id="cust_id" name="cust_id"
                                       value=""/>

                                <div class="form-group">

                                    <label class="control-label" for="title">Select Table:<span
                                                class="required">*</span></label>
                                    @php $table = App\Table::where('rest_id', Auth::guard('waiter')->user()->rest_id)->get(); @endphp

                                    <select class="form-control" name="table_id" required>
                                        <option>Select Table</option>

                                        @foreach ($table as $name)
                                            <option value="{{ $name->id}}">{{ $name->name_or_no}}</option>
                                        @endforeach

                                    </select>
                                    <div class="help-block with-errors"></div>

                                </div>
                                <div class="form-group jumbotron" id="contact">

                                    <label class="control-label" for="title">Customer Phone:</label>

                                    <input type="number" id="phone" name="phone"
                                           class="form-control contact"
                                    />

                                    <div class="help-block with-errors"></div>
                                    <p>OR</p>

                                    <label class="control-label" for="title">Customer Email:</label>

                                    <input type="text" id="email" name="email" onblur="duplicateEmail(this)" class="form-control contact"
                                    />

                                    <div class="help-block with-errors"></div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label" for="title">Customer Name:<span
                                                class="required">*</span></label>

                                    <input type="text" id="cust_name" name="cust_name" class="form-control"
                                           data-error="Please enter name." required/>

                                    <div class="help-block with-errors"></div>

                                </div>

                                <div id="smartcart"></div>

                                <!-- <button class="btn btn-success pull-right">Send to Kitchen</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
<script>
    var _token = '{{csrf_token()}}';

    function duplicateEmail(element) {
        var email = $(element).val();
        $.ajax({
            type: "POST",
            url: '{{url('/waiter/checkemail')}}',
            data: {email: email, _token: _token},
//            dataType: "json",
            success: function (res) {
                console.log(res);
                if (res.exists) {
                    alert('This is valuable customer !');

                    $('#cust_id').val(res.customer.id);
                    $('#cust_name').hide();

                } else {
                    alert('Welcome ! This is new customer !');
                    $('#cust_name').show();
                }
            },
            error: function (exception) {
                console.log(exception);
            }
        });
    }

    $(document).ready(function () {

        $('#collapse-all').on('click', function () {
            $('.coll-all').collapse('toggle');
            if ($("#collapse-all").text() == "Expand All") {
                $("#collapse-all").text('Collapse All');
            } else {
                $("#collapse-all").text('Expand All');
            }


        });

    });

</script>
