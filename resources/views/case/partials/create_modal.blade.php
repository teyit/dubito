<div id="add-new-case" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary in" >
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
                            <!--
                            <div class="form-group ">
                                <label for="case_id">Cases</label>
                                <select class="autocomplete-cases" name="case_id" id="case_id">
                                    <option value="">Select Case</option>
                                </select>
                            </div>-->
                           <div class="form-group">
                               <label>Select Topic</label>
                               <select multiple name="topic_id" class="form-control autocomplete">
                                <option value="">Select</option>
                                @foreach($topics as $topic)
                                       <option value="{{$topic->id}}">{{$topic->title}}</option>
                                @endforeach
                               </select>
                           </div>

                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <select multiple name="category_id" required class="form-control report-categories-create autocomplete ">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group ">
                                <label for="case_status">Status</label>
                                <select class="form-control folder" name="folder" id="folder">
                                    @foreach(\App\Model\Cases::first()->folderLabels as $status=> $label)
                                    <option value="{{$status}}">{{$label}}</option>
                                    @endforeach
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
        $("#case-form-ajax").on('submit',function(e){

            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            e.preventDefault();

            $.ajax({
                type:"POST",
                url:'/api/cases',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){

                    if(data){
                        getCases(function(data){
                            var $reportCases = $(".report-cases");
                            $reportCases.find('option').remove();
                            $.each(data, function(index, cases) {
                                $reportCases.append('<option value="' + cases.id + '">' + cases.title + '</option>');
                            });
                        });
                        $.gritter.add({
                            title: 'Success',
                            text: 'Case was added successfuly',
                            class_name: 'color success'
                        });

                        $('#add-new-case').modal('hide');
                        $(window).trigger('case-created',data);

                    }
                },
                error: function(data){

                }
            });
        });
    </script>
@stop