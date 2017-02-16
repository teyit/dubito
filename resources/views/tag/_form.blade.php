
@if($type == 'create')
<form method="post" action="{{route("tags.store")}}">
    {{ csrf_field() }}
    <div class="form-group xs-pt-10">
        <label>Title</label>
        <input type="text" name="title" value="{{$tag->title or ""}}" required placeholder="Enter category title" class="form-control">
    </div>
    <div class="form-group xs-pt-10">
        <button type="submit" class="btn btn-space btn-primary">Add</button>
    </div>
</form>

@else
    <form method="post" action="{{route("tags.update",$tag->id)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group xs-pt-10">
            <label>Title</label>
            <input type="text" name="title" value="{{$tag->title or ""}}" required placeholder="Enter category title" class="form-control">
        </div>
        <div class="form-group xs-pt-10">
            <button type="submit" class="btn btn-space btn-primary">Edit</button>
        </div>
    </form>
@endif