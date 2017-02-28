@extends('layout.app')
@section('content')
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-sm-12">
			<div class="panel panel-default panel-table">
			    <div class="panel-heading">
			        Tag List &nbsp; 
			        <button  data-toggle="modal"  data-target="#tag-create" class="btn btn-success">Add Tag</button>
			    </div>
			    <div class="panel-body">
			        <table class="table">
			            <thead>
			                <tr>
			                    <th>Title</th>
			                    <th>Created At</th>
			                    <th>Updated At</th>
			                    <th class="actions"></th>
			                </tr>
			            </thead>
			            <tbody>
			            @foreach($tags as $tag)
			                <tr>
			                    <td>{{$tag->title}}</td>
			                    <td>{{$tag->created_at}}</td>
			                    <td>{{$tag->updated_at}}</td>
			                    <td class="actions">
			                        <a href="javascript:;" data-id="{{$tag->id}}" class="icon tag-edit-btn"><i class="mdi mdi-edit"></i></a>
			                    </td>
			                    <td class="actions">
			                        <div class="btn-group btn-space">
			                            <button type="button" class="btn btn-default">View Reports</button>
			                            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><span class="mdi mdi-chevron-down"></span><span class="sr-only">Toggle Dropdown</span>&nbsp;</button>
			                            <ul role="menu" class="dropdown-menu">
			                                <li><a class="tag-edit-btn" href="javascript:;" data-id="{{$tag->id}}" >Edit</a></li>
			                                <li><a class="tag-delete" data-id="{{$tag->id}}" href="javascript:;">Delete</a></li>
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
@include('tag.partials.create_modal')
@include('tag.partials.edit_modal')
@endsection
@section('script')
<script>
    $(function(){
        $('.tag-delete').on('click',function(){
            if(!confirm('Are you sure that want to delete ? ')){
                return false;
            }
            var id =  $(this).data('id');
            $.ajax({
                method:"DELETE",
                url:"/tags/"+id,
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
