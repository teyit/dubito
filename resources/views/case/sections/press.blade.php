<div class="panel panel-default panel-table" id="press-datatable">
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
            Press results
            <div class="tools">
                <form id="press-list" class="form-inline form-group">
                    <input name="text" type="text" value="{{$case->title}}" class="input-xs form-control">
                    <input type="text" placeholder="" name="daterange"  class="input-xs form-control daterange">
                    <button id="getPress" type="button" class="btn btn-primary"><i style="color:white;" class="icon icon-left mdi mdi-refresh-alt"></i></button>
                </form>
            </div>
        </div>
        <div style="max-height: 400px;overflow: scroll;width: 100%;"  id="press-results"></div>
    </div>
</div>

@section('script')
@parent
<script src="/assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
<script src="/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/assets/lib/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>
<script>
    var pressResults = function(){
        $("#press-results").html('');
        var values = $("#press-list").serialize();
        $.ajax({
            method:"get",
            url:"/cases/{{$case->id}}/press",
            data:values,
            success:function(response){
                $("#press-results").html(response);
            }
        });
    };

    $(document).ready(function(){
        var start = moment().subtract(29, 'days');
        var end = moment();

        $(".daterange").daterangepicker({
            startDate: start,
            endDate: end
        });
        $("#getPress").on('click', function () {
            pressResults();
        });
        $(document).on('click',".press-item", function () {
            var id = $(this).data('id');
            $.ajax({
                method:"get",
                url:"/cases/{{$case->id}}/press_review",
                data:$(this).data(),
                success:function(response){
                    $("#press-line-" +id).fadeOut();
                }
            });
        });
        pressResults();
    })
</script>
@endsection