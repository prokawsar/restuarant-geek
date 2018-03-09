@section('title', 'Register')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Restaurant Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('owner-name') ? ' has-error' : '' }}">
                            <label for="owner-name" class="col-md-4 control-label">Owner Name</label>

                            <div class="col-md-6">
                                <input id="owner-name" type="text" class="form-control" name="owner-name" value="{{ old('owner-name') }}" required autofocus>

                                @if ($errors->has('owner-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rest-name') ? ' has-error' : '' }}">
                            <label for="rest-name" class="col-md-4 control-label">Restaurant Name</label>

                            <div class="col-md-6">
                                <input id="rest-name" type="text" class="form-control" name="rest-name" value="{{ old('rest-name') }}" required>

                                @if ($errors->has('rest-name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rest-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                            <div class="col-md-6 col-md-offset-4">
                                <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Register
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
