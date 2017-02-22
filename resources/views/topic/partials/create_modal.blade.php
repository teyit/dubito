<div id="topic-create" tabindex="-1" role="dialog" style="" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Topic</h3>

            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="xs-mt-50">
                        <form method="post" action="{{route("topics.store")}}">
                            {{ csrf_field() }}
                            <div class="form-group xs-pt-10">
                                <label>Title</label>
                                <input type="text" name="title" value="{{$tag->title or ""}}" required placeholder="Enter Topic title" class="form-control">
                            </div>
                            <div class="form-group xs-pt-10">
                                <button type="submit" class="btn btn-space btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>