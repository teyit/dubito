<div id="edit-category-modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Edit Cagetory</h3>

            </div>
            <div class="modal-body">
                        <form id="edit-category-form" method="post" action="">

                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="edit-category-title" name="title" value="" required placeholder="Enter category title" class="form-control">
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
            $(document).on('click',".category-edit-btn",function () {
                var id = $(this).data('id');


                $.getJSON("/categories/" + id + "/edit", function( data ) {
                    $("#edit-category-title").val(data.title);
                    $("#edit-category-modal").data('id',data.id);
                    $('#edit-category-modal').modal({
                        show: 'true',
                        keyboard: false
                    });
                });
                $("#edit-category-form").submit(function(event){
                    var id = $("#edit-category-modal").data('id');
                    var title = $('#edit-category-title').val();
                    event.preventDefault();
                    console.log(id);
                    $.ajax({
                        method:"PUT",
                        url: 'categories/' + id,
                        data: {
                            _token: $('#_token').val(),
                            title: title
                        },
                        success:function(data){
                            console.log(data);
                            if(data == 'true'){
                                window.location.href = '/categories';
                            }

                        }
                    })
                });

            });

        });
    </script>
@endsection
