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
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Twitter Messages</a></li>
                                <li><a href="#">Twitter Mentions</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Email</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Others</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div style="height: 100%;padding-top:136px;position: relative" class="aside-nav">
                    <div style="position: relative;height: 100%;" id="thread-scroller">
                        <ul id="thread-list" class="nav">
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

        $(function() {
            var pageIsLoading = false;
            var page = 1;
            $("#thread-scroller").perfectScrollbar();
            $("#thread-scroller").on('ps-y-reach-end', function () {
                if(!pageIsLoading){
                    pageIsLoading = true;
                    page++;
                    $(".be-loading").addClass('be-loading-active')
                 $.get("/threads/?page=" + page, function(data, status){

                     pageIsLoading = false;
                     $(".be-loading").removeClass('be-loading-active');
                     $("#thread-list").append(data);
                     spf.dispose();
                     spf.init();
                 });
                }
            });

        });

        //spf.init();
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
        $("#section-thread").on('thread-change',function(event,data){
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
    </script>
@endsection

