@section('title', 'Kitchen')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Table No</th>
                        <th scope="col">Items</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto <br>
                            Hello <br>
                            Hello
                            </td>
                        <td>Pending
                            <button class="btn btn-info" >Done</button>
                            </td>
                        </tr>
                       
                    </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
