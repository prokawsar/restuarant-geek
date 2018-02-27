@section('title', 'Add Item')

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

                                    <h4 class="modal-title">Add Item</h4>

                                </div>

                                <div class="modal-body">



                                    <form data-toggle="validator" action="{{ url('/additem') }}" method="POST">
                                    {{ csrf_field() }}

                                        <div class="form-group">

                                            <label class="control-label" for="title">Category:</label>
                                            @php $category = App\Category::where('rest_id', Auth::id())->get(); @endphp

                                            <select class="form-control" name="cat_id" required>
                                                <option>Select Category</option>
                                            
                                            @foreach ($category as $name)
                                                <option value="{{ $name->id}}" >{{ $name->cat_name}}</option>
                                            @endforeach
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="name">Title:</label>

                                            <input type="text" name="name" class="form-control" data-error="Please enter name." required />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="price">Price:</label>

                                            <input type="number" step="any" min="0" name="price" class="form-control" data-error="Please enter price." required />
                                            <input type="hidden"  name="rest_id" class="form-control" value="{{ Auth::id() }}" />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="image">Image:</label>

                                            <input type="file"  name="image" class="form-control" />
                                            
                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="btn crud-submit btn-success">Add Item</button>

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
