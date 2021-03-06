@extends("layout.app")
@section("content")

    <div class="main-content container-fluid">
        <!--Report-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">Report<span class="panel-subtitle">Edit Report</span></div>
                    <div class="panel-body">
                        @include("report.partials._form")
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@include("case.partials.create_modal")
@include("report.partials._category_modal_form")

@section('script')
    <script src="/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            $(".datetimepicker").datetimepicker({
                autoclose:!0,
                componentIcon:".mdi.mdi-calendar",
                navIcons:{
                    rightIcon:"mdi mdi-chevron-right",
                    leftIcon:"mdi mdi-chevron-left"
                }
            });

        $('.remove-file-from-report').on('click',function(){
            var file_id =  $(this).data('file-id');
            $.ajax({
                method:"post",
                url:"{{route("report.file.remove",$report->id)}}",
                data:{_token:$("#_token").val(),file_id:file_id},
                success:function(response){
                    if(response){
                        $.gritter.add({
                            title: 'Success',
                            text: 'Image  was removed succesfully',
                            class_name: 'color success'
                        });

                        window.location.reload();
                    }
                }

            });
        });
        });
        $(window).on('case-created', function (dat,data) {
                console.log("choose:")
              //  $(".rep-cases option:selected").removeAttr('selected');
              //  $(".rep-cases").append('<option selected value="'+data.id+'">'+data.title+'</option>');
                console.log("choose:",data)

                var newOption = new Option(data.title, data.id, false, false);
                $('#rep-cases').append(newOption).trigger('change');
                $('#rep-cases').val(data.id); // Select the option with a value of '1'
                $('#rep-cases').trigger('change'); // Notify any JS components that the value changed
                });
    </script>

@endsection