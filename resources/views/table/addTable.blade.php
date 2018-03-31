@section('title', 'Add Table')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Table Add</div>--}}

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <a class="btn btn-info" href="{{ url('/alltable') }}">Back</a>

                                </div>

                                <div class="modal-body">

                                    <form data-toggle="validator" action="{{ url('/addtable') }}" method="POST">
                                    {{ csrf_field() }}

                                    @php $table = App\Table::where('rest_id', Auth::id())->get(); @endphp

                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active text-center"><a href="#">Current Tables</a></li>
                                            @foreach ($table as $name)
                                            <li><a href="#">{{ $name->name_or_no}}</a></li>
                                            <!-- <li><a href="#">Disabled</a></li> -->
                                            @endforeach

                                        </ul>

                                        <div class="form-group">

                                            <label class="control-label" for="table_title">Name/Title/No:</label>

                                            <input type="text" name="table_title" class="form-control" data-error="Please enter title." required />
                                            <input type="hidden"  name="rest_id" class="form-control" value="{{ Auth::id() }}" />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="btn crud-submit btn-success">Add Table</button>

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
