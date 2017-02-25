<div id="edit-tag-modal" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Tag</h3>

            </div>
            <div class="modal-body">

                        <form id="edit-tag-form" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title"  id="edit-tag-title" required placeholder="Enter tag title" class="form-control">
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
            $(document).on('click',".tag-edit-btn",function () {
                var id = $(this).data('id');
                console.log(id);
                $.getJSON("/tags/" + id + "/edit", function( data ) {
                    console.log(data);
                    $("#edit-tag-title").val(data.title);
                    $("#edit-tag-modal").data('id',data.id);
                    $('#edit-tag-modal').modal({
                        show: 'true',
                        keyboard: false
                    });
                });
                $("#edit-tag-form").submit(function(event){
                    var id = $("#edit-tag-modal").data('id');
                    var title = $('#edit-tag-title').val();
                    event.preventDefault();

                    $.ajax({
                        method:"PUT",
                        url: 'tags/' + id,
                        data: {
                            _token: $('#_token').val(),
                            title: title
                        },
                        success:function(data){
                            if(data == 'true'){
                                window.location.href = '/tags';
                            }

                        }
                    })
                });

            });

        });
    </script>
@endsection