@section('title', 'Edit Item')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
         
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Edit Item</h4>

                                </div>

                                <div class="modal-body">

                                    <form data-toggle="validator" action="{{ url('/updateitem') }}" method="POST">
                                    {{ csrf_field() }}
                                    
                                    <!-- <input name="_method" type="hidden" value="PATCH"> -->
                                    <input name="id" type="hidden" value="{{ $item->id }}">

                                        <div class="form-group">
                                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
           
                                            <label class="control-label" for="title">Category:</label>
                                            @php $category = App\Category::where('rest_id', Auth::id())->get(); @endphp

                                            <select class="form-control" name="cat_id" required>
                                                <option>Select Category</option>
                                            
                                            @foreach ($category as $name)
                                                <option value="{{ $name->id}}" @if( $name->id == $item->cat_id ) selected='selected' @endif > {{ $name->cat_name}}</option>
                                            @endforeach
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="name">Title:</label>

                                            <input type="text" name="name" class="form-control" value="{{ $item->item_name }}" data-error="Please enter name." required />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="price">Price:</label>

                                            <input type="number" step="any" min="0" name="price" value="{{ $item->price }}" class="form-control" data-error="Please enter price." required />
                                            <input type="hidden"  name="rest_id" class="form-control" value="{{ Auth::id() }}" />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="image">Image:</label>

                                            <input type="file"  name="image" class="form-control" />
                                            
                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="btn crud-submit btn-success">Update Item</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>
                </div>
    </div>
</div>
@endsection
