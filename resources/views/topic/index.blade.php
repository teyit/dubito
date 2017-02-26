@extends('layout.app')
@section('content')
<div class="main-content container-fluid">

<div class="panel panel-default panel-table">
    <div class="panel-heading">Topic List &nbsp;  <button  data-toggle="modal"  data-target="#topic-create" class="btn btn-success">Add Topic</button>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Case Count</th>
                <th>Created At</th>
                <th class="actions"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td>{{$topic->id}}</td>
                    <td>{{$topic->title}}</td>
                    <td>{{$topic->cases->count()}}</td>
                    <td>{{$topic->created_at}}</td>
                    <td class="actions">
                        <div class="btn-group btn-space">
                            <button type="button" class="btn btn-default">View Reports</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a class="topic-edit-btn" href="javascript:;" data-id="{{$topic->id}}" >Edit</a></li>
                                <li><a class="topic-delete" data-id="{{$topic->id}}" href="javascript:;">Delete</a></li>
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
@endsection

@include('topic.partials.create_modal')
@include('topic.partials.edit_modal')


@section('script')

    <script>

        $(function(){
            $('.topic-delete').on('click',function(){
                if(!confirm('Are you sure that want to delete ? ')){
                    return false;
                }
                var id =  $(this).data('id');
                $.ajax({
                    method:"DELETE",
                    url:"/topics/"+id,
                    data:{_token:$("#_token").val()},
                    success:function(data){

                        console.log(data);
                        if(data == 'true'){
                            window.location.reload();
                        }else if(data == 'is_case'){
                            alert('this topic cannot be delete !');
                        }
                    }
                })
            });
        });
    </script>
@endsection