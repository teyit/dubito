@extends('layout.app',['css' => 'be-aside'])
@section('content')
    <aside class="page-aside">
        <div class="be-scroller">
            <div class="aside-content">
                <div class="content">
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
                <div class="aside-nav collapse thread-list">
                    <ul class="nav">
                        @foreach($senders as $s)
                            <li class="sender-item-{{$s->first()->sender_id}}">
                                <a class="spf-link" href="/messages/{{$s->first()->sender_id}}">
                                    @if($s->count > 0)
                                    <span class="thread-count label label-primary">{{$s->count}}</span>
                                    @endif
                                    <div class="thread-avatar" style="background-image:url('{{$s->first()->account_picture}}');"></div>
                                    <span class="thread-name">{{$s->first()->account_name}}

                                    </span>

                                </a>
                            </li>
                        @endforeach
                    </ul>
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
        spf.init();
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
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="https://cdnjs.cloudflare.com/ajax/libs/timelinejs/2.25/css/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });

        $(document).on("spfdone", function() {
            // Finish request and remove progress bar
            NProgress.remove();
        });
        $("#section-thread").on('thread-change',function(sender_id){
            console.log(sender_id);
            $(".pagination li a").addClass('spf-link');
            spf.dispose();
            spf.init();
            $(".fancybox").fancybox();
            $(".thread-list nav li").removeClass('active');
            $(".sender-item-" + sender_id).addClass('active');
            $(".sender-item-" + sender_id+" .thread-count").hide();
        });
        $("#section-thread").trigger('thread-change',[{{$messages->first()->sender_id}}]);
    </script>
@endsection

