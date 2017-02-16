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
                <div class="col-sm-6">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Category List
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th class="actions"></th>
                                    <th class="actions"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->title}}</td>
                                    <td class="actions"><a href="{{route("categories.edit",$category->id)}}" class="icon"><i class="mdi mdi-edit"></i></a></td>
                                    <td class="actions">
                                        <form method="post" action="{{route("categories.destroy",$category->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                           <button class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                    </td>
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