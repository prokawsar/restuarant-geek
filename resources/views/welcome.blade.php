@section('title', 'Restaurants')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
        <div class="col-md-12">
            <a href="{{ route('makeorder') }}" target="_blank" class="btn btn-info pull-right">Waiter View</a>
            <a href="{{ route('khome') }}" target="_blank" class="btn btn-warning pull-right">Kitchen View</a>
        </div>

            <div class="col-md-12">

                <br><img style="width: 100%; height: 100%;" src="{{ asset('images/home-back.jpg') }}" >
            </div>
        </div>

    <hr>


    <hr>
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="lead text-center"><h3>Whom are Intelligent Restaurant </h3></div>

                @foreach($users as $user)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img style="width: 300px; height: 200px;"  src="{{ asset('restaurant/'.$user->image) }}" alt="No Image">
                            <div class="caption">
                                <h3>{{ $user->rest_name }}</h3>
                                <p><i class="glyphicon glyphicon-home"></i> {{ $user->address }}</p>
                                <p><i class="glyphicon glyphicon-earphone"></i> {{ $user->phone }}</p>

                                {{--<a href="#" class="btn btn-primary" role="button">View More</a></p>--}}
                            </div>
                    </div>
                </div>

                @endforeach
                {{ $users->links()  }}

            </div>
        </div>
    </div>
</div>
@endsection

