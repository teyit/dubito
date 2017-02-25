<div id="edit-topic-modal" tabindex="-1" role="dialog" style=""  class='modal fade colored-header colored-header-primary in'>
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Topic</h3>

            </div>
            <div class="modal-body">

                        <form id="edit-topic-form" method="post" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" id="edit-topic-title" required placeholder="Enter Topic title" class="form-control">
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
            $(document).on('click',".topic-edit-btn",function () {
                var id = $(this).data('id');
                $.getJSON("/topics/" + id + "/edit", function( data ) {
                    $("#edit-topic-title").val(data.title);
                    $("#edit-topic-modal").data('id',data.id);
                    $('#edit-topic-modal').modal({
                        show: 'true',
                        keyboard: false
                    });
                });
                $("#edit-topic-form").submit(function(event){
                    var id = $("#edit-topic-modal").data('id');
                    var title = $('#edit-topic-title').val();
                    event.preventDefault();
                    console.log(id);
                    $.ajax({
                        method:"PUT",
                        url: 'topics/' + id,
                        data: {
                            _token: $('#_token').val(),
                            title: title
                        },
                        success:function(data){
                            if(data == 'true'){
                                window.location.href = '/topics';
                            }

                        }
                    })
                });

            });

        });
    </script>
@endsection
