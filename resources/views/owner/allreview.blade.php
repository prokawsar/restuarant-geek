@section('title', 'All Review')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Review</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($reviews as $review)

                        <div role="document" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                </div>
                                <div class="modal-body">
                                    <span class="lead">Customer Name:</span>
                                    <span class="lead text-maroon">{{ $review->customer->name }} </span>
                                    <br>
                                    <span class="lead">Review:</span>
                                    <blockquote>{{ $review->review }}
                                    </blockquote>
                                        <br>

                                    <span class="lead">Rating:</span>
                                    <div class="progress">
                                        <div class="progress-bar"  title="Rating {{ $review->rating }}" style="width: @php echo 20*$review->rating; @endphp%;"></div>
                                    </div>



                                </div>
                            </div>
                        </div>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
