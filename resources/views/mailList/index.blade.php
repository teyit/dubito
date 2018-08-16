@extends('layout.app')
@section('content')
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        Mail Notification List &nbsp;
                        <button  data-toggle="modal"  data-target="#add-new-mailList" class="btn btn-success">Add Recipient</button>
                    </div>
                    <div class="panel-body">
                        <table id="mailList-datatable" class="table mailList-datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th >Email</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th class="actions"></th>
                            </tr>
                            </tfoot>

                            <tbody>
                            @if(!$users->isEmpty())
                            @foreach($users as $mailList)

                                <tr>
                                    <td>{{$mailList->id}}</td>
                                    <td>{{$mailList->name}}</td>
                                    <td>{{$mailList->email}}</td>
                                    <td>{{$mailList->created_at}}</td>
                                    <td>{{$mailList->updated_at}}</td>

                                        <td class="actions">
                                            <div class="btn-group btn-space">
                                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a class="mailList-edit-btn" href="javascript:;" data-id="{{$mailList->id}}" >Edit</a></li>
                                                    <li><a class="mailList-delete" data-id="{{$mailList->id}}" href="javascript:;">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                </tr>
                            @endforeach
                            @endif 

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('mailList.partials.create_modal')
    @include('mailList.partials.edit_modal')
@endsection
@section('script')
    @parent
    <script>
        $(function(){
            $('.mailList-delete').on('click',function(){
                var that = $(this);
                dubitoConfirm(function(result){
                    if(result == true) {
                        var id = that.data('id');
                        $.ajax({
                            method:"DELETE",
                            url:"/mailList/"+id,
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

    


    </script>
@endsection