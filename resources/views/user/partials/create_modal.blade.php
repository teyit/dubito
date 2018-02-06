<div id="add-new-user" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary in" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Case</h3>

            </div>
            <div class="modal-body">

                <form action="" method="post" id="user-form-ajax">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" required name="name" id="user-name" placeholder="Enter user name.." class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Select Role</label>
                        <select name="role_id" required class="form-control">
                            <option value="">Select</option>
                            <option value="1">Admin</option>
                            <option value="2">Writer</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="email" required name="email" id="user-email" placeholder="Enter user email" class="form-control">
                    </div>


                    <div class="form-group">
                        <input type="text" required name="password" id="user-password" placeholder="Enter user password" class="form-control">
                    </div>


                    <div class="success-message" style="display: none;"></div>

                    <div class="form-group">
                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button>
                        <button  type="submit"  class="btn btn-space btn-primary add-case">Add User</button>
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
        $("#user-form-ajax").on('submit',function(e){
            e.preventDefault();
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            });

            $.ajax({
                type:"POST",
                url:'/users/',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    if(data){

                        $('#add-new-user').modal('hide');


                        $.gritter.add({
                            title: 'Success',
                            text: 'User was added successfuly',
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