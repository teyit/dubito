@extends("layout.app")
@section("content")

    <div class="main-content container-fluid">

        <!--Report-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">Report<span class="panel-subtitle">Add Report</span></div>
                    <div class="panel-body">
                    @include("report.partials._form")
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("case.partials.create_modal")
    @include("report.partials._category_modal_form")
@stop
@section('script')
    @parent
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
        });
    </script>
@stop
