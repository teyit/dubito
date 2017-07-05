<div class="link-styled card">
    <a target="_blank" href="http://teyit.link/{{$l->teyitlink_slug}}">
        <div class="card-img-top" style="background-image:url('{{$l->image}}')"></div>
        <div class="card-block">
            <h4 class="card-title">{{$l->meta_title}}</h4>
            <p class="card-text">{{$l->meta_description}}</p>
            <h6 class="card-subtitle mb-2 text-muted text-right">{{parse_url($l->link,PHP_URL_HOST)}}</h6>
        </div>
    </a>
</div>