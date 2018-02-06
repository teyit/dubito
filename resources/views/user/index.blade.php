@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        User List &nbsp;
                        <button  data-toggle="modal"  data-target="#add-new-user" class="btn btn-success">Add User</button>
                    </div>
                    <div class="panel-body">
                        <table id="user-datatable" class="table user-datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th >Email</th>
                                <th >Role</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th >Email</th>
                                <th >Role</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th class="actions"></th>
                            </tr>
                            </tfoot>

                            <tbody>

                            @foreach($users as $user)

                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->role)
                                            <a data-title="Assign user" data-value="{{$user->role->id}}" data-pk="{{$user->id}}"  data-type="select" href="#" class="editable editable-click user-role-editable user-role_id-{{$user->role->id}}">{{$user->role->name}}</a>
                                        @else
                                            <a data-title="Assign user" data-value="" data-pk="{{$user->id}}"  data-type="select" href="#" class="editable editable-click user-role-editable user-role_id">Assign Role</a>
                                    @endif
                                    </td>

                                    <td>
                                        @if($user->status != "")
                                            <a data-title="Assign status" data-value="{{$user->status}}" data-pk="{{$user->id}}"  data-type="select" href="#" class="editable editable-click user-status-editable user-status-{{$user->status }}">{{$user->status}}</a>
                                        @else
                                            <a data-title="Assign status" data-value="" data-pk="{{$user->id}}"  data-type="select" href="#" class="editable editable-click user-status-editable user-status">Assign Status</a>
                                        @endif
                                    </td>

                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>

                                        <td class="actions">
                                            <div class="btn-group btn-space">
                                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a class="user-edit-btn" href="javascript:;" data-id="{{$user->id}}" >Edit</a></li>
                                                    <li><a class="user-delete" data-id="{{$user->id}}" href="javascript:;">Delete</a></li>
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
    @include('user.partials.create_modal')
    @include('user.partials.edit_modal')
@endsection
@section('script')
    @parent
    <script>
        $(function(){
            $('.user-delete').on('click',function(){
                var that = $(this);
                dubitoConfirm(function(result){
                    if(result == true) {
                        var id = that.data('id');
                        $.ajax({
                            method:"DELETE",
                            url:"/users/"+id,
                            data:{_token:$("#_token").val()},
                            success:function(data){
                                if(data ){
                                    window.location.reload();
                                }
                            }
                        })
                    }
                });
            });
        });

        getRoles(function (result) {
            $('.user-role-editable').editable({
                type: 'select',
                title: 'Select status',
                url: "{{url("/assignRoleToUser/$user->id")}}",
                pk: 1,
                source: result,
                success: function (response, value) {
                    console.log(response);
                    if (response) {

                        $.gritter.add({
                            title: 'Success',
                            text: 'Role was assigned to user successfuly',
                            class_name: 'color success'
                        });
                    }

                }
            });

        });

        const status = [
            {
                "value":"active",
                "text":"Active"
            },
            {   "value":"passive",
                "text":"Passive"
            }
        ];

        $('.user-status-editable').editable({
            type: 'select',
            title: 'Select status',
            url: "{{url("/assignStatusToUser/$user->id")}}",
            pk: 1,
            source: status,
            success: function (response, value) {
                console.log(response,value);
                if (response) {

                    $.gritter.add({
                        title: 'Success',
                        text: 'Status was assigned to user successfuly',
                        class_name: 'color success'
                    });
                }

            }
        });


    </script>
@endsection