@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">

        <div class="panel panel-default panel-table">

            <div class="page-head">
                <h2 class="page-head-title">{{$case->title}} <br><small>{{$case->category->title}}</small></h2>
            </div>

            <br><br>

            <div class="panel panel-default">
                <div class="panel-heading">Reports</div>

                <div class="panel panel-default panel-table">
                    <div class="panel-body">
                        <table class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Source</th>
                                <th>Account Name</th>
                                <th>text</th>
                                <th>status</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                @foreach($case->reports as $reports)
                                <td>{{$reports->id}}</td>
                                <td>{{$reports->source}}</td>
                                <td>{{$reports->accound_name}}</td>
                                <td>{{$reports->text}}</td>
                                <td>{{$reports->status}}</td>
                                <tq>{{$reports->created_at}}</tq>
                                <td>{{$reports->updated_at}}</td>
                                @endforeach
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
        </div>


@endsection