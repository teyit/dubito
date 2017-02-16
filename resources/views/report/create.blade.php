@extends("layout.app")
@section("content")

    <div class="main-content container-fluid">

        <!--Report-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">Report<span class="panel-subtitle">Add Report</span></div>
                    <div class="panel-body">
                    @include("report._form")
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection