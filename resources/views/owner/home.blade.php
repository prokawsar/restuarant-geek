@section('title', 'Dashboard')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @php  $rest_data = App\User::where('id', Auth::id())->get();
            if( ! $rest_data[0]->address || ! $rest_data[0]->image || ! $rest_data[0]->phone ){
            @endphp

            <div class="alert alert-dismissible alert-info">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Hurry !</strong> Please <a href="{{ route('profile') }}" class="alert-link">complete your profile</a>.
                Your profile will get you more customer.
            </div>
            @php }
            @endphp
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="col-md-6" >
                        <div class="jumbotron">
                        @php if( isset($data[0]->wCode) ){ @endphp
                            <p class="lead">Your current waiter unique code: {{ $data[0]->wCode }}</p>
                            <p class="lead">Your current waiter password: {{ $data[0]->password }}</p>
                            <a class="btn btn-primary" href="{{ route('ucode') }}"> Update Code</a>
                        @php } else{ @endphp
                            <p class="lead">Your haven't set any waiter unique code.</p>
                            <a class="btn btn-primary" href="{{ route('ucode') }}"> Add new one </a>
                        @php } @endphp
                            
                        </div>
                    </div>

                    <div class="col-md-6" >
                        <div class="jumbotron">
                        @php if( isset($data2[0]->kCode) ){ @endphp
                            <p class="lead">Your current Kitchen unique code: {{ $data2[0]->kCode }}</p>
                            <p class="lead">Your current Kitchen password: {{ $data2[0]->password }}</p>
                            <a class="btn btn-primary" href="{{ url('/kitchen/ucode') }}"> Update Code</a>
                        @php } else{ @endphp
                            <p class="lead">Your haven't set any Kitchen unique code.</p>
                            <a class="btn btn-primary" href="{{ url('/kitchen/ucode') }}"> Add new one </a>
                        @php } @endphp
                            
                        </div>
                    </div>

                    <!-- <div class="col-md-3 col-xs-6">
                        
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>150</h3>

                                <p>New Orders</p>
                            </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
