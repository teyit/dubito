@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">


        <div class="panel panel-default panel-table">
            <div class="panel-heading">Reports
                &nbsp; <a href="/reports/create" class="btn btn-success"> Add Report</a>
            </div>
            <div class="panel-body">
                <table id="report-datatable" class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Source</th>
                        <th>Case</th>
                        <th>Created At</th>
                        <th class="actions"></th>
                    </tr>

                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Source</th>
                        <th>Case</th>
                        <th>Created At</th>
                        <th class="actions"></th>
                    </tr>
                    </tfoot>

                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{$report->id}}</td>
                            <td>
                                @if(strpos($report->source,":"))
                                  {{explode(":",$report->source)[0]}}
                                @else
                                    {{$report->source}}
                                @endif
                            </td>
                            <td>{{$report->case->title or ''}}</td>
                            <td>{{$report->created_at}}</td>

                            <td class="actions">
                                <div class="btn-group btn-space">
                                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a class="report-edit-btn" href="{{route("reports.edit",$report->id)}}" data-id="{{$report->id}}" >Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        {{--<div class="row">--}}
            {{--<div class="col-md-8">--}}

                {{--@foreach($reports as $report)--}}
                    {{--<div class="panel panel-flat">--}}
                        {{--<div class="timeline-content">--}}
                            {{--<div class="timeline-avatar"><img src="{{$report->account_picture}}" alt="{{$report->account_name}}" class="circle"></div>--}}
                            {{--<div class="timeline-header">--}}
                                {{--<!--<span class="timeline-time">4:34 PM</span>-->--}}
                                {{--<div><p class="timeline-autor">{{$report->account_name}}</p></div>--}}
                                {{--<p class="timeline-activity">{{$report->text}}</p>--}}
                            {{--</div>--}}
                            {{--<div class="timeline-gallery">--}}
                                {{--@foreach($report->images as $f)--}}
                                    {{--<img src="{{$f->file_url}}" alt="Thumbnail" class="gallery-thumbnail">--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="panel-footer clearfix">--}}
                            {{--{{$report->created_at->diffForHumans()}} / {{$report->source}}--}}
                            {{--<div class="tools">--}}

                                {{--<button  data-id="{{$report->id}}"  class="btn btn-space btn-success btn-sm report-assign-case"><i class="icon icon-left mdi mdi-cloud-done"></i> Assign to a case</button>--}}
                                {{--<button class="btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-cloud-done"></i> Archive</button>--}}
                                {{--&nbsp;--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    @include('report.partials.assign_to_case_modal')

@endsection