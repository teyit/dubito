@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        Review List &nbsp;
                    </div>
                    <div class="panel-body">
                        <table class="table" id="review-datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Account Name</th>
                                <th>Text</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{$review->id}}</td>
                                    <td>{{$review->account_name}}</td>
                                    <td>{{$review->text}}</td>
                                    <td>{{$review->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection
