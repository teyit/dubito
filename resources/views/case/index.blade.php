@extends('layout.app')
@section('content')
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    Case List &nbsp;
                    <button  data-toggle="modal"  data-target="#case-create" class="btn btn-success">Add Case</button>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Category</th>
                                <th>Created at</th>
                                <th class="actions"></th>
                                {{--<th class="actions">Delete</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cases as $case)
                            <tr>
                                <td>{{$case->id}}</td>
                                <td>{{$case->title}}</td>
                                <td>{{$case->topic->title}}</td>
                                <td>{{$case->category->title or ""}}</td>
                                <td>{{$case->created_at}}</td>
                                {{--<td class="actions"><a class="case-edit-btn" data-id="{{$case->id}}" href="javascript:;" class="icon"><i class="mdi mdi-edit"></i></a></td>--}}
                                <td class="actions">
                                    <div class="btn-group btn-space">
                                        <button type="button" class="btn btn-default">View Reports</button>
                                        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a class="case-edit-btn" href="javascript:;" data-id="{{$case->id}}" >Edit</a></li>
                                            <li><a class="case-delete" data-id="{{$case->id}}" href="javascript:;">Delete</a></li>
                                        </ul>
                                    </div>
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
@include('case.partials.create_modal')
@include('case.partials.edit_modal')
@endsection
@section('script')
    <script>
        $(function(){
            $('.case-delete').on('click',function(){
                if(!confirm('Are you sure that want to delete ? ')){
                    return false;
                }
                var id =  $(this).data('id');
                $.ajax({
                    method:"DELETE",
                    url:"/cases/"+id,
                    data:{_token:$("#_token").val()},
                    success:function(data){
                        if(data == 'true'){
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection