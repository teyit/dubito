@if(isset($is_edit) and  $is_edit == true)
    <form action="{{ route('reports.update',$report->id)}}" method="post" style="border-radius: 0px;" enctype="multipart/form-data" class="form-horizontal group-border-dashed">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
                <input type="text" required name="title" value="{{$report->title}}" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Source</label>
            <div class="col-sm-6">
                <input type="text" name="source" readonly class="form-control" value="other">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Case</label>
            <div class="col-sm-6">
                <div class="input-group xs-mb-15">
                    <select name="case_id" required class="form-control report-cases-edit">
                        @foreach($cases as $case)
                            @if($case->id == $report->case_id)
                                <option value="{{$case->id}}" selected>{{$case->title}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->title}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button data-toggle="modal"  data-target="#mod-success"  type="button" class="btn  btn-space btn-success md-trigger">Add New Case</button>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <label class="col-sm-3 control-label">Report Files</label>
            <div class="col-sm-6">
                <input type="file" name="report_files[]" id="file-1" data-multiple-caption="{count} files selected" multiple class="inputfile">
                <label for="file-1" class="btn-default"> <i class="mdi mdi-upload"></i><span>Browse files</span></label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <div class="input-group xs-mb-15">
                    <select name="category_id" required class="form-control report-categories-edit">
                        @foreach($categories as $category)
                            @if($category->id == $report->reportfiles[0]->report_id)
                                <option value="{{$category->id}}"selected>{{$category->title}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button data-toggle="modal"  data-target="#category-modal"  type="button" class="btn  btn-space btn-success md-trigger">Add New Category</button>
                    </div>
                </div>
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
@else

    <form action="{{ route("reports.store")}}" method="post" style="border-radius: 0px;" enctype="multipart/form-data" class="form-horizontal group-border-dashed">
        {{csrf_field()}}

        <div class="form-group">
            <label class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
                <input type="text" required name="title" value="" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Source</label>
            <div class="col-sm-6">
                <input type="text" name="source" readonly class="form-control" value="other">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Case</label>
            <div class="col-sm-6">
                <div class="input-group xs-mb-15">
                    <select name="case_id" required class="form-control report-cases-create">
                        @foreach($cases as $case)
                        <option value="{{$case->id}}">{{$case->title}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button data-toggle="modal"  data-target="#mod-success"  type="button" class="btn  btn-space btn-success md-trigger">Add New Case</button>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <label class="col-sm-3 control-label">Report Files</label>
            <div class="col-sm-6">
                <input type="file" name="report_files[]" id="file-1" data-multiple-caption="{count} files selected" multiple class="inputfile">
                <label for="file-1" class="btn-default"> <i class="mdi mdi-upload"></i><span>Browse files</span></label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <div class="input-group xs-mb-15">
                    <select name="category_id" required class="form-control report-categories-create">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <button data-toggle="modal"  data-target="#category-modal"  type="button" class="btn  btn-space btn-success md-trigger">Add New Category</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
                <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Add Report</button>
                </p>
            </div>
        </div>

    </form>

@endif


@include("report._case_modal_form")
@include("report._category_modal_form")
