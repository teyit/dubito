<div class="panel panel-default">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="row panel-heading panel-heading-divider">
                        <div class="col-md-8" style="padding:0">
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
                        <div class="col-md-4 text-right" style="padding:0">
                            <div id="statusSelector" class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-primary case-status-dropdown case-status-dropdown">
                                    {{$case->status_label}}
                                    <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                    <ul role="menu" class="dropdown-menu case-status-menu">
                                        @foreach($case->statusLabels as $status => $label)
                                            <li><a href="#"  id="{{$status}}">{{$label}}</a></li>
                                        @endforeach
                                    </ul>
                            </div>
                            <div id="folderSelector" class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-primary case-folder-dropdown">
                                    @if($case->folder)
                                    {{$case->folderLabels[$case->folder]}}
                                    @else
                                    Select folder
                                    @endif
                                    <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu case-folder-menu">
                                    @foreach($case->folderLabels as $status=> $label)
                                        <li><a href="#"  id="{{$status}}">{{$label}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <span class="panel-subtitle" style="margin-top:15px;">
                                <div class="be-checkbox be-checkbox-color has-success inline">
                                  <input id="checkinsucc" type="checkbox" @if($case->is_published) checked @endif>
                                  <label for="checkinsucc">Is published?</label>
                                </div>
                            </span>
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
                    <form action="{{route('case.tag.store',$case->id)}}" method="post" class="form-inline select2">
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

<div class="panel panel-default">
    <div class="panel-heading">Activities</div>
    <div class="panel-body">
        <div class="list-group">
            <a href="javascript:;" class="hidden list-group-item activity-item">
                <span class="badge badge-primary"></span>
                <img class="account-img" style="width:24px;margin-right:10px;" src="" />
                <strong class="activity-username"></strong>
                <span class="activity-text"></span>
            </a>            
            @foreach($case->activities as $a)
            <a href="javascript:;" class="list-group-item activity-item">
                <span class="badge badge-primary">{{$a->created_at}}</span>
                <img class="account-img" style="width:24px;margin-right:10px;" src="{{$a->user->account_picture or "/assets/img/avatar1.png"}}" />
                <strong class="activity-username">{{$a->user->name or ''}}: </strong>
                <span class="activity-text">{{$a->text}}</span>
            </a>
            @endforeach
            <span  class="list-group-item disabled">
                <form id="activity-form-ajax" class="form-inline">
                    <input style="width:100%" placeholder="Add an activity" type="text" class="form-control">
                </form>
            </span>
        </div>
    </div>
</div>
