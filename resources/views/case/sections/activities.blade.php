<div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">Activities</div>
    <div class="panel-body" style="padding:0px;">
        <div class="list-group activity-list">
            <a href="javascript:;" class="hidden list-group-item activity-item">
                <span class="badge badge-primary"></span>
                <img class="account-img" style="width:24px;margin-right:10px;" src="" />
                <strong class="activity-username"></strong>
                <span class="activity-text"></span>
            </a>            
            @foreach($case->activities as $a)
            <a href="javascript:;" data-id="{{$a->id}}"  data-case-id="{{$case->id}}" class="list-group-item activity-item">
                <span class="badge badge-primary">{{$a->created_at}}</span>
                <img class="account-img" style="width:24px;margin-right:10px;" src="{{$a->user->account_picture or "/assets/img/avatar1.png"}}" />
                <strong class="activity-username">{{$a->user->name or ''}}: </strong>
                <span class="activity-text edit-activity-editable">{{$a->text}}</span>
            </a>
            @endforeach
            <span  class="list-group-item disabled" style="background-color:white;">
                <form id="activity-form-ajax" class="form-inline">
                    <input style="width:100%" placeholder="Add an activity" type="text" class="form-control">
                </form>
            </span>
        </div>
    </div>
</div>