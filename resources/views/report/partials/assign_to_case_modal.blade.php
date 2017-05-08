<div id="report-assign-to-case" tabindex="-1" role="dialog" style="" class="modal fade colored-header colored-header-primary in" style="z-index:999991 !important;">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Assign to Case</h3>

            </div>
            <div class="modal-body">

                <form method="post" action="" id="report-assign-case-form">
                    {{ csrf_field() }}
                    <div class="form-group ">
                        <label for="case_id">Cases</label>
                        <select class="form-control report-cases" name="case_id" id="case_id">
                            <option value="">Select Case</option>
                        </select>
                    </div>
                    <div class="form-group pull-left">
                        <p class="text-success success-message" style="display: none;">Report has been created.</p>
                    </div>
                    <div class="form-group pull-right">
                        <button type="button" data-toggle="modal" data-target="#add-new-case" class="btn btn-space btn-success add-new-case">Add New Case</button>
                        <button type="submit" class="btn btn-space btn-primary">Assign</button>
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

        $(".add-new-case").on('click',function(){
            $('#report-assign-to-case').modal('hide');
        });

        $(".email-list-item").hover(function () {
            $(".view-case-btn-container ",this).removeClass('hidden')
        },function(){
            $(".view-case-btn-container ",this).addClass('hidden');
        });
        $(function(){

            $(document).on('click',".report-assign-case",function () {
                var message_list = $('.email-list-item .be-checkbox input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();

                if(message_list.length < 1){
                    return false;
                }

                var $reportCases = $(".report-cases");
                $.get("/api/cases", function(data){
                    $reportCases.find('option').remove();
                    $.each(data, function(index, cases) {
                        $reportCases.append('<option value="' + cases.id + '">' + cases.title + '</option>');
                    });
                });

                $('#report-assign-to-case').modal({
                    show: 'true',
                    keyboard: false
                });


                $("#report-assign-case-form").on('submit',function(e){
                    $('#report-assign-to-case').modal('hide');
                    var case_id = $("#case_id").val();
                    e.preventDefault();
                    $.ajax({
                        url: "/reports/",
                        data: {
                            _token:$("#_token").val(),
                            case_id : case_id,
                            selected_messages : message_list
                        },
                        method : "POST",
                        success: function(result){
                            if(result){

                                $.each(message_list,function(index,message_id){
                                    $('#checkbox-label-'+message_id).addClass('hidden');
                                });
                                
                                $.gritter.add({
                                    title: 'Success',
                                    text: 'This message was assigned as report successfuly',
                                    class_name: 'color success'
                                });
                            }
                        }
                    });

                });

            });

        });

        $('#report-assign-to-case').on('hidden.bs.modal', function () {
            $(".success-message").hide();
        });

    </script>
@endsection