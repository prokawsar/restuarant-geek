@section('title', 'Email Campaign')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ url('/emailcamp') }}" method="POST" id="emailSend">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label" for="subject">Subject:<span class="required">*</span></label>

                        <input class="form-control" type="text" name="subject" required/>

                        <label class="control-label" for="title">Message:<span class="required">*</span></label>

                        <textarea class="form-control" type="text" required></textarea>
                        <br/>
                        <button class="btn btn-success pull-right">Send Email</button>

                    </div>
                    <br/> <br/>
                    <div class="panel panel-default">

                        @php $i = 1; $customer = App\Customer::where('rest_id', Auth::id())->paginate(20); @endphp

                        <a class="btn btn-info" onclick="select_all('select', 0)">Clear All</a>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col"># <input type="checkbox" id="checkAll"
                                                         onclick="select_all('select', 1)"/></th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Number of Order Made</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customer as $person)

                            @php $numberOfOrder = App\FoodOrder::where('cust_id', $person->id)->groupBy('cust_id')->count();
                            
                             @endphp

                                <tr>
                                    <th scope="row">{{ $i }} <input type="checkbox" name="select[]"/></th>
                                    <td>{{ $person->name }} <input type="hidden" name="name[]"
                                                                   value="{{ $person->name }} "></td>
                                    <td>{{ $person->email }} <input type="hidden" name="email[]"
                                                                    value="{{ $person->email }}"></td>
                                    <td>{{ $numberOfOrder }}</td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach

                            </tbody>

                        </table>

                        {{ $customer->links() }}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    var formblock;
    var forminputs;

    function prepare() {
        formblock = document.getElementById('emailSend');
        forminputs = formblock.getElementsByTagName('input');
    }

    function select_all(name, value) {
        if (value == 0) {
            $('#checkAll').prop('checked', false);
        }
        for (i = 0; i < forminputs.length; i++) {
            // regex here to check name attribute
            var regex = new RegExp(name, "i");
            if (regex.test(forminputs[i].getAttribute('name'))) {
                if (value == '1') {
                    forminputs[i].checked = true;
                } else {
                    forminputs[i].checked = false;
                }
            }
        }
    }

    if (window.addEventListener) {
        window.addEventListener("load", prepare, false);
    } else if (window.attachEvent) {
        window.attachEvent("onload", prepare)
    } else if (document.getElementById) {
        window.onload = prepare;
    }
</script>
