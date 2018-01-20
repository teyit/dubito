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