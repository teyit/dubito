<div id="fill-with-template"  role="dialog" style="" class="modal fade colored-header colored-header-primary in" style="z-index:999991 !important;">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Choose a Template</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="fill-with-template-form">
                    {{ csrf_field() }}
                    <div class="form-group ">
                        <label for="template_id">Templates</label>
                        <input class="autocomplete-templates" name="template_text" id="template_text" />
                    </div>
                    <div class="form-group pull-left">
                    <button id="btn-delete-template" class="btn btn-space btn-danger">Delete</button>

                        <p class="text-success success-message" style="display: none;">Report has been created.</p>
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" id="btn-choose-template" class="btn btn-space btn-primary">Use Template</button>
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
        $("#fill-with-template-form").on('submit',function(e) {
            e.preventDefault();

        });
        $("#btn-choose-template").on('click',function(){
          //  e.preventDefault();
            $(window).trigger('template-choose',$("#template_text").val());
            $('#fill-with-template').modal('hide');

        });
        $("#btn-delete-template").on('click',function(){
            console.log($("#template_text").val())
            $.ajax({
                url: "/api/messageTemplates/",
                data: {
                    _token:$("#_token").val(),
                    text :$("#template_text").val()
                },
                method : "DELETE",
                success: function(result){
                    if(result){

                        $.gritter.add({
                            title: 'Success',
                            text: 'Template Deleted!',
                            class_name: 'color success'
                        });
                    }
                },
                error: function(){

                        $.gritter.add({
                            title: 'Error',
                            text: 'An error occured',
                            class_name: 'color warning'
                        });
                }
            });
            
        });
        $('#report-assign-to-case').on('hidden.bs.modal', function () {
            $(".success-message").hide();
        });

    </script>
@endsection