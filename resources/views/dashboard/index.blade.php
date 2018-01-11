@extends("layout.app")
@section("content")
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <iframe src="https://reports.teyit.link/public/dashboard/36b92a0d-75b3-468d-8578-ef364b4e2b0e" frameborder="0" width="100%" height="800" callowtransparency></iframe>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span>
                    </div><span class="title">Report/Resource</span><span class="panel-subtitle">Report is count according to channels</span>
                </div>
                <div class="panel-body">
                    <canvas id="pie-chart"></canvas>
                    <input type="hidden"
                           data-report-source-name="{{implode(",", array_pluck($reportCountbySource,'source'))}}"
                           data-report-source-total="{{implode(',',array_pluck($reportCountbySource,'total'))}}"
                           id="report-source-h" />
                </div>
        </div>
    </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span>
                            <span class="icon mdi mdi-close"></span></div><span class="title">Report/Topic</span><span class="panel-subtitle">This is report count according to topc</span>
                </div>
                <div class="panel-body">
                    <canvas id="bar-chart"></canvas>

                    <input type="hidden"
                           data-report-topic-name="{{implode(",", array_pluck($reportTopicCount,'title'))}}"
                           data-report-topic-total="{{implode(',',array_pluck($reportTopicCount,'total'))}}"
                           id="report-topic-h" />
                </div>
            </div>
        </div>


    </div>

</div>
@endsection


@section('script')
    <script src="{{url("assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js")}}" type="text/javascript"></script>
    <script src="{{url("assets/lib/chartjs/Chart.min.js")}}" type="text/javascript"></script>
    <script src="{{url("assets/js/app-charts-chartjs.js")}}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){

            //App.ChartJs();
        });

    </script>

@endsection