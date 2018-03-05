@section('title', 'Profile')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form action="{{ route('editprofile') }}" method="post">
                            {{ csrf_field() }}


                            <input name="id" value="{{Auth::id()}}" type="hidden" >
                            <button type="submit" class="btn btn-warning pull-right"> Edit Info</button>

                        </form>
                        The {{ $data[0]->rest_name }}
                    </div>

                <div class="panel-body">
                    <p class="lead">Owner Name: <span class="text-bold text-center"> {{ $data[0]->owner_name }}</span></p>
                    <p class="lead">Image:</p> <img height="300px" width="350px" class="img-bordered" src="{{asset('/images/'.$data[0]->image)}}">

                    <p class="lead">Address: <span class=" text-center"> {{ $data[0]->address }}</span></p>
                    <p class="lead">Contact: <span class=" text-center"> {{ $data[0]->phone }}</span></p>
                    <p class="lead">Closing Day: <span class="text-center"> {{ $data[0]->closing_day }}</span></p>


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
