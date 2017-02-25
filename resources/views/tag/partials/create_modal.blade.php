<div id="tag-create" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Tag</h3>

            </div>
            <div class="modal-body">

                        <form method="post" action="{{route("tags.store")}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title"  required placeholder="Enter Tag title" class="form-control">
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