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
                            <form class="form-horizontal" method="POST" action="#">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('new_ucode') ? ' has-error' : '' }}">
                                <label for="new_ucode" class="col-md-4 control-label">New uCode:</label>

                                <div class="col-md-6">
                                    <input id="new_ucode" type="text" class="form-control" name="new_ucode"  required autofocus>

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
