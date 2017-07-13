<div class="panel panel-default panel-table" id="press-datatable">
    <div class="panel panel-default">
        <div class="panel-heading">
            Press results
            <div class="tools">
                <div class="form-inline form-group">
                    <input type="text" value="{{$case->title}}" class="input-xs form-control">
                    <input type="text" placeholder="" name="daterange"  class="input-xs form-control daterange">
                    <button class="btn btn-primary"><i style="color:white;" class="icon icon-left mdi mdi-refresh-alt"></i></button>

                </div>
            </div>
        </div>
        <table class="table table-condensed table-striped">
            <thead>
            <tr>
                <th style="width:440px;">Title</th>
                <th>Source</th>
                <th>Score</th>
                <th style="width:160px;">Created at</th>
                <th style="width:120px;" class="actions"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($case->press() as $p)
                <tr>
                    <td>{{$p['title']}}</td>
                    <td>{{parse_url($p['url'],PHP_URL_HOST)}}</td>
                    <td>{{$p['score']}}</td>
                    <td>{{date("d-m-Y  H:i",strtotime($p['date']))}}</td>
                    <td>
                        <div class="btn-group btn-space">
                            <button type="button" class="btn  btn-default">
                                <i class="icon mdi mdi-check"></i>
                            </button>
                            <button type="button" class="btn  btn-default">
                                <i class="icon mdi mdi-close"></i>
                            </button>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
    })
</script>
@endsection