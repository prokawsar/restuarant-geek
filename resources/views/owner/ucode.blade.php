@section('title', 'Dashboard')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add new waiter unique code</div>

                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3" >
                        <div class="jumbotron">
                            @if (session('alert'))
                                <div class="alert alert-success">
                                    {{ session('alert') }}
                                </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ url('/ucode') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('wCode') ? ' has-error' : '' }}">
                                <label for="wCode" class="col-md-4 control-label">New wCode:</label>

                                <div class="col-md-6">
                                    <input id="wCode" type="text" class="form-control" name="wCode" required autofocus>

                                    <input id="" type="hidden" name="rest_id" value="{{ Auth::id() }}" >

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">New Password:</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4 pull-right">
                                   
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>


                                </div>
                            </div>
                        </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
