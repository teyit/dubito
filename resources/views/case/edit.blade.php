@extends('layout.app')
@section("content")

        <div class="page-head">
            <h2 class="page-head-title">Cases</h2>
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Case<span class="panel-subtitle">Edit Case</span></div>
                        <div class="panel-body">
                            <form method="post" action="{{route("cases.update",$case->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group xs-pt-10">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{isset($case) ? $case->title : ""}}" required placeholder="Enter case title" class="form-control">
                                </div>
                                <div class="form-group xs-pt-10">
                                    <label>Categories</label>
                                    <select class="form-control" name="category_id" id="">
                                        <option value="">Select Topic</option>
                                        @foreach($categories as $category)
                                            @if($category->id == $case->category_id)
                                            <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group xs-pt-10">
                                    <label>Select Topic</label>
                                    <select name="topic_id" class="form-control">
                                        @foreach($topics as $topic)
                                            @if($topic->id == $case->topic_id)
                                                <option value="{{$topic->id}}" selected>{{$topic->title}}</option>
                                            @else
                                                <option value="{{$topic->id}}">{{$topic->title}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group xs-pt-10">
                                    <button type="submit" class="btn btn-space btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection
