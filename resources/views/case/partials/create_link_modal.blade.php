<div id="case-link-create" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Link</h3>

            </div>
            <div class="modal-body custom-width">
                <form id = "create-link-form" method="post" action="{{route("cases.links.store",$case->id)}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" value="" required placeholder="Enter link" id="edit-case-title" class="form-control">
                        <input type="hidden" name="case_id" value="{{$case->id}}">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-space btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

