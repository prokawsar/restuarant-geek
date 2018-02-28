@section('title', 'All Item')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <a href="{{ route('additem') }}" class="btn btn-success">Add New Item</a>
            <a href="{{ route('addcate') }}" class="btn btn-success">Add New Category</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">All Item </div>

                <div class="panel-body">
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

                    @php $items = App\Item::where('rest_id', Auth::id())->get(); @endphp

                        <table class="table table-hover">
                            <thead>
                            <tr>

                                <th scope="col">Item Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <th scope="row">{{ $item->item_name}}</th>
                                <td>{{ $item->price }}</td>
                                <td><a href="{{ route('edititem', ['id' => $item->id] ) }}" class="btn btn-info" >Edit</a></td>
                                <td>
                                    <a href="{{ route('deleteitem', ['id' => $item->id] ) }}" class="btn btn-danger" >Delete</a>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                </div>
            </div>
            </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">All Item</div>

                        <div class="panel-body">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>

                                        <th scope="col">Item Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Beef</th>
                                        <td>100</td>
                                        <td><a href="" class="btn btn-info" >Edit</a></td>
                                        <td>
                                            <a href="" class="btn btn-danger" >Delete</a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
