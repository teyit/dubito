<div class="link-styled card">
    <a target="_blank" href="http://teyit.link/{{$l->teyitlink_slug}}">
        <div class="card-img-top" style="background-image:url('{{$l->image}}')"></div>
        <div class="card-block">
            <h4 class="card-title">{{$l->meta_title}}</h4>
            <p class="card-text">{{$l->meta_description}}</p>
            <h6 class="card-subtitle mb-2 text-muted text-right">{{parse_url($l->link,PHP_URL_HOST)}}</h6>
        </div>
    </a>
    @if($l->archiveis_link)
        <a target="_blank" href="http://archive.is/{{$l->archiveis_link}}" class="btn btn-default"><span class="mdi mdi-bookmark"></span> archive.is</a>
    @endif
    <a target="_blank" href="{{$l->link}}" class="btn btn-default"><span class="mdi mdi-globe-alt"></span> Original</a>

</div>