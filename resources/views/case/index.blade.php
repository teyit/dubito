@extends('layout.app')
@section('content')
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    Case List &nbsp;
                    <button  data-toggle="modal"  data-target="#add-new-case" class="btn btn-success">Add Case</button>
                </div>
                <div class="panel-body">
                    <table id="case-datatable" class="table case-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>

                                <th style="width:220px;">Title</th>
                                <th class="filterable">User</th>
                                <th class="filterable">Status</th>
                                
                                <th class="filterable">Category</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Is published</th>
                                <th style="width:160px;" class="actions"></th>
                                {{--<th class="actions">Delete</th>--}}
                            </tr>
                        </thead>

                        <tfoot>
                        <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th >User</th>
                        <th >Status</th>    
                        <th >Category</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Is published</th>
                        <th class="actions"></th>
                        </tr>
                        </tfoot>

                        <tbody>

                        @foreach($cases as $case)

                            <tr>
                                <td>{{$case->id}}</td>
                                <td>
                                    <a target="_blank" href="{{route('cases.show',$case->id)}}">{{$case->title}}</a>

                                </td>
                                <td>
                                    @if($case->user)
                                    <a data-title="Assign user" data-value="{{$case->user->id}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-user-editable case-user_id-{{$case->user->id}}">{{$case->user->name}}</a>
                                    @else
                                        <a data-title="Assign user" data-value="" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-user-editable case-user_id">Assign user</a>
                                @endif
                                <td>
                                    <a data-title="Select status" data-value="{{$case->status}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-status-editable case-status-{{$case->status}}">{{$case->statusLabels[$case->status] or ""}}</a>
                                </td>

                                <td>{{$case->category->title or ""}}</td>
                                <td>{{$case->created_at}}</td>
                                <td>{{$case->updated_at}}</td>
                                <td>
                                    <a data-title="Is published" data-value="{{$case->is_published}}" data-pk="{{$case->id}}"  data-type="select" href="#" class="editable editable-click case-published-editable case-published-{{$case->is_published}}">
                                        @if($case->is_published == 1) Yes @else No @endif</td>
                                    </a>

                                {{--<td class="actions"><a class="case-edit-btn" data-id="{{$case->id}}" href="javascript:;" class="icon"><i class="mdi mdi-edit"></i></a></td>--}}
                                <td class="actions">
                                    <div class="btn-group btn-space">
                                        <a href="{{route('cases.show',$case->id)}}" class="btn btn-default">{{$case->reports->count()}} Reports</a>
                                        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a class="case-edit-btn" href="javascript:;" data-id="{{$case->id}}" >Edit</a></li>
                                            <li><a class="case-delete" data-id="{{$case->id}}" href="javascript:;">Delete</a></li>
                                            <li class="divider"></li>
                                            @foreach($case->folderLabels as $key => $val)
                                            <li><a data-id="{{$key}}" href="{{route("case.folder.update",$case->id)}}?folder={{$key}}">Send to {{$val}}</a></li>
                                            @endforeach
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
<script>
    var caseStatusLabels = {!! json_encode($statusLabels) !!};
    var users = {!! json_encode($users) !!};
</script>
@include('case.partials.create_modal')
@include('case.partials.edit_modal')
@endsection
@section('script')
    @parent
    <script>
        $(function(){
            $(window).on('case-created',function (data) {
                window.location.reload();
            });
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