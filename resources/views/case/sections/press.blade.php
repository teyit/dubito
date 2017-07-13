<div class="panel panel-default panel-table" id="press-datatable">
    <div class="panel panel-default">
        <div class="panel-heading">
            Press results
            <div class="tools">
                <form id="press-list" class="form-inline form-group">
                    <input name="text" type="text" value="{{$case->title}}" class="input-xs form-control">
                    <input type="text" placeholder="" name="daterange"  class="input-xs form-control daterange">
                    <button type="button" class="btn btn-primary"><i style="color:white;" class="icon icon-left mdi mdi-refresh-alt"></i></button>
                </form>
            </div>
        </div>
        <div id="press-results">

        </div>
    </div>
</div>

@section('script')
@parent
<script src="/assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
<script src="/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/assets/lib/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $(".daterange").daterangepicker()
        $("#press-list").on('click', function () {
            var values = $(this).serialize();
            $.ajax({
                method:"get",
                url:"/cases/press",
                data:values,
                success:function(response){

                    $("#press-results").html(response);

                }
            });
        });
    })
</script>
@endsection