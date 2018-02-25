@section('title', 'Kitchen Login')

@extends('layouts.kitchen')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Kitchen Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/kitchen/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('kCode') ? ' has-error' : '' }}">
                            <label for="kCode" class="col-md-4 control-label">Kitchen Unique Code</label>

                            <div class="col-md-6">
                                <input id="kCode" type="text" class="form-control" name="kCode" value="{{ old('kCode') }}" autofocus>

                                @if ($errors->has('kCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
