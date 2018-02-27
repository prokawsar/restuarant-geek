@section('title', 'Add Category')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Item Add</div>--}}

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <a class="btn btn-info" href="{{ URL::previous() }}">Back</a>

                                    <!-- <h4 class="modal-title">Add Category</h4> -->

                                </div>

                                <div class="modal-body">



                                    <form data-toggle="validator" action="{{ url('/addcategory') }}" method="POST">
                                    
                                    {{ csrf_field() }}
                                        @php $category = App\Category::where('rest_id', Auth::id())->get(); @endphp

                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active text-center"><a href="#">Current Categories</a></li>
                                            @foreach ($category as $name)
                                            <li><a href="#">{{ $name->cat_name}}</a></li>
                                           
                                            @endforeach
                                        
                                        </ul>

                                        <div class="form-group">

                                            <label class="control-label" for="title">Name:</label>

                                            <input type="text" id="title" name="title" class="form-control" data-error="Please enter title." required />
                                            <input type="hidden"  name="rest_id" class="form-control" value="{{ Auth::id() }}" />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        
                                        <div class="form-group">

                                            <button type="submit" class="btn crud-submit btn-success">Add Category</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>
                </div>
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@endsection
