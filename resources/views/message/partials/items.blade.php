@foreach($messages as $message)
    <div id="message-item-{{$message->id}}" class="email-list-item email-list-item--unread">
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
                    <a target="_blank" href="{{route('cases.show',$message->report->case_id)}}" class=" btn-xl">
                        <span class="mdi mdi-open-in-new"></span>
                    </a>
                @else
                    <a target="_blank" href="javascript:;" class="hidden case-btn btn-xl">
                        <span class="mdi mdi-open-in-new"></span>
                    </a>
                    <div class="be-checkbox">
                        <input name="thread-messages[]" value="{{$message->id}}"  id="message-{{$message->id}}" type="checkbox">
                        <label id="checkbox-label-{{$message->id}}" for="message-{{$message->id}}"></label>
                    </div>
                @endif
            </div>
            <div class="email-list-detail">
                <span class="date pull-right"><i class="icon mdi mdi-attachment-alt"></i> {{\Carbon\Carbon::parse($message->created_at)->format("d.m.Y")}}</span>
                <p class="msg msg-styled">
                    <span>{{$message->text}}</span>
                </p>

                @foreach($message->links as $l)
                    @include('message.partials.linkPreview',$l)
                @endforeach



                @if(!$message->files->isEmpty())
                    <p class="msg">
                        @foreach($message->files as $file)
                            @if($file->file_type == 'image')
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