<div id="edit-case-modal" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Case</h3>

            </div>
            <div class="modal-body custom-width">
                        <form id = "edit-case-form" method="post" action="{{route("cases.store")}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="" required placeholder="Enter case title" id="edit-case-title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Categories</label>
                                <select class="form-control" id="edit-case-categories" name="category_id" id="">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Topic</label>
                                <select class="form-control" name="topic_id" id="edit-case-topics">
                                    <option value="">Select Topic</option>
                                    @foreach($topics as $topic)
                                        <option value="{{$topic->id}}">{{$topic->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-space btn-primary">Update</button>
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
        $(function(){
            $(document).on('click',".case-edit-btn",function () {
                var id = $(this).data('id');
                $.getJSON("/cases/"+ id +"/edit", function(data) {

                    $("#edit-case-modal").data('id',data.case.id);

                    $("#edit-case-categories").find('option').remove();
                    $.each(data.categories, function(index, category) {
                        $("#edit-case-categories").append('<option value="' + category.id + '">' + category.title + '</option>');
                    });

                    $("#edit-case-topics").find('option').remove();

                    $.each(data.topics, function(index, topic) {
                        $("#edit-case-topics").append('<option value="' + topic.id + '">' + topic.title + '</option>');
                    });

                    $("#edit-case-title").val(data.case.title);
                    $('#edit-case-categories').val(data.case.category_id);
                    $('#edit-case-topics').val(data.case.topic_id);

                    $("#edit-case-modal").data('id',data.id);
                    $('#edit-case-modal').modal({
                        show: 'true',
                        keyboard: false
                    });
                });


                $("#edit-case-form").submit(function(event){
                    var id = $("#edit-case-modal").data('id');
                    var title = $('#edit-case-title').val();
                    var category = $("#edit-case-categories").val();
                    var topic = $("#edit-case-topics").val();

                    event.preventDefault();

                    $.ajax({
                        method:"PUT",
                        url: '/cases/' + id,
                        data: {
                            _token: $('#_token').val(),
                            title: title,
                            category_id : category,
                            topic_id : topic
                        },
                        success:function(data){

                            if(data == 'true'){
                                window.location.href = '/cases';
                            }

                        }
                    })
                });

            });

        });
    </script>
@endsection
