<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-6">
            <div id="senderMeta" class="email-title" data-sender_id="{{$messages->first()->sender_id}}"
                    ><span class="icon mdi mdi-inbox"></span> {{$messages->first()->account_name}}
                    <span class="new-messages">
                    @if($messages->first()->source == 'facebook:message')
                        <span class="label label-primary">Facebook</span>
                    @endif

                </span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="pull-right email-filters-right">
                <div class="btn-group">
                    <button id="btn-save-report" type="button" class="report-assign-case btn btn-default">Assign to a case</button>
                    <button id="btn-mark-as-review"  type="button" class="btn btn-default review-assign">Mark as a review</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="email-list">
@foreach($messages as $s)
    <div id="message-item-{{$s->id}}" class="email-list-item email-list-item--unread">
        @if($s->is_reply)
            <div class="email-list-actions email-list-item--unread">

            </div>
            <div class="email-list-detail">
                <span class="date pull-right"><i class="icon mdi mdi-attachment-alt"></i> {{\Carbon\Carbon::parse($s->created_at)->format("d.m.Y")}}</span>
                <p class="msg msg-styled our-message">
                    <span>{{$s->text}}</span>
                </p>
            </div>
        @else
        <div class="email-list-actions email-list-item--unread">
            @if($s->report_id)
                <a target="_blank" href="{{route('cases.show',$s->report->case_id)}}" class=" btn-xl">
                    <span class="mdi mdi-open-in-new"></span>
                </a>
            @else
            <a target="_blank" href="javascript:;" class="hidden case-btn btn-xl">
                <span class="mdi mdi-open-in-new"></span>
            </a>
            <div class="be-checkbox">
                <input name="thread-messages[]" value="{{$s->id}}"  id="message-{{$s->id}}" type="checkbox">
                <label id="checkbox-label-{{$s->id}}" for="message-{{$s->id}}"></label>
            </div>
            @endif
          </div>
          <div class="email-list-detail">
            <span class="date pull-right"><i class="icon mdi mdi-attachment-alt"></i> {{\Carbon\Carbon::parse($s->created_at)->format("d.m.Y")}}</span>
            <p class="msg msg-styled">
                <span>{{$s->text}}</span>
            </p>

             @if(!$s->files->isEmpty())
             <p class="msg">
                @foreach($s->files as $file)
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


</div>
<div class="pagination">
    @if(isset($messages) and !empty($messages))
    <div class="paginate text-center message ">
        {{ $messages->links() }}
    </div>
    @endif
</div>
<div class="panel panel-default">
    <div class="panel-body">
      <form method="post" id="postMessageForm">
        <div class="form-group xs-pt-10">
          <textarea id="messageInput" placeholder="Type a message..." class="form-control"></textarea>
        </div>

        <div class="row xs-pt-15">
          <div class="col-xs-12">
            <p class="text-right">
              <button id="sendMsgBtn" type="button" class="btn btn-space btn-primary">Send</button>
              <button type="reset" class="btn btn-space btn-default">Clear</button>
            </p>
          </div>
        </div>
      </form>
    </div>
</div>
