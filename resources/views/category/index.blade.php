@extends('layout.app')
@section('content')
<div class="main-content container-fluid">

        <div class="panel panel-default panel-table">

            <div class="panel-heading">Category List &nbsp; <button  data-toggle="modal"  data-target="#category-create" class="btn btn-success">Add Category</button>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Case Count</th>
                        <th>Created At</th>
                        <th class="actions">Edit</th>
                        <th class="actions">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->title}}</td>
                            <td>{{$category->cases->count()}}</td>
                            <td>{{$category->created_at}}</td>
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
@endsection

@include('category.partials.create_modal')
@include('category.partials.edit_modal')