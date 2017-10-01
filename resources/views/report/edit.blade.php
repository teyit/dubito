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

    <script>

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

    </script>

@endsection