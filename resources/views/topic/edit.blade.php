@extends('layout.app')
@section("content")

        <div class="page-head">
            <h2 class="page-head-title">Edit Topic</h2>
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Topic<span class="panel-subtitle">Edit Topic</span></div>
                        <div class="panel-body">
                            <form method="post" action="{{route("topics.update",$topic->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group xs-pt-10">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{isset($topic) ? $topic->title : ""}}" required placeholder="Enter topic title" class="form-control">
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
