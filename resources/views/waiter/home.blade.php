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
               <h3 class="text-center"> You are on <span class="text-success">{{ $name[0]->rest_name }} </span> Restaurant </h3>
            </div>
            @foreach ($categories as $category)
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading text-bold text-center">{{ $category->cat_name }} </div>

                <div class="panel-body">
                    

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
                                <tr>
                                    <th scope="row">{{ $item->item_name}}</th>
                                    <td>{{ $item->price }}</td>
                                    <td><a href="#" class="btn btn-info" >Place Order</a></td>
                                    
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
