@section('title', 'Make Order')

@extends('layouts.waiter')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
        
                <div class="panel-heading">Waiter Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="#">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('uCode') ? ' has-error' : '' }}">
                            <label for="uCode" class="col-md-4 control-label">Unique Code</label>

                            <div class="col-md-6">
                                <input id="uCode" type="text" class="form-control" name="uCode" value="{{ old('uCode') }}" required autofocus>

                                @if ($errors->has('uCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4 pull-right">
                                
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
