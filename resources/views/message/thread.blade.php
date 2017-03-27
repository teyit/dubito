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
                    <button id="btn-save-report" type="button" class="report-assign-case btn btn-default">Archive</button>
                    <button id="btn-mark-as-review" type="button" class="btn btn-default">Mark as a review</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="email-list">
    @foreach($messages as $s)
        <div class="email-list-item email-list-item--unread">
            <div class="email-list-actions">
                @if(!$s->report_id)
                <div class="be-checkbox">
                    <input name="thread-messages[]" value="{{$s->id}}"  id="message-{{$s->id}}" type="checkbox">
                    <label id="checkbox-label-{{$s->id}}" for="message-{{$s->id}}"></label>
                </div>
                @endif
            </div>
            <div class="email-list-detail">
                <div class="thread-messages message-self">

                    {!! clickableLink($s->text) !!}
                    <hr />
                    @if(!$s->files->isEmpty())
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
                    @endif
                </div>



            </div>
            <div class="view-case-btn-container hidden email-list-actions" style="display:table-cell;vertical-align: middle">
                @if(isset($s->report->cases->id))
                <a target="_blank" href="{{route("cases.show",$s->report->cases->id)}}">
                    <button type="button" class="btn btn-default"><i class="icon mdi mdi-case-check"></i> View case</button>
                </a>
                @endif
            </div>
        </div>
    @endforeach

    @if(isset($messages) and !empty($messages))
    <div class="paginate text-center">
        {{ $messages->links() }}
    </div>
   @endif

</div>
<script>
    $("#section-thread").trigger('thread-change',[{{$messages->first()->sender_id}}]);
</script>