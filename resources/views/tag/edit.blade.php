@extends('layout.app')
@section("content")

    <div class="page-head">
        <h2 class="page-head-title">Edit Tag</h2>
    </div>
    <div class="main-content container-fluid">
        <!--Basic forms-->
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-heading panel-heading-divider">Tag<span class="panel-subtitle">Edit Tag</span></div>
                    <div class="panel-body">
                        <form method="post" action="{{route("tags.update",$tag->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group xs-pt-10">
                                <label>Title</label>
                                <input type="text" name="title" value="{{$tag->title or ""}}" required placeholder="Enter tag title" class="form-control">
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
