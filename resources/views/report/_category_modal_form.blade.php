<div id="category-modal" tabindex="-1" role="dialog" style="" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Category</h3>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="xs-mt-50">
                        <form action="" method="post" id="category-form-ajax">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="title" id="category-title" placeholder="Enter category title.." class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
                                <button  type="submit"  class="btn btn-space btn-primary add-case">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>