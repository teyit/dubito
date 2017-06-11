@foreach($senders as $s)
    <li class="itmitm sender-item-{{$s->sender_id}}">
        <a class="spf-link" href="{{route('messages.show',$s->sender_id)}}?source={{$s->source}}">
            @if($s->unreads > 0)
                <span class="thread-count label label-primary">{{$s->unreads}}</span>
            @endif
            <div class="thread-avatar" style="background-image:url('{{$s->account_picture}}');"></div>
            <span class="thread-name">
                {{$s->account_name}}
            </span>
        </a>
    </li>
@endforeach