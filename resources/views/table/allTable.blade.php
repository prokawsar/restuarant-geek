@section('title', 'All Table')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-5">
            <a href="{{ route('addTable') }}" class="btn btn-success">Add New Table</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">All Table </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if (session('danger'))
                            <div class="alert alert-danger">
                                {{ session('danger') }}
                            </div>
                        @endif

                        @php $table = App\Table::where('rest_id', Auth::id())->get(); @endphp

                            <table class="table table-hover">
                                <thead>
                                <tr>

                                    <th scope="col">Table Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($table as $name)
                                <tr>
                                    <th scope="row">{{ $name->name_or_no}}</th>
                                    <td><a href="{{ route('deleteTable', ['id' => $name->id]) }}" class="btn btn-danger" >Delete</a></td>
                                    
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
