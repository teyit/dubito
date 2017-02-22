@extends('layout.app')
@section("content")

        <div class="page-head">
            <h2 class="page-head-title">Categories</h2>
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">Category<span class="panel-subtitle">Add Category</span></div>
                        <div class="panel-body">
                            <form method="post" action="{{route("categories.store")}}">
                                {{ csrf_field() }}
                                <div class="form-group xs-pt-10">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{isset($category) ? $category->title : ""}}" required placeholder="Enter category title" class="form-control">
                                </div>
                                <div class="form-group xs-pt-10">
                                    <button type="submit" class="btn btn-space btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection