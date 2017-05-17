@extends('layout.app',['css' => 'be-aside'])
@section('content')
    <aside class="page-aside">
        <div class="">
            <div class="aside-content">

                <div class="content" style="position: absolute;width:100%;height: 136px;z-index:1">
                    <div class="aside-header">
                        <span class="title">Inbox</span>
                        <br>
                        <div class="btn-group">
                            <button data-toggle="dropdown" type="button" class="btn btn-default btn-md dropdown-toggle">Filter by channel  <span class="caret"></span></button>
                            <ul role="menu" class="filter-source dropdown-menu">
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
                        <div class="btn-group">
                            <input type="text" class="filter-keyword" placeholder="Ara" />
                        </div>
                    </div>
                </div>
                <div style="height: 100%;padding-top:136px;position: relative" class="aside-nav">
                    <div style="position: relative;height: 100%;" id="thread-scroller">
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
        </div>
    </aside>
    <div id="section-thread" class="main-content container-fluid">
        @include('message.thread',['messages' => $messages])
    </div>



@endsection

@include("message.partials._case_modal_form")
@include('report.partials.assign_to_case_modal')



@section('script')
    <script src="{{asset('assets/js/nprogress.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/css/nprogress.css')}}" />
    <script src="//ajax.googleapis.com/ajax/libs/spf/2.4.0/spf.js"></script>
    <script>

        $(document).on("spfclick", function() {
            // Show progress bar
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
            // Finish request and remove progress bar
            NProgress.remove();
        });
        $("#section-thread").on('thread-change',function(event,data){ //Read first message on load.
            $(".pagination li a").addClass('spf-link');
            spf.dispose();
            spf.init();
            $(".fancybox").fancybox();
            $(".thread-list nav li").removeClass('active');
            $(".sender-item-" + data.sender_id).addClass('active');
            $(".sender-item-" + data.sender_id+" .thread-count").hide();
        });
        $("#section-thread").trigger('thread-change', {
            sender_id: '{{$messages[0]->sender_id}}'
        });

        var Inbox = function(config){

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
            var update = function(callback){
                $(".be-loading").addClass('be-loading-active');
                $.ajax({
                    url: "/threads",
                    data : state,
                    dataType : 'html',
                    success: function(result){
                        if(state.page == 1){
                            containerObj.html('');
                        }
                        $(".be-loading").removeClass('be-loading-active');
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
            var inbox = new Inbox({
                container : '#thread-list'
            });

            $('#thread-scroller').perfectScrollbar().on('ps-y-reach-end', function () {
                inbox.loadMore();
            });

            $('.filter-keyword').on('keyup',function(){
                var keyword = $(this).val();
                inbox.changeKeyword(keyword);
            });

            $('.filter-source a').on('click',function(){
                var source = $(this).data('source');
                inbox.setSource(source);
            });

        });




    </script>
@endsection

