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
@foreach($messages as $message)
    @include('message.partials.item',$message)
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
