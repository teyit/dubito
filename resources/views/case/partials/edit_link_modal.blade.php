<div id="edit-link-modal" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Link</h3>

            </div>
            <div class="modal-body custom-width">
                <form id="edit-link-form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" value="" required placeholder="Enter link" id="edit-link" class="form-control">
                        <input type="hidden" name="case_id" id="case_id" value="{{$case->id}}">
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
            $(document).on('click',".link-edit-btn",function () {
                var id = $(this).data('id');
                $.getJSON("/cases/"+ {{$case->id}} + "/links/" + id +"/edit", function(data) {

                    $("#edit-link-modal").data('id',data.id);

                    $('#edit-link').val(data.link);

                    $('#edit-link-modal').modal({
                        show: 'true',
                        keyboard: false
                    });

                });


                $("#edit-link-form").submit(function(event){
                    event.preventDefault();
                    var id = $("#edit-link-modal").data('id');
                    var link = $('#edit-link').val();
                    var case_id = $("#case_id").val();
                    var url = "/cases/"+ "{{$case->id}}" + "/links/" + id;

                    $.ajax({
                        method:"PUT",
                        url:url,
                        data: {
                            _token: $('#_token').val(),
                            link: link,
                            case_id:case_id
                        },
                        success:function(data){
                            $("#list-link-"+data.id).text(data.link);

                        }
                    })
                });

            });

        });
    </script>
@endsection
