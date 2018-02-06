<div id="edit-user-modal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary in" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Edit User</h3>

            </div>
            <div class="modal-body">

                <form action="" method="post" id="edit-user-form">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" required name="name" id="user-name" placeholder="Enter user name.." class="form-control user-name">
                    </div>

                    <div class="form-group">
                        <label>Select Role</label>
                        <select name="role_id" required  class="form-control user-role" id="user-role">
                            <option value="">Select</option>
                            <option value="1">Admin</option>
                            <option value="2">Writer</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="email" required name="email" id="user-email" placeholder="Enter user email" class="form-control user-email">
                    </div>


                    <div class="form-group">
                        <input type="text" name="password" id="user-password" placeholder="Enter user password" class="form-control">
                    </div>


                    <div class="success-message" style="display: none;"></div>

                    <div class="form-group">
                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button>
                        <button  type="submit"  class="btn btn-space btn-primary add-case">Update User</button>
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
        $(document).on('click',".user-edit-btn",function (e) {
            e.preventDefault();
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            });

            const UserID = $(this).attr('data-id');

            $.ajax({
                type:"GET",
                url:'/users/'+UserID + "/edit",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    $("#edit-user-modal").data('id',data.user.id);
                    $(".user-name").val(data.user.name);
                    $(".user-email").val(data.user.email);
                    $(".user-role").val(data.user.role.id);
                    $('#edit-user-modal').modal({
                        show: 'true',
                        keyboard: false
                    });

                },
                error: function(data){

                }
            });
        });

        $("#edit-user-form").on('submit',function(e){
            var UserID = $("#edit-user-modal").data('id');
            e.preventDefault();
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            });

            $.ajax({
                type:"PUT",
                url:'/users/'+UserID,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    if(data){

                        $('#edit-user-modal').modal('hide');

                        $.gritter.add({
                            title: 'Success',
                            text: 'User was updated successfuly',
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