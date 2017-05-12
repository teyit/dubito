@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-10">
                    <div class="panel-heading">
                        Review List &nbsp;
                    </div>
                    <div class="panel-body">
                        @foreach($reviews as $review)
                        <div class="panel panel-border-color panel-border-color-info review">

                            <div class="timeline-content">
                                <div class="timeline-avatar"><img src="{{$review->account_picture}}" alt="" class="circle"></div>

                                <div class="timeline-header">
                                    <!--<span class="timeline-time">4:34 PM</span>-->
                                    <div><p class="timeline-autor">{{$review->account_name}}</p></div>
                                    <p class="timeline-activity">
                                        {{$review->text}}
                                    </p>
                                </div>
                                <div class="timeline-gallery">
                                </div>
                            </div>

                            <div class="panel-footer clearfix">
                                {{$review->created_at->diffForHumans()}} / {{explode(":",$review->source)[0]}}
                                <div class="tools">
                                </div>

                            </div>
                       @endforeach

                        {{--<table class="table" id="review-datatable">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>ID</th>--}}
                                {{--<th>Account Name</th>--}}
                                {{--<th>Text</th>--}}
                                {{--<th>Created At</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($reviews as $review)--}}
                                {{--<tr>--}}
                                    {{--<td>{{$review->id}}</td>--}}
                                    {{--<td>{{$review->account_name}}</td>--}}
                                    {{--<td>{{$review->text}}</td>--}}
                                    {{--<td>{{$review->created_at}}</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

    <style>
        .review .timeline-content {
            padding: 12px 15px 12px 14px !important;
        }
        .review .panel-footer {
            padding: 10px 10px 5px;
        }
    </style>

@endsection
