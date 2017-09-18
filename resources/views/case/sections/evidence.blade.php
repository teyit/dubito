<div class="panel panel-default">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Evidences</div>
                <div class="panel-body">
                    <form action="{{route("evidences.store")}}" method="POST" name="evidence-form-ajax"
                          id="evidence-form-ajax" enctype="multipart/form-data">
                        <div class="form-group">
                                    <textarea name="text" class="form-control"
                                              id="evidence-text">{{$evidence->text or ''}}</textarea>
                        </div>
                        <div class="form-group pull-left">
                            <ul class="evidence-file-name">
                            </ul>

                        </div>
                        <div class="form-group pull-right">

                            <input type="hidden" name="case_id" value="{{$case->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <input type="file" name="file[]" id="file-1"
                                   data-multiple-caption="{count} files selected" multiple
                                   class="inputfile evidence-file">
                            <label for="file-1" class="btn-default"> <i
                                        class="mdi mdi-attachment"></i><span>Browse files...</span></label>

                            <input type="hidden" name="case_id" value="{{$case->id}}">
                            <button data-case-id="{{$case->id}}" class="btn btn-success">Save</button>
                        </div>
                    </form>
                    <div class="clearfix"></div>

                    @if(!$case->evidences->isEmpty())
                        <ul class="user-timeline">

                            @foreach($case->evidences as $evidence)
                                <li class="latest">
                                    <span class="timeline-autor">{{$evidence->user->name or "Deleted User"}}</span> - <span
                                            style="color:#8c8c8c;padding-left:5px;">{{\Carbon\Carbon::parse($evidence->created_at)->format("d.m.Y")}}</span>
                                    <div class="user-timeline-description">
                                        {{$evidence->text or ''}}
                                        @if(!$evidence->links->isEmpty())
                                        @foreach($evidence->links as $l)
                                            @include("message.partials.linkPreview",$l)
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="gallery-container evidence-gallery-container">
                                        @foreach($evidence->files as $file)
                                            <div class="item">
                                                <div class="photo">
                                                    <div class="img"><img class="img-responsive" src="{{Storage::disk('s3')->url($file->file_url)}}" alt="Gallery Image">
                                                        <div class="over">
                                                            <div class="info-wrapper">
                                                                <div class="info">
                                                                    <div class="func evidence-func"><a class="add-file-to-case" data-file-id="{{$file->id}}" href="javascript:;"><i class="icon mdi mdi-plus"></i></a>
                                                                        <a href="{{Storage::disk('s3')->url($file->file_url)}}" class="image-zoom"><i class="icon mdi mdi-search"></i></a>
                                                                        <a href="{{Storage::disk('s3')->url($file->file_url)}}" download><i class="icon mdi mdi-download"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>