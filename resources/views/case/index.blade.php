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
                    <table id="table1" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
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
                                <td>
                                    @if($case->status == 'completed')
                                        <span class="label label-success">Completed</span>
                                    @elseif($case->status == 'in_progress')
                                        <span class="label label-warning">In Progress</span>
                                    @elseif($case->status == 'no_analysis')
                                        <span class="label label-no-analysis">No Analysis</span>
                                    @elseif($case->status == 'cancelled')
                                        <span class="label label-danger">Cancelled</span>
                                    @elseif($case->status == 'suspended')
                                        <span class="label label-suspended">Suspended</span>
                                    @elseif($case->status == 'to_be_tweeted')
                                        <span class="label label-primary">To be Tweeted</span>
                                    @endif

                                </td>
                                <td>{{$case->created_at}}</td>
                                <td>{{$case->updated_at}}</td>
                                {{--<td class="actions"><a class="case-edit-btn" data-id="{{$case->id}}" href="javascript:;" class="icon"><i class="mdi mdi-edit"></i></a></td>--}}
                                <td class="actions">
                                    <div class="btn-group btn-space">
                                        <a href="{{route('cases.show',$case->id)}}" class="btn btn-default">View Reports</a>
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
                var that = $(this);
                dubitoConfirm(function(result){
                    if(result == true) {
                        var id = that.data('id');
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
                    }
                    });
            });
        });
    </script>
@endsection