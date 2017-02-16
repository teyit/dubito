<div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="xs-mt-50">
                        <form action="" method="post" id="case-form-ajax">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="title" id="case-title" placeholder="Enter case title.." class="form-control">
                            </div>

                           <div class="form-group">
                               <label class="col-sm-12 control-label">Select Topic</label>
                               <select name="topic_id" class="form-control">
                                @foreach($topics as $topic)
                                       <option value="{{$topic->id}}">{{$topic->title}}</option>
                                @endforeach
                               </select>

                           </div>
                            <div class="form-group">
                                <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
                                <button  type="submit"  class="btn btn-space btn-success add-case">Add Case</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>