@foreach($senders as $s)
    <li class="itmitm sender-item-{{$s->sender_id}}">
        <a class="spf-link" href="/messages/{{$s->sender_id}}">
            @if($s->unreads > 0)
                <span class="thread-count label label-primary">{{$s->unreads}}</span>
            @endif
            <div class="thread-avatar" style="background-image:url('{{$s->account_picture}}');"></div>
            <span class="thread-name">{{$s->account_name}}</span>
        </a>
    </li>
@endforeach