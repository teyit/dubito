
<div class="panel-heading">Reports</div>
<div>
    @foreach($case->reports as $report)
        <div class="panel panel-border-color panel-border-color-info">
            <div class="timeline-content">
                <div class="timeline-avatar"><img src="{{$report->account_picture or "/assets/img/avatar1.png"}}"
                                                  alt="{{$report->account_name}}" class="circle"></div>
                {{-- <div class="timeline-avatar"><img src="{{$report->account_picture}}" alt="{{$report->account_name}}" class="circle"></div> --}}
                <div class="timeline-header">
                    <!--<span class="timeline-time">4:34 PM</span>-->
                    <div><p class="timeline-autor">{{$report->account_name or "no name  "}}</p></div>
                    <p class="timeline-activity">{!! $report->text !!}</p>
                </div>
                <div class="timeline-gallery">
                    @foreach($report->files as $f)
                        <div class="gallery-container">
                            <div class="item">
                                <div class="photo">
                                    <div class="img"><img src="{{$f->file_url}}" alt="Gallery Image">
                                        <div class="over">
                                            <div class="info-wrapper">
                                                <div class="info">
                                                    <div class="func"><a class="add-file-to-case"
                                                                         data-file-id="{{$f->id}}"
                                                                         href="javascript:;"><i
                                                                    class="icon mdi mdi-plus"></i></a>
                                                        <a
                                                                href="{{$f->file_url}}"
                                                                class="image-zoom"><i
                                                                    class="icon mdi mdi-search"></i></a>
                                                        <a
                                                                href="{{$f->file_url}}"
                                                                download ><i
                                                                    class="icon mdi mdi-download"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<img src="{{$f->file_url}}" alt="Thumbnail" class="gallery-thumbnail">--}}
                    @endforeach
                </div>
            </div>

            <div class="panel-footer clearfix">
                {{$report->created_at->diffForHumans()}} / <span class="label label-primary">{{$report->source}}</span> @if($report->phone) / {{$report->phone}} @endif
                <div class="tools">

                    {{--<button  data-id="{{$report->id}}"  class="btn btn-space btn-success btn-sm report-assign-case"><i class="icon icon-left mdi mdi-cloud-done"></i> Assign to a case</button>--}}
                    {{--<button class="btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-cloud-done"></i> Archive</button>--}}
                    {{--&nbsp;--}}
                </div>

            </div>
        </div>
    @endforeach
</div>