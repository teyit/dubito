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
                        <th>ID</th>
                        <th>Title</th>
                        <th>Case Count</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="actions"></th>
                        <!--<th class="actions">Delete</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->title}}</td>
                            <td>{{$category->cases->count()}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>{{$category->updated_at}}</td>
                            <td class="actions">
                                <div class="btn-group btn-space">
                                    <button type="button" class="btn btn-default">View Reports</button>
                                    <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a class="category-edit-btn" href="javascript:;" data-id="{{$category->id}}" >Edit</a></li>
                                        <li><a class="category-delete" data-id="{{$category->id}}" href="javascript:;">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <!--<td class="actions">
                                <form method="post" action="{{route("categories.destroy",$category->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>
                                </form>
                            </td>-->
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



@section('script')

    <script>

        $(function(){
            $('.category-delete').on('click',function(){
                if(!confirm('Are you sure that want to delete ? ')){
                    return false;
                }
                var id =  $(this).data('id');
                $.ajax({
                    method:"DELETE",
                    url:"/categories/"+id,
                    data:{_token:$("#_token").val()},
                    success:function(data){
                        if(data == 'true'){
                            window.location.reload();
                        }else if(data = 'is_case'){
                            alert('There are cases belongs to this category therefore it cannot be delete ');
                        }
                    }
                })
            });
        });
    </script>
@endsection