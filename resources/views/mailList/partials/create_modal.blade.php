<div id="add-new-mailList" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary in" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Add New Recipient</h3>

            </div>
            <div class="modal-body">

                <form action="" method="post" id="mailList-form-ajax">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" required name="name" id="mailList-name" placeholder="Enter name.." class="form-control">
                    </div>


                    <div class="form-group">
                        <input type="email" required name="email" id="mailList-email" placeholder="Enter email" class="form-control">
                    </div>


                    <div class="success-message" style="display: none;"></div>

                    <div class="form-group">
                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button>
                        <button  type="submit"  class="btn btn-space btn-primary add-case">Add Recipient</button>
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
        $("#mailList-form-ajax").on('submit',function(e){
            e.preventDefault();
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            });

            $.ajax({
                type:"POST",
                url:'/mailList/',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    if(data){

                        $('#add-new-mailList').modal('hide');


                        $.gritter.add({
                            title: 'Success',
                            text: 'mailList was added successfuly',
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