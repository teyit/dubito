@extends('layout.app')
@section('content')
    <div class="main-content container-fluid report-modal">
        <div class="row">
            <div class="col-md-8">

                @foreach($reports as $report)
                    <div class="panel panel-flat">
                        <div class="timeline-content">
                            <div class="timeline-avatar"><img src="{{$report->account_picture}}" alt="{{$report->account_name}}" class="circle"></div>
                            <div class="timeline-header">
                                <!--<span class="timeline-time">4:34 PM</span>-->
                                <div><p class="timeline-autor">{{$report->account_name}}</p></div>
                                <p class="timeline-activity">{{$report->text}}</p>
                            </div>
                            <div class="timeline-gallery">
                                @foreach($report->images as $f)
                                    <img src="{{$f->file_url}}" alt="Thumbnail" class="gallery-thumbnail">
                                @endforeach
                            </div>
                        </div>

                        <div class="panel-footer clearfix">
                            {{$report->created_at->diffForHumans()}} / {{$report->source}}
                            <div class="tools">

                                <button  data-id="{{$report->id}}"  class="btn btn-space btn-success btn-sm report-assign-case"><i class="icon icon-left mdi mdi-cloud-done"></i> Assign to a case</button>
                                <button class="btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-cloud-done"></i> Archive</button>
                                &nbsp;
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('report.partials._assign_to_case_modal')

@endsection