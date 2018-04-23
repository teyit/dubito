<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="page-head">

                    <div class="col-md-8">
                        <h2 class="page-head-title"><a id="change-title" data-title="change title" data-value="{{$case->title }}" data-type="text"  href="#"  class="editable editable-click">{{$case->title}}</a></h2>
                    </div>
                    <div class="col-md-4 " style="padding: 10px 0px 0px 0px;">
                        <div style="float:right">
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
                        <button data-toggle="modal"  data-target="#published-link-create" class="btn btn-success btn-sm btn-link-modal" style="line-height: 28px;">@if($case->is_published)Set Publish Link @else Publish @endif</button>
                        @if($case->is_published)
                        <div class="switch-button switch-button-yesno switch-button-lg">
                           
                            <input type="checkbox" @if($case->is_published) checked @endif name="checkinsucc" id="checkinsucc"><span>
                            
                        <label for="checkinsucc"></label></span>

                        </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:10px">
                        <ol class="breadcrumb page-head-nav">
                            <li>User: <a id="assign-user-case" data-title="Assign user to case" data-value="{{$case->user->id or ''}}" data-type="select"  href="#"  class="editable editable-click">{{$case->user->name or ''}}</a></li>
                            <li>Category: <a id="change-category" data-title="Change Category " data-value="{{$case->category->title or ''}}" data-type="select"  href="#"  class="editable editable-click">{{$case->category->title or ''}}</a></li>
                            <li>Tags: <a href="#" data-type="select2" data-pk="1" data-title="Enter tags" id="tag-input">{{implode(",",$selectedTags    )}}</a>
                            </li>
                            <li>Created at: {{$case->created_at->format("d-m-Y h:i")}}</li>
                            <li>Updated at: {{$case->updated_at->format("d-m-Y h:i")}}</li>
                        </ol>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
    </div>

</div>