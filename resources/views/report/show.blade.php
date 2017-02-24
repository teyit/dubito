@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">

        <div class="panel panel-default panel-table">

            <div class="page-head">
                <h2 class="page-head-title">Report Detail</h2>
            </div>

            <div class="panel-body">
                <table class="table table-condensed table-striped">
                   <tr>
                       <td><b>Title</b></td>
                       <td>{{$report->title}}</td>
                   </tr>
                    <tr>
                        <td><b>Case</b></td>
                        <td>{{$report->cases->title}}</td>
                    </tr>

                    <tr>
                        <td><b>Source</b></td>
                        <td>{{$report->source}}</td>
                    </tr>

                    <tr>
                        <td><b>Created at</b></td>
                        <td>{{$report->created_at}}</td>
                    </tr>

                </table>
            </div>

            <br><br>


    @include('report.partials._report_files',['reportfiles' => $report->reportfiles])

        </div>


@endsection