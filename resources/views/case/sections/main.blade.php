<div class="panel panel-default">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="row panel-heading panel-heading-divider">
                        <div class="col-md-6" style="padding:0">
                            <a id="change-title" data-title="change title" data-value="{{$case->title }}" data-type="text"  href="#"  class="editable editable-click">{{$case->title}}</a>

                            {{--{{$case->title}}--}}
                            @if($case->google_document_id)
                                <a target="_blank" class="btn btn-primary new-google-document" href="https://docs.google.com/document/d/{{$case->google_document_id}}/edit">Go to Analysis</a>
                            @endif
                            <span class="panel-subtitle" style="margin-top:5px;">
                                <span style="margin-right:10px; display:inline-block"><span style="margin-right:5px;" class="mdi mdi-calendar"></span> Created at: {{$case->created_at}}</span>
                                <span class="mdi mdi-calendar"></span> Updated at: {{$case->updated_at}}
                            </span>
                        </div>
                        <div class="col-md-6 text-right" style="padding:0">
                            <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-primary case-status-dropdown case-status-dropdown">
                                    {{$case->status_label}}
                                    <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                    <ul role="menu" class="dropdown-menu case-status-menu">
                                        @foreach($case->statusLabels as $status => $label)
                                            <li><a href="#"  id="{{$status}}">{{$label}}</a></li>
                                        @endforeach
                                    </ul>
                            </div>
                            <button data-status="{{$case->is_archived}}" class="btn btn-{{$case->is_archived == 'archived' ? 'danger' : "warning"}} case-is-archived-btn">{{$case->is_archived == 'archived' ? 'Remove Archive' : "Send to Archive"}}</button>
                            <button data-status="{{$case->is_archived}}" class="btn btn-{{$case->is_archived == 'is_in_backlog' ? 'danger' : "default"}} case-is-backlog-btn">{{$case->is_archived == 'is_in_backlog' ? 'Remove Backlog' : "Send to Backlog"}}</button>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding:0 0 0 20px; margin-bottom:5px;">
                    <div class="col-md-6">
                        <div class="timeline-avatar account-avatar">
                            <img class="account-img" src="{{$case->user->account_picture or "/assets/img/avatar1.png"}}"></div>
                            &nbsp;
                            <a id="assign-user-case" data-title="Assign user to case" data-value="{{$case->user->id or ''}}" data-type="select"  href="#"  class="editable editable-click">{{$case->user->name or ''}}</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="md-mr-20"><span class="mdi mdi-check"></span>
                            <a id="change-category" data-title="Change Category " data-value="{{$case->category->title or ''}}" data-type="select"  href="#"  class="editable editable-click">{{$case->category->title or ''}}</a>

                            </span>
                            <span class="md-mr-20"><span class="mdi mdi-labels"></span> {{$case->topic->title or ''}}</span>
                        </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{route('case.tag.store',$case->id)}}" method="post"
                          class="form-inline select2">
                        <div class="form-group" style="width:100%;">
                            <select name="tags[]" multiple="multiple" class="form-control tags">
                                @foreach($allTags as $tag)
                                    @if(in_array($tag->id,$selectedTags))
                                        <option value="{{$tag->id}}" selected>{{$tag->title}}</option>
                                    @else
                                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <form id="case-description-form">
                        <div class="form-group">
                             <textarea name="description" placeholder="Description" id="description-ta" rows="6" class="form-control" id="case-description">{{$case->description or ''}}</textarea>
                        </div>
                        <div class="form-group pull-right">
                            <button data-case-id="{{$case->id}}" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
