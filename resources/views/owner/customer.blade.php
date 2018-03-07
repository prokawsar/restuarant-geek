@section('title', 'Customers')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading text-center" >Customers</div>

                @php $i = 1; $customer = App\Customer::where('rest_id', Auth::id())->paginate(15); @endphp

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($customer as $person)
                   
                    @php $totalSpent = App\FoodOrder::where('cust_id', $person->id)->where('bill_paid', 1)->sum('total_bill');
                        
                    @endphp
                        <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->phone }} </td>
                        <td>{{ $person->email }} </td>
                        <td>{{ $totalSpent }} </td>
                        </tr>
                    @php $i++; @endphp
                    @endforeach
                       
                    </tbody>

            </table>
                {{ $customer->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
