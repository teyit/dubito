@foreach($messages->reverse() as $message)
    <div id="message-item-{{$message->id}}" class="email-list-item email-list-item--unread @if($message->is_review) assigned-as-review @endif">
        @if($message->is_reply)
            <div class="email-list-actions email-list-item--unread">

            </div>
            <div class="email-list-detail">
                <span class="date pull-right"><i class="icon mdi mdi-attachment-alt"></i> {{\Carbon\Carbon::parse($message->created_at)->format("d.m.Y")}}</span>
                <p class="msg msg-styled our-message">
                    <span>{{$message->text}}</span>
                </p>
            </div>
        @else
            <div class="email-list-actions email-list-item--unread">
                @if($message->report_id)
                    <a target="_blank" href="{{route('cases.show',$message->report->case_id)}}" class="marked-btn case-btn btn-xl">
                        <span class="mdi mdi-open-in-new"></span>
                    </a>
                @elseif($message->is_review)
                    <a target="_blank" href="javascript:;" class="marked-btn review-btn btn-xl">
                        <span class="mdi mdi-star-outline"></span>
                    </a>
                @else
                    <a target="_blank" href="javascript:;" class="btn-xl hidden marked-btn">
                        <span class="mdi"></span>
                    </a>
                @endif
                <div class="be-checkbox @if($message->report_id || $message->is_review) hidden @endif ">
                    <input name="thread-messages[]" value="{{$message->id}}"  id="message-{{$message->id}}" type="checkbox">
                    <label id="checkbox-label-{{$message->id}}" for="message-{{$message->id}}"></label>
                </div>
            </div>
            <div class="email-list-detail">
                <span class="date pull-right"><i class="icon mdi mdi-attachment-alt"></i> {{\Carbon\Carbon::parse($message->created_at)->format("d.m.Y")}}</span>
                <p class="msg msg-styled">
                    <span>{{$message->text}}</span>
                </p>

                @foreach($message->links as $l)
                    @if(!empty($l->teyitlink_slug))
                    @include('message.partials.linkPreview',$l)
                    @endif
                @endforeach



                @if(!$message->files->isEmpty())
                    <p class="msg">
                        @foreach($message->files as $file)
                            @if($file->file_type == 'image' && strpos($file->file_url, 'ton.twitter.com') !== false)
                                <a class="fancybox"   href="http://api.dubito.cancit.com/dmimage?url={{$file->file_url}}"> <img data-src="http://api.dubito.cancit.com/dmimage?url={{$file->file_url}}" class="img-rounded xs-mr-10 img-thumbnail" style="width:150px;" src="http://api.dubito.cancit.com/dmimage?url={{$file->file_url}}" /></a>
                            @elseif($file->file_type == 'image')
                                <a class="fancybox"   href="{{$file->file_url}}"> <img data-src="{{$file->file_url}}" class="img-rounded xs-mr-10 img-thumbnail" style="width:150px;" src="{{$file->file_url}}" /></a>
                            @endif
                            @if($file->file_type == 'video')
                                <video data-src="{{$file->file_url}}" style="width:150px;" src="{{$file->file_url}}"></video>
                            @endif
                            @if($file->file_type == 'file')
                                <span class="icon mdi mdi-attachment-alt"></span>
                                <a target="_blank" href="{{$file->file_url}}">{{$file->file_type}}</a>
                            @endif
                        @endforeach
                    </p>

                @endif
            </div>
        @endif
    </div>
@endforeach
