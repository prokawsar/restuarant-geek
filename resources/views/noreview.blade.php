@section('title', 'Restaurants Review')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @php
                        $name = App\User::select('rest_name')->where('id', $id)->get();

                    @endphp
                    <div class="panel-heading lead">{{ $name[0]->rest_name }}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="text-maroon text-center">NO REVIEW ON THIS RESTAURANT</h4>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
