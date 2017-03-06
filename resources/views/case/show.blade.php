@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">


        <div class="user-info-list panel panel-default">
            <div class="panel-heading panel-heading-divider"><b>{{$case->title}} </b><span class="panel-subtitle">{{$case->topic->title}} - {{$case->category->title}}</span></div>
            <div class="panel-body">
                <table class="no-border no-strip skills">
                    <tbody class="no-border-x no-border-y">
                    <tr>
                        <td class="icon"><span class="mdi mdi-"></span></td>
                        <td class="item">Created By<span class="icon s7-portfolio"></span></td>
                        <td>{{$case->user->name}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-date"></span></td>
                        <td class="item">Created at<span class="icon s7-gift"></span></td>
                        <td>{{$case->created_at}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-date"></span></td>
                        <td class="item">Updated at<span class="icon s7-gift"></span></td>
                        <td>{{$case->updated_at}}</td>
                    </tr>
                    <tr>
                        <td class="icon"><span class="mdi mdi-date"></span></td>
                        <td class="item">Status<span class="icon s7-gift"></span></td>
                        <td>{{$case->status}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default panel-table">


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
                            @foreach($case->reports as $reports)
                            <tr>
                                <td>{{$reports->id}}</td>
                                <td>{{$reports->source}}</td>
                                <td>{{$reports->accound_name}}</td>
                                <td>{{$reports->text}}</td>
                                <td>{{$reports->status}}</td>
                                <td>{{$reports->created_at}}</td>
                                <td>{{$reports->updated_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
        </div>


@endsection