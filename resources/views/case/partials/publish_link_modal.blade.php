<div id="published-link-create" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Publish Link</h3>

            </div>
            <div class="modal-body custom-width">
                <form id = "create-link-form" method="post" action="/cases/setPublishedLink/{{$case->id}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Link</label>
                        <input type="url" name="link" value="{{$case->published_link}}" required placeholder="Enter link" id="published_link" class="form-control">
                        <input type="hidden" name="case_id" value="{{$case->id}}">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-space btn-primary">Publish</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

