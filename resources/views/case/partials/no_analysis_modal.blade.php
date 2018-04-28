<div id="no-analysis-reason" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:darkslategray">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span style="color:white" class="mdi mdi-close"></span></button>
                <h3 class="modal-title">No Analysis</h3>

            </div>
            <div class="modal-body custom-width">
                <form id = "create-link-form" method="post" action="/cases/setNoAnalysis/{{$case->id}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Reason</label>
                        <input type="text" name="reason" value="{{$case->no_analysis_reason}}" placeholder="Enter reason (leave blank if you don't want it to be listed on public)" id="no_analysis_reason" class="form-control">
                        <input type="hidden" name="case_id" value="{{$case->id}}">
                        <div style="display:flex;margin-top:8px">
                        <span class="no-analysis-default">Yeterli delil yok</span>
                        <span class="no-analysis-default">Deliller güvenilir değil</span>
                        <span class="no-analysis-default">Deliller açık ve ulaşılabilir değil</span>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" style="background-color:darkslategray" class="btn btn-space btn-primary">Close Case</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

