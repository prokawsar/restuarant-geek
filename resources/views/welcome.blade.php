@section('title', 'Restaurants')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <div class="col-md-12">
            
                <img style="width: 100%; height: 100%;" src="{{ asset('images/home-back.jpg') }}" >
            </div>
        </div>

    <hr>
    <div class="input-group input-group">
        <input type="text" class="form-control"  placeholder="Search Restuarant" >
        <span class="input-group-addon">
            <button type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>  
        </span>
    </div>

    <hr>
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ asset('images/no-image.jpg') }}" alt="No Image">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.
                                Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p>
                                <a href="#" class="btn btn-primary" role="button">View More</a></p>
                            </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ asset('images/no-image.jpg') }}" alt="No Image">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.
                                Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p>
                                <a href="#" class="btn btn-primary" role="button">View More</a></p>
                            </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ asset('images/no-image.jpg') }}" alt="No Image">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.
                                Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p>
                                <a href="#" class="btn btn-primary" role="button">View More</a></p>
                            </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
