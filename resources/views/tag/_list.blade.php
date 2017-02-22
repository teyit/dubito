<div class="panel panel-default panel-table">

    <div class="panel-heading">Tag List &nbsp; <button  data-toggle="modal"  data-target="#tag-create" class="btn btn-success">Add Tag</button>
    </div>

    <table class="table">
    <thead>
    <tr>
        <th>Title</th>
        <th>Created At</th>
        <th class="actions">Edit</th>
        <th class="actions">Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
        <tr>
            <td>{{$tag->title}}</td>
            <td>{{$tag->created_at}}</td>
            <td class="actions"><a href="{{route("tags.edit",$tag->id)}}" class="icon"><i class="mdi mdi-edit"></i></a></td>
            <td class="actions">
                <form method="post" action="{{route("tags.destroy",$tag->id)}}">
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

@include('tag.partials.create_modal')