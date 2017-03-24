<div id="add-new-case" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Case</h3>

            </div>
            <div class="modal-body">

                        <form action="" method="post" id="case-form-ajax">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" required name="title" id="case-title" placeholder="Enter case title.." class="form-control">
                            </div>

                           <div class="form-group">
                               <label>Select Topic</label>
                               <select name="topic_id" class="form-control">
                                @foreach($topics as $topic)
                                       <option value="{{$topic->id}}">{{$topic->title}}</option>
                                @endforeach
                               </select>

                           </div>

                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <div class="col-sm-12">

                                </div>
                                        <select name="category_id" required class="form-control report-categories-create">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                            </div>

                            <div class="success-message" style="display: none;"></div>

                            <div class="form-group">
                                <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button>
                                <button  type="submit"  class="btn btn-space btn-primary add-case">Add Case</button>
                            </div>
                        </form>

            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>