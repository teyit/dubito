<div class="panel panel-default">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">Evidences</div>
                <div class="panel-body">
                    <form action="{{route("evidences.store")}}" method="POST" name="evidence-form-ajax"
                          id="evidence-form-ajax" enctype="multipart/form-data">
                        <div class="form-group">
                            <textarea placeholder="Add an evidence" name="text" class="form-control" id="evidence-text">{{$evidence->text or ''}}</textarea>
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
                    <div style="margin:0px 0px;" class="clearfix"></div>

                    @if(!$case->evidences->isEmpty())
                        <ul class="user-timeline">

                            @foreach($case->evidences as $evidence)
                                <li class="latest">
                                    <div style="float:left">
                                        <span class="timeline-autor">{{$evidence->user->name or "Deleted User"}}</span>
                                    </div>
                                    <div style="float:right;">
                                        <span style="color:#8c8c8c;padding-left:5px;">{{\Carbon\Carbon::parse($evidence->created_at)->format("d-m-Y H:i")}}</span> &nbsp;
                                        <span style="font-size:18px;"><a class="delete-evidence" data-case-id="{{$case->id}}" data-id="{{$evidence->id}}" style="color:#ea4335;" href="javascript:;" ><i class="icon mdi mdi-delete"></i></a></span>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="user-timeline-description">
                                        <div class="evidence-text">
                                            {{$evidence->text or ''}}
                                        </div>
                                        @if(!$evidence->links->isEmpty())
                                        @foreach($evidence->links as $l)
                                            @include("message.partials.linkPreview",$l)
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="gallery-container evidence-gallery-container">
                                        @foreach($evidence->files as $key => $file)
                                            @if($file->file_type == "image")
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
                                            @else
                                                &nbsp;&nbsp;<a style="font-size:14px;" href="{{Storage::disk('s3')->url($file->file_url)}}" download>File-{{$key+1}} <i class="icon mdi mdi-download"></i></a>
                                            @endif
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