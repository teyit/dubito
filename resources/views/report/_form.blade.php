<form action="{{route("reports.store")}}" method="post" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{csrf_field()}}
    <div class="form-group">
        <label class="col-sm-3 control-label">Title</label>
        <div class="col-sm-6">
            <input type="text" required name="title" class="form-control">
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
                <select  required class="form-control report-cases">
                </select>
                <div class="input-group-btn">
                    <button data-toggle="modal"  data-target="#mod-success"  type="button" class="btn  btn-space btn-success md-trigger">Add New Case</button>
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
                <button type="submit" class="btn btn-space btn-success">Add Report</button>
            </p>
        </div>
    </div>

</form>

@include("report._case_modal_form")