@extends("layout.app")
@section("content")
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="widget widget-tile">
                <div id="spark1" class="chart sparkline"></div>
                <div class="data-info">
                    <div class="desc">Messages</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="113" class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="widget widget-tile">
                <div id="spark2" class="chart sparkline"></div>
                <div class="data-info">
                    <div class="desc">Reports</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="80" data-suffix="%" class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="widget widget-tile">
                <div id="spark3" class="chart sparkline"></div>
                <div class="data-info">
                    <div class="desc">Cases</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="532" class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="widget widget-tile">
                <div id="spark4" class="chart sparkline"></div>
                <div class="data-info">
                    <div class="desc">Topic</div>
                    <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="113" class="number">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection