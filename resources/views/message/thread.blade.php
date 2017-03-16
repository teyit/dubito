
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-6">
            <div class="email-title"><span class="icon mdi mdi-inbox"></span> Inbox <span class="new-messages">(2 new messages)</span>  </div>
        </div>
        <div class="col-md-6">
            <div class="email-search">
                <div class="input-group input-search input-group-sm">
                    <input disabled type="text" placeholder="Search mail (available soon)... " class="form-control"><span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="icon mdi mdi-search"></i></button></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="email-filters">
    <div class="email-filters-left">
        <div class="be-checkbox be-select-all">
            <input id="check" type="checkbox">
            <label for="check"></label>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-default">Save as a report</button>
            <button type="button" class="btn btn-default">Mark as a review</button>
        </div>

    </div>
    <div class="email-filters-right"><span class="email-pagination-indicator">1-50 of 253</span>
        <div class="btn-group email-pagination-nav">
            <button type="button" class="btn btn-default"><i class="mdi mdi-chevron-left"></i></button>
            <button type="button" class="btn btn-default"><i class="mdi mdi-chevron-right"></i></button>
        </div>
    </div>
</div>
<div class="email-list">
    @foreach($messages as $s)
        <div class="email-list-item email-list-item--unread">
            <div class="hidden email-list-actions">
                <div class="be-checkbox">
                    <input id="check1" type="checkbox">
                    <label for="check1"></label>
                </div>
            </div>
            <div class="email-list-detail">
                <div class="thread-messages message-self">
                    {{$s->text}}
                    @if(!$s->files->isEmpty())
                        @foreach($s->files as $file)


                            @if($file->file_type == 'image')
                                <img data-src="{{$file->file_url}}" class="img-rounded xs-mr-10 img-thumbnail" style="width:150px;" src="{{$file->file_url}}" />
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
        </div>
    @endforeach
</div>
