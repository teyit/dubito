<div id="add-new-case" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in" style="z-index:999999 !important;">
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
                               <select multiple  name="topic_id" class="form-control autocomplete">
                                   <option value="">Select</option>
                                @foreach($topics as $topic)
                                       <option value="{{$topic->id}}">{{$topic->title}}</option>
                                @endforeach
                               </select>

                           </div>

                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <div class="col-sm-12">

                                </div>
                                    <select multiple name="category_id" required class="form-control report-categories-create autocomplete ">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                            </div>


                            <div class="form-group ">
                                <label for="case_id">Status</label>
                                <select class="form-control is_archived" name="is_archived" id="is_archived">
                                    <option value="ongoing">Ongoing</option>
                                    <option value="archived">Archived</option>
                                    <option value="backlog">Backlog</option>
                                </select>
                            </div>


                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

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
@section('script')
@parent
<script>
    $(document).ready(function(){
        $(".autocomplete").select2({
            tags : true,
            width: "100%",
            maximumSelectionLength : 1
        });
    });
</script>
@stop