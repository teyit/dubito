@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
    <div class="panel panel-default panel-table">
        <div class="panel-heading">Reports
           &nbsp;  <a href="/reports/create" class="btn btn-success"> Add Report</a>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    {{--<th>Detail</th>--}}
                    <th>Title</th>
                    <th>Case</th>
                    <th>Created At</th>
                    <th class="actions">Edit</th>
                    <th class="actions">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        {{--<td><a href="{{route('reports.show',$report->id)}}" class="icon"><i class="mdi mdi-arrow-right"></i></a></td>--}}
                        <td><b><a href="{{route('reports.show',$report->id)}}"> {{$report->title}}</a></b></td>
                        <td>{{$report->cases->title or  "There is no case"}}</td>
                        <td>{{$report->created_at}}</td>
                        <td class="actions"><a href="{{route("reports.edit",$report->id)}}" class="icon"><i class="mdi mdi-edit"></i></a></td>
                        <td class="actions">
                            <form method="post" action="{{route("reports.destroy",$report->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection