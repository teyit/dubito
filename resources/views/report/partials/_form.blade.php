@if(isset($is_edit) and  $is_edit == true)  
    <form action="{{ route('custom.update.reports',$report->id)}}" method="post" style="border-radius: 0px;" enctype="multipart/form-data" class="form-horizontal group-border-dashed">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label class="col-sm-3 control-label">Report</label>
            <div class="col-sm-6">
                <textarea required name="text"  class="form-control">{{$report->text}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Source</label>
            <div class="col-sm-6">

                <select name="source" id="" class="form-control">
                    @foreach(['whatsapp','other'] as $source)
                      @if($report->source == $source)
                            <option value="{{$source}}" selected>{{ucfirst($source)}}</option>
                      @else
                            <option value="{{array_remove_by_value(['whatsapp','other'],$report->source)[0]}}">{{ucfirst(array_remove_by_value(['whatsapp','other'],$report->source)[0])}}</option>
                      @endif

                   @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$report->phone or ''}}" name="phone">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Case</label>
            <div class="col-sm-6">
                <div class="input-group xs-mb-15">
                    <select name="case_id" required class="select2 report-cases">
                        @foreach($cases as $case)
                            @if($case->id == $report->case_id)
                                <option value="{{$case->id}}" selected>{{$case->title}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->title}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button data-toggle="modal"  data-target="#add-new-case"  type="button" class="btn  btn-space btn-success md-trigger">Add New Case</button>
                    </div>
                </div>
            </div>
        </div>
       

        <div class="form-group">
            <label class="col-sm-3 control-label">Report Files</label>
            <div class="col-sm-6">
                <input type="file" name="report_files[]" id="file-1" data-multiple-caption="{count} files selected" multiple class="inputfile">
                <label for="file-1" class="btn-default"> <i class="mdi mdi-upload"></i><span>Browse files</span></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
                <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Update Report</button>
                </p>
            </div>
        </div>
    </form>

      @if(!$report->files->isEmpty())
        <div class="panel-heading">Report Files</div>
        <hr>
        <div class="panel-body">
            <div class="gallery-container">
                @foreach($report->files as $file)
                    <div class="item">
                        <div class="photo">
                            <div class="img"><img src="{{ConverterFileLink($file->file_url)}}" alt="Gallery Image">
                                <div class="over">
                                    <div class="info-wrapper">
                                        <div class="info">
                                            <div class="func"><a class="remove-file-from-report" data-file-id="{{$file->id}}" href="javascript:;"><i class="icon mdi mdi-delete"></i></a><a href="{{ConverterFileLink($file->file_url)}}" class="image-zoom"><i class="icon mdi mdi-search"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      @endif


    @else
    <form action="{{ route("custom.store.reports")}}" method="post" style="border-radius: 0px;" enctype="multipart/form-data" class="form-horizontal group-border-dashed">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-3 control-label">Report</label>
            <div class="col-sm-6">
                <textarea type="text" required name="text" value="" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Source</label>
            <div class="col-sm-6">
                <select name="source" id="" class="form-control">
                    <option value="whatsapp">Whatsapp</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="" name="account_name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-6">
                    <input type="text" class="form-control" value="" name="phone">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date</label>
            <div class="col-sm-6">
                <input type="text" name="created_at" value="{{$report->created_at or ''}}" class="form-control datetimepicker">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Case</label>
            <div class="col-sm-6">
                <div class="input-group xs-mb-16">
                    <select name="case_id" required class="select2 form-control report-cases">
                        @foreach($cases as $case)
                        <option value="{{$case->id}}">{{$case->title}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button data-toggle="modal"  data-target="#add-new-case"  type="button" class="btn  btn-space btn-success md-trigger">Add New Case</button>
                    </div>
                </div>
            </div>
        </div>
        @if(false)
        <!--
        <div class="form-group">
            <label class="col-sm-3 control-label">Status</label>
            <div class="col-sm-6">
                    <select name="status" required class="form-control">
                        <option value="pending">Pending</option>
                        <option value="not_assigned">Not Assigned</option>
                        <option value="in_archived">In Archived</option>
                    </select>
            </div>
        </div>
        -->
        @endif


        <div class="form-group">
            <label class="col-sm-3 control-label">Report Files</label>
            <div class="col-sm-6">
                <input type="file" name="report_files[]" id="file-1" data-multiple-caption="{count} files selected" multiple class="inputfile">
                <label for="file-1" class="btn-default"> <i class="mdi mdi-upload"></i><span>Browse files</span></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
                <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Assign</button>
                </p>
            </div>
        </div>
    </form>
@endif


