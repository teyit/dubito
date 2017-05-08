@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                       Log Activities
                    </div>
                    <div class="panel-body">
                        <table id="activity-datatable" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Subject</th>
                                <th>Change Fields</th>
                                <th>Created at</th>
                                <th>Updated at</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{$activity->id}}</td>
                                    <td>{{$activity->description}}</td>
                                    <td>{{explode("\\",$activity->subject_type)[2]}}</td>
                                    <td>
                                        @if(isset($activity->changes->toArray()['attributes']))
                                            <b>NEW:</b> &nbsp; {{implode(', ',$activity->changes->toArray()['attributes'])}}
                                        @endif
                                            <br><br>

                                        @if(isset($activity->changes->toArray()['old']))
                                            <b>OLD:</b> &nbsp; {{implode(',',$activity->changes->toArray()['old'])}}
                                        @endif

                                    </td>
                                    <td>{{$activity->created_at}}</td>
                                    <td>{{$activity->updated_at}}</td>
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
@section('script')

@endsection