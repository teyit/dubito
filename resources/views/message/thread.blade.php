<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-6">
            <div class="email-title"><span class="icon mdi mdi-inbox"></span> {{$messages->first()->account_name}}  <span class="new-messages">
                    @if($messages->first()->source == 'facebook:message')
                        <span class="label label-primary">Facebook</span>
                    @endif

                </span>  </div>
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
    <div class="email-list-item email-list-item--unread">
    <div class="email-list-actions email-list-item--unread">
        @if($s->report_id)
            <a target="_blank" href="{{route('cases.show',$s->report->case_id)}}" class=" btn-xl">
                <span class="mdi mdi-open-in-new"></span>
            </a>
        @else
        <div class="be-checkbox">
            <input name="thread-messages[]" value="{{$s->id}}"  id="message-{{$s->id}}" type="checkbox">
            <label id="checkbox-label-{{$s->id}}" for="message-{{$s->id}}"></label>
        </div>
        @endif
      </div>
      <div class="email-list-detail">
        <span class="date pull-right"><i class="icon mdi mdi-attachment-alt"></i> {{\Carbon\Carbon::parse($s->created_at)->format("d.m.Y")}}</span>
        <p class="msg">{{$s->text}}</p>
        
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
        
        <div class="view-case-btn-container hidden email-list-actions" style="display:table-cell;vertical-align: middle">
            @if(isset($s->report->cases->id))
                <a target="_blank" href="{{route("cases.show",$s->report->cases->id)}}">
                    <button type="button" class="btn btn-default"><i class="icon mdi mdi-case-check"></i> View case</button>
                </a>
            @endif
        </div>
      </div>
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

<div class="email-compose">
     <div class="subject">
      <div class="form-group row">
        <label class="col-sm-1 control-label">Subject</label>
        <div class="col-sm-11">
          <input type="text" class="form-control">
        </div>
      </div>
    </div>
</div>
<script>
    $(".review-assign").on('click',function () {

        var message_list = $('.email-list-item .be-checkbox input[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        if(message_list.length < 1){
            return false;
        }

        $.ajax({
            method:"put",
            url:"/mark-as-review",
            data:{_token:$("_token").val(),is_review:1,message_ids:message_list},
            success:function(response){

                if(response){
                    $.gritter.add({
                        title: 'Success',
                        text: 'it was marked as review',
                        class_name: 'color success'
                    });
                }

            }
        })

    })
    $("#section-thread").trigger('thread-change',[{{$messages->first()->sender_id}}]);
</script>
