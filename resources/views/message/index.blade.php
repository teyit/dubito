@extends('layout.app',['css' => 'be-aside'])
@section('content')
    <aside class="page-aside">

            <div class="aside-content" style="height: 100%;position: relative">

                <div class="content" style="position: absolute;width:100%;height: 136px;z-index:1;background:white;">
                    <div class="aside-header">
                        <div class="email-title">
                            <span class="icon mdi mdi-inbox"></span> Inbox</span>
                        </div>

                        <div style="margin-top:20px;" class="input-group xs-mb-15">
                            <input type="text" class="filter-keyword form-control" placeholder="Search" />
                            <div class="input-group-btn">
                                <button data-toggle="dropdown" type="button" class="btn btn-default btn-md dropdown-toggle message-filter-dropdown">
                                    Filter <span class="caret"></span>
                                </button>
                                <ul role="menu" class="filter-source message-filter-menu dropdown-menu">
                                    <li><a href="#">Tümü</a></li>
                                    <li class="divider"></li>
                                    <li><a data-source="facebook:message" href="#">Facebook</a></li>
                                    <li class="divider"></li>
                                    <li><a data-source="twitter:message" href="#">Twitter Messages</a></li>
                                    <li><a data-source="twitter:mention" href="#">Twitter Mentions</a></li>
                                    <li class="divider"></li>
                                    <li><a data-source="email" href="#">Email</a></li>
                                    <li class="divider"></li>
                                    <li><a data-source="others" href="#">Others</a></li>
                                </ul>
                            </div>
                        </div>


                    </div>

                </div>

                <div style="height: 100%;" class="aside-nav">
                    <div id="thread-scroller" style="position:relative;padding-top:136px;height:100%;overflow:hidden;">
                        <ul id="thread-list" data-page="1" data-source="" class="nav">
                            @include("message.partials.senders",["senders" => $senders])
                        </ul>
                        <div class="be-loading " style="padding:40px 0px;text-align: center;width:100%;">
                            <div class="be-spinner">
                                <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </aside>
    @if(!$messages->isEmpty())
    <div id="section-thread" class="main-content container-fluid">
        @include('message.thread',['messages' => $messages])
    </div>
    @endif
    @include("message.partials._case_modal_form")
    @include('report.partials.assign_to_case_modal')


@endsection




@section('script')
    <script src="{{asset('assets/js/nprogress.js')}}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/spf/2.4.0/spf.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/nprogress.css')}}" />
    <script src=""></script>

    <script src="{{asset('assets/lib/linkify/linkify.min.js')}}"></script>
    <script src="{{asset('assets/lib/linkify/linkify-jquery.min.js')}}"></script>

    <script>

        $(document).on("spfclick", function() {
            /*
            $("#section-thread").trigger('thread-change', {
                sender_id: $("#senderMeta").data('sender_id')
            });
            */

            NProgress.start();
        });

        $(document).on("spfrequest", function() {
            // Increment progress as request is made
            NProgress.inc();
        });

        $(document).on("spfprocess", function() {
            // Set progress bar width to 100%
            NProgress.done();
        });

        $(document).on("spfdone", function() {

            $("#section-thread").trigger('thread-change', {
                sender_id: $("#senderMeta").data('sender_id')
            });


            NProgress.remove();
        });
        $("#section-thread").on('thread-change',function(event,data){ //Read first message on load.
            $(".pagination li a").addClass('spf-link');
            spf.dispose();
            spf.init();
            $('.email-list').perfectScrollbar();
            $(".fancybox").fancybox();
            $("#thread-list li").removeClass('active');
            $(".sender-item-" + data.sender_id).addClass('active');
            $(".sender-item-" + data.sender_id+" .thread-count").hide();
            $('.msg').linkify({
                target: "_blank"
            });
        });



        var ContactList = function(config){

            //Infinite scroll - increment page, append content.
            //Change filter - reset page, reset content, append content.
            //Search - reset page, reset content, append content.

            var isLoading = false;
            var containerObj = $(config.container);
            var state = {
                page : 1,
                size : 40,
                keyword : '',
                source : null
            };
            var xhr = new window.XMLHttpRequest();
            var update = function(callback){
                $(".be-loading").addClass('be-loading-active');
                if(typeof xhr == 'object'){
                    xhr.abort();
                }
                if(state.page == 1){
                    containerObj.html('');
                }
                request = $.ajax({
                    url: "/threads",
                    data : state,
                    dataType : 'html',
                    xhr : function(){
                        return xhr;
                    },
                    success: function(result){
                        $(".be-loading").removeClass('be-loading-active');
                        $('#thread-scroller').perfectScrollbar('update');
                        containerObj.append(result);
                        spf.dispose();
                        spf.init();
                        typeof callback === 'function' && callback();
                    }
                });

            };

            this.loadMore = function(){
                if(!isLoading){
                    isLoading = true;
                    state.page++;
                    update(function(){
                        isLoading = false;
                    });
                }
            };

            this.changeKeyword = function(keyword){
                state.keyword = keyword;
                state.page = 1;
                update();
            };
            this.setSource = function(source){
                state.source = source;
                state.page = 1;
                update();
            };

        };


        $(function() {
            spf.init();

            var contactList = new ContactList({
                container : '#thread-list'
            });



            $('#thread-scroller').perfectScrollbar().on('ps-y-reach-end', function () {
                contactList.loadMore();
            });

            $('.msg').linkify({
                target: "_blank"
            });

            $('.filter-keyword').on('keyup',function(){
                var keyword = $(this).val();
                contactList.changeKeyword(keyword);
            });

            $('.filter-source a').on('click',function(){
                var source = $(this).data('source');
                contactList.setSource(source);
            });

        });

        /*Thread specific*/
        $(document).on('click',"#sendMsgBtn",function(){
            var text = $("#messageInput").val();

            $.ajax({
                method:"post",
                url:"/messages/new",
                data:{
                    _token:$("_token").val(),
                    sender_id : $("#senderMeta").data('sender_id'),
                    text : text
                },
                success:function(response){

                    if(response){

                        $(".email-list").append(response.html);



                        $("#messageInput").val("");


                        $.gritter.add({
                            title: 'Success',
                            text: 'your message has been sent.',
                            class_name: 'color success'
                        });
                    }

                }
            });
        });
        $(document).on('click',".review-assign",function () {
            var selected_messages = $('.email-list-item .be-checkbox input[type=checkbox]:checked');
            var message_list = selected_messages.map(function(_, el) {
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
                    $.each(message_list,function(index,message_id){
                        $("#message-item-"+message_id+" .be-checkbox").remove();
                        $("#message-item-"+message_id+" .case-btn span").removeClass('mdi-open-in-new').addClass('mdi-star-outline');
                        $("#message-item-"+message_id+" .case-btn").removeClass('hidden');
                    });
                    if(response){

                        $.gritter.add({
                            title: 'Success',
                            text: 'it was marked as review',
                            class_name: 'color success'
                        });
                    }

                }
            })

        });


        $('.message-filter-menu a').click(function () {
            var text = $(this).text() + ' <span class="icon-dropdown mdi mdi-chevron-down"></span>';
            $('.message-filter-dropdown').html(text);
        });



    </script>
@endsection

