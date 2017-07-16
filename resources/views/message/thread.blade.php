<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-6">
            <div id="senderMeta" class="email-title" data-sender_id="{{$messages->first()->sender_id}}">
                @if($messages->first()->source == 'twitter:message')
                    <span class="mdi mdi-inbox"></span>
                @elseif($messages->first()->source == 'twitter:mention')
                    <span class="mdi mdi-twitter-box"></span>
                @elseif($messages->first()->source == 'facebook:message')
                    <span class="mdi mdi-facebook-box"></span>
                @endif
                {{$messages->first()->account_name}}
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
<div style="position:relative;overflow: hidden;height:400px;" class="email-list">
@include('message.partials.items',$messages)
</div>
@section('script')

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
@parent
<script>
    var threadPage = 2;
    var threadLoading = false;
    var loadMoreMessages = function(){
        if(threadLoading){
            return false;
        }
        threadLoading = true;
        $.ajax({
            url: "{{route('messages.show_page',$messages->first()->sender_id)}}",
            data : {
                page : threadPage
            },
            dataType : 'html',
            success: function(result){
                if(result !== 'EMPTY'){
                    threadPage++;
                    $(".email-list").prepend(result);
                }
                setTimeout(function(){
                    threadLoading = false;
                },1000);

            }
        });
    };
    $(document).ready(function(){
        $('.email-list').perfectScrollbar().on('ps-y-reach-start', function () {
            console.log("Dynamic threads are loaded");
            loadMoreMessages();
        });
    });
</script>
@stop