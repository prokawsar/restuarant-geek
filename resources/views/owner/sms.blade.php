@section('title', 'SMS Campaign')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="form-group" >
                    <label class="control-label" for="title">Message:<span class="required">*</span></label>

                    <textarea  class="form-control" type="text"></textarea>
                    <br/>
                    <button class="btn btn-success pull-right" >Send Message</button>

                </div>
                <br/>  <br/>
                <div class="panel panel-default">

                    @php $i = 1; $customer = App\Customer::where('rest_id', Auth::id())->get(); @endphp

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Total Spent</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customer as $person)
                            <tr>
                                <th scope="row">{{ $i }} <input type="checkbox" name="select"/> </th>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->phone }} </td>
                                <td>100 </td>
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
