@section('title', 'Profile')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Example
                <a class="btn btn-warning pull-right" href="#"> Edit Info</a>
                </div>

                <div class="panel-body">
                    <p class="lead">Owner Name: <span class="text-bold text-center"> name</span></p>
                    <p class="lead">Image: <span class="text-bold text-center"> name</span></p>
                    <p class="lead">Address: <span class="text-bold text-center"> name</span></p>
                    <p class="lead">Contact: <span class="text-bold text-center"> name</span></p>
                    <p class="lead">Closing Day: <span class="text-bold text-center"> name</span></p>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
