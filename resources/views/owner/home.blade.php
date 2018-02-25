@section('title', 'Dashboard')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="col-md-6 col-md-offset-3" >
                        <div class="jumbotron">
                            <p class="lead">Your current waiter unique code: {{ $data[0]->wCode }}</p>
                            <p class="lead">Your current waiter password: {{ $data[0]->password }}</p>
                            <a class="btn btn-primary" href="{{ route('ucode') }}"> Add new one </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>150</h3>

                                <p>New Orders</p>
                            </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
