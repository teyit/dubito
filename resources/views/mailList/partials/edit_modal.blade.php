<div id="edit-mailList-modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary in" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Edit Recipient</h3>

            </div>
            <div class="modal-body">

                <form action="" method="post" id="edit-mailList-form">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" required name="name" id="mailList-name" placeholder="Enter name.." class="form-control mailList-name">
                    </div>

                    <div class="form-group">
                        <input type="email" required name="email" id="mailList-email" placeholder="Enter email" class="form-control mailList-email">
                    </div>
                    <div class="success-message" style="display: none;"></div>

                    <div class="form-group">
                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button>
                        <button  type="submit"  class="btn btn-space btn-primary add-case">Update Recipient</button>
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
        $(document).on('click',".mailList-edit-btn",function (e) {
            e.preventDefault();
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            });

            const mailListID = $(this).attr('data-id');

            $.ajax({
                type:"GET",
                url:'/mailList/'+mailListID + "/edit",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    $("#edit-mailList-modal").data('id',data.mailList.id);
                    $(".mailList-name").val(data.mailList.name);
                    $(".mailList-email").val(data.mailList.email);
                    $('#edit-mailList-modal').modal({
                        show: 'true',
                        keyboard: false
                    });

                },
                error: function(data){

                }
            });
        });

        $("#edit-mailList-form").on('submit',function(e){
            var mailListID = $("#edit-mailList-modal").data('id');
            e.preventDefault();
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            });

            $.ajax({
                type:"PUT",
                url:'/mailList/'+mailListID,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    if(data){

                        $('#edit-mailList-modal').modal('hide');

                        $.gritter.add({
                            title: 'Success',
                            text: 'Recipient was updated successfuly',
                            class_name: 'color success'
                        });

                        window.location.reload();
                    }

                },
                error: function(data){

                }
            });
        });


    </script>
@stop