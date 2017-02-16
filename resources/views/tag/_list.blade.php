<table class="table">
    <thead>
    <tr>
        <th>Title</th>
        <th class="actions"></th>
        <th class="actions"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
        <tr>
            <td>{{$tag->title}}</td>
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