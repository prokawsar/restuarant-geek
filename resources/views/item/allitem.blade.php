@section('title', 'All Item')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">All Item</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    Div 1
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
                                <th scope="row">Rice</th>
                                <td>10</td>
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
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">All Item</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            Div 2
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
